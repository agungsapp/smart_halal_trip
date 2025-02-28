import 'ol/ol.css';
import Map from 'ol/Map';
import View from 'ol/View';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import { fromLonLat, toLonLat } from 'ol/proj';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import LineString from 'ol/geom/LineString';
import VectorSource from 'ol/source/Vector';
import VectorLayer from 'ol/layer/Vector';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
import Modify from 'ol/interaction/Modify';
import CircleStyle from 'ol/style/Circle';
import Fill from 'ol/style/Fill';
import Stroke from 'ol/style/Stroke';
import Overlay from 'ol/Overlay';

window.ol = {
    Map, View, TileLayer, OSM,
    proj: { fromLonLat, toLonLat },
    Feature,
    geom: { Point, LineString },
    source: { Vector: VectorSource, OSM },
    layer: { Vector: VectorLayer, Tile: TileLayer },
    style: { Style, Icon, Circle: CircleStyle, Fill, Stroke },
    interaction: { Modify },
    Overlay
};

let currentMap = null;
let currentVectorSource = null;
let routeVectorSource = null;
let userMarker = null;
let currentPopup = null;

// Create marker styles (existing code remains the same)
const createUserMarkerStyle = () => {
    return new Style({
        image: new CircleStyle({
            radius: 8,
            fill: new Fill({ color: '#3388ff' }),
            stroke: new Stroke({ color: '#ffffff', width: 2 })
        })
    });
};

