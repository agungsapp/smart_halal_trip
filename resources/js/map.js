import * as ol from 'ol';
import Map from 'ol/Map.js';
import OSM from 'ol/source/OSM.js';
import TileLayer from 'ol/layer/Tile.js';
import View from 'ol/View.js';
import { fromLonLat } from 'ol/proj.js';
import Feature from 'ol/Feature.js';
import Point from 'ol/geom/Point.js';
import VectorSource from 'ol/source/Vector.js';
import VectorLayer from 'ol/layer/Vector.js';
import Style from 'ol/style/Style.js';
import Icon from 'ol/style/Icon.js';
import { boundingExtent } from 'ol/extent.js';

window.ol = ol; // Tambahkan ini agar bisa diakses di browser console


// console.log(window.ol);



console.log("✅ map.js Loaded!");

let currentMap = null;
let currentVectorSource = null;





window.initMap = function (userLocation = { lat: -5.429, lng: 105.261 }, recommendedLocations = []) {
    if (typeof ol === 'undefined') {
        console.error("❌ OpenLayers belum dimuat!");
        return;
    } else {
        console.info("✅ OpenLayers berhasil dimuat!");

    }

    console.log("✅ Memuat peta dengan lokasi:", userLocation);

    if (!document.getElementById('map')) {
        console.error("❌ Elemen map tidak ditemukan.");
        return;
    }

    // Bersihkan peta sebelumnya
    if (currentMap) {
        currentMap.setTarget(null);
        currentMap = null;
    }

    const vectorSource = new VectorSource();
    const vectorLayer = new VectorLayer({ source: vectorSource });


    currentMap = new Map({
        target: "map",
        layers: [
            new TileLayer({
                source: new OSM()
            }),
            vectorLayer,
        ],
        view: new View({
            center: fromLonLat([userLocation.lng, userLocation.lat]),
            zoom: 12,
        }),
    });
    

    // Tambah marker yang bisa digeser
    const userMarker = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([userLocation.lng, userLocation.lat])),
    });

    userMarker.setStyle(new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 1],
            src: "/images/maps.png",
            scale: 0.3,
        }),
    }));

    vectorSource.addFeature(userMarker);

    // Tambahkan fitur drag & drop
    const dragInteraction = new ol.interaction.Modify({ source: vectorSource });
    currentMap.addInteraction(dragInteraction);

    dragInteraction.on("modifyend", function (event) {
        const newCoords = event.features.item(0).getGeometry().getCoordinates();
        const newLatLng = ol.proj.toLonLat(newCoords);
        const newLat = newLatLng[1];
        const newLng = newLatLng[0];

        console.log("📍 Marker dipindahkan ke:", newLat, newLng);

        // Kirim lokasi baru ke Livewire
        Livewire.dispatch("setLocation", newLat, newLng);
    });

    // Tambahkan marker untuk rekomendasi wisata
    recommendedLocations.forEach((location) => {
        const wisataMarker = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.fromLonLat([parseFloat(location.long), parseFloat(location.lat)])),
        });

        wisataMarker.setStyle(new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: "/images/wisata.png",
                scale: 0.1,
            }),
        }));

        vectorSource.addFeature(wisataMarker);
    });
};