const createLocationMarkerStyle = () => {
    return new Style({
        image: new Icon({
            src: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
                <svg width="32" height="42" viewBox="0 0 32 42" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 0C7.16 0 0 7.16 0 16c0 11.04 16 26 16 26s16-14.96 16-26c0-8.84-7.16-16-16-16zm0 22c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z" 
                          fill="#e31b23"/>
                    <circle cx="16" cy="16" r="6" fill="white"/>
                </svg>
            `),
            anchor: [0.5, 1],
            scale: 1
        })
    });
};

// Create route style
const createRouteStyle = () => {
    return new Style({
        stroke: new Stroke({
            color: '#3388ff',
            width: 4,
            lineDash: [8, 8]
        })
    });
};

// Calculate distance between two points
const calculateDistance = (coord1, coord2) => {
    const R = 6371; // Earth's radius in km
    const dLat = (coord2[1] - coord1[1]) * Math.PI / 180;
    const dLon = (coord2[0] - coord1[0]) * Math.PI / 180;
    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(coord1[1] * Math.PI / 180) * Math.cos(coord2[1] * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return (R * c).toFixed(2);
};

// Fetch route from OSRM
const fetchRoute = async (start, end) => {
    const startCoord = toLonLat(start);
    const endCoord = toLonLat(end);

    try {
        const response = await fetch(
            `https://router.project-osrm.org/route/v1/driving/${startCoord[0]},${startCoord[1]};${endCoord[0]},${endCoord[1]}?overview=full&geometries=geojson`
        );
        const data = await response.json();

        if (data.routes && data.routes[0]) {
            return data.routes[0].geometry.coordinates.map(coord => fromLonLat(coord));
        }
    } catch (error) {
        console.error('Error fetching route:', error);
    }
    return null;
};

// Function to display route
const displayRoute = async (start, end) => {
    // Clear existing route
    if (routeVectorSource) {
        routeVectorSource.clear();
    }

    const coordinates = await fetchRoute(start, end);
    if (!coordinates) return;

    const routeFeature = new Feature({
        geometry: new LineString(coordinates),
        type: 'route'
    });
    routeFeature.setStyle(createRouteStyle());
    routeVectorSource.addFeature(routeFeature);
};

// Function to create popup content (updated with distance)
const createPopupContent = (location, userCoords) => {
    const locationCoords = fromLonLat([parseFloat(location.long), parseFloat(location.lat)]);
    const distance = calculateDistance(
        toLonLat(userCoords),
        [parseFloat(location.long), parseFloat(location.lat)]
    );

    const div = document.createElement('div');
    div.className = 'ol-popup bg-white rounded shadow-lg p-3';
    div.innerHTML = `
        <h3 class="font-bold mb-2">${location.nama}</h3>
        <p class="text-sm mb-2">${location.alamat || 'Alamat tidak tersedia'}</p>
        <p class="text-sm mb-2">Jarak: ${distance} km</p>
        <div class="flex gap-2">
            <button onclick="window.open('https://www.google.com/maps/search/?api=1&query=${location.lat},${location.long}', '_blank')" 
                    class="btn btn-primary rounded-3">
                Buka di Google Maps
            </button>
            <button onclick="this.closest('.ol-popup').style.display='none'" 
                    class="btn btn-secondary rounded-3">
                Tutup
            </button>
        </div>
    `;
    return div;
};

// Rest of the code remains the same, but update the click handler
window.initMap = function (userLocation = { lat: -5.5575313, lng: 105.2418745 }, recommendedLocations = []) {
    console.log("✅ Memulai inisialisasi peta...", userLocation);

    if (!document.getElementById('map')) {
        console.error("❌ Elemen map tidak ditemukan.");
        return;
    }

    // Clear previous map
    if (currentMap) {
        currentMap.setTarget(null);
        currentMap = null;
    }

    // Create popup overlay container
    const popupContainer = document.createElement('div');
    popupContainer.className = 'ol-popup';
    document.getElementById('map').appendChild(popupContainer);

    // Create popup overlay
    currentPopup = new ol.Overlay({
        element: popupContainer,
        positioning: 'bottom-center',
        stopEvent: false,
        offset: [0, -10]
    });

    // Create vector sources and layers
    currentVectorSource = new VectorSource();
    routeVectorSource = new VectorSource();

    const vectorLayer = new VectorLayer({
        source: currentVectorSource
    });

    const routeLayer = new VectorLayer({
        source: routeVectorSource
    });

    // Initialize map
    currentMap = new Map({
        target: 'map',
        layers: [
            new TileLayer({
                source: new OSM()
            }),
            routeLayer,
            vectorLayer
        ],
        view: new View({
            center: fromLonLat([parseFloat(userLocation.lng), parseFloat(userLocation.lat)]),
            zoom: 12
        }),
        overlays: [currentPopup]
    });

    // Add click handler for features
    currentMap.on('click', async function (evt) {
        const feature = currentMap.forEachFeatureAtPixel(evt.pixel, function (feature) {
            return feature;
        });

        if (feature && feature.get('type') === 'location') {
            const coordinates = feature.getGeometry().getCoordinates();
            const properties = feature.get('properties');
            const userCoords = userMarker.getGeometry().getCoordinates();

            // Display popup
            currentPopup.setPosition(coordinates);
            popupContainer.innerHTML = '';
            popupContainer.appendChild(createPopupContent(properties, userCoords));
            popupContainer.style.display = 'block';

            // Display route
            await displayRoute(userCoords, coordinates);
        } else {
            popupContainer.style.display = 'none';
        }
    });

    // Add user marker
    userMarker = new Feature({
        geometry: new Point(fromLonLat([parseFloat(userLocation.lng), parseFloat(userLocation.lat)])),
        type: 'user'
    });
    userMarker.setStyle(createUserMarkerStyle());
    currentVectorSource.addFeature(userMarker);

    // Add recommended locations
    updateRecommendedMarkers(recommendedLocations);

    // Add drag interaction for user marker
    const modify = new Modify({
        source: currentVectorSource,
        filter: (feature) => feature.get('type') === 'user'
    });

    currentMap.addInteraction(modify);

    modify.on('modifyend', function (event) {
        const feature = event.features.getArray()[0];
        const coords = feature.getGeometry().getCoordinates();
        const [lng, lat] = toLonLat(coords);

        console.log("📍 Marker dipindahkan ke:", lat, lng);

        const location = {
            description: "Lokasi Pengguna",
            latitude: lat,
            longitude: lng
        };
        sessionStorage.setItem('selectedLocation', JSON.stringify(location));

        // Clear existing route when user marker is moved
        if (routeVectorSource) {
            routeVectorSource.clear();
        }

        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch("setLocation", lat, lng);
        }
    });

    console.log("✅ Peta berhasil diinisialisasi dengan marker.");
};

// The rest of the code (updateUserMarkerPosition, updateRecommendedMarkers, etc.) remains the same
// Function to update user marker position
const updateUserMarkerPosition = (lat, lng) => {
    if (!currentVectorSource || !userMarker) return;

    const newCoords = fromLonLat([parseFloat(lng), parseFloat(lat)]);
    userMarker.getGeometry().setCoordinates(newCoords);

    // Clear existing route when user position updates
    if (routeVectorSource) {
        routeVectorSource.clear();
    }

    if (currentMap) {
        currentMap.getView().setCenter(newCoords);
        currentMap.getView().setZoom(14); // Optional: adjust zoom level
    }
};

// Function to clear and add recommended location markers
const updateRecommendedMarkers = (locations) => {
    if (!currentVectorSource) return;

    // Remove existing location markers
    const features = currentVectorSource.getFeatures();
    features.forEach(feature => {
        if (feature.get('type') === 'location') {
            currentVectorSource.removeFeature(feature);
        }
    });

    // Clear any existing routes
    if (routeVectorSource) {
        routeVectorSource.clear();
    }

    // Add new location markers
    locations.forEach(location => {
        const locationMarker = new Feature({
            geometry: new Point(fromLonLat([parseFloat(location.long), parseFloat(location.lat)])),
            type: 'location',
            properties: location
        });
        locationMarker.setStyle(createLocationMarkerStyle());
        currentVectorSource.addFeature(locationMarker);
    });
};

// Function to resize map when container size changes
const handleMapResize = () => {
    if (currentMap) {
        setTimeout(() => {
            currentMap.updateSize();
        }, 200);
    }
};

// Add window resize listener
window.addEventListener('resize', handleMapResize);

// Listen for Livewire events
document.addEventListener('livewire:init', () => {
    Livewire.on('mapDataUpdated', (data) => {
        console.log("✅ Received map update:", data);
        const { userLocation, recommendedLocations } = data[0];

        console.log("Lokasi rekomendasi:", recommendedLocations);

        if (currentMap && userMarker) {
            updateUserMarkerPosition(userLocation.lat, userLocation.lng);
            updateRecommendedMarkers(recommendedLocations);
        } else {
            window.initMap(userLocation, recommendedLocations);
        }
    });

    // Listen for user location updates
    Livewire.on('userLocationUpdated', (data) => {
        const { lat, lng } = data[0];
        if (currentMap && userMarker) {
            updateUserMarkerPosition(lat, lng);
        }
    });

    // Listen for recommended locations updates
    Livewire.on('recommendedLocationsUpdated', (locations) => {
        if (currentMap) {
            updateRecommendedMarkers(locations);
        }
    });
});

// Function to clean up map resources
const cleanupMap = () => {
    if (currentMap) {
        // Remove event listeners
        window.removeEventListener('resize', handleMapResize);

        // Clear vector sources
        if (currentVectorSource) {
            currentVectorSource.clear();
        }
        if (routeVectorSource) {
            routeVectorSource.clear();
        }

        // Remove overlays
        if (currentPopup) {
            currentMap.removeOverlay(currentPopup);
        }

        // Dispose of the map
        currentMap.setTarget(null);
        currentMap = null;
        currentVectorSource = null;
        routeVectorSource = null;
        userMarker = null;
        currentPopup = null;
    }
};

// Add cleanup listener
document.addEventListener('beforeunload', cleanupMap);

// Export functions for external use
window.mapFunctions = {
    updateUserMarkerPosition,
    updateRecommendedMarkers,
    cleanupMap,
    handleMapResize
};