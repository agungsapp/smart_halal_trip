import 'ol/ol.css'; // Pastikan CSS OpenLayers dimuat
import Map from 'ol/Map';
import View from 'ol/View';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import { fromLonLat, toLonLat } from 'ol/proj';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import VectorSource from 'ol/source/Vector';
import VectorLayer from 'ol/layer/Vector';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
import Modify from 'ol/interaction/Modify';

// Tambahkan OpenLayers ke window agar bisa diakses secara global
window.ol = {
  Map,
  View,
  TileLayer,
  OSM,
  proj: { fromLonLat, toLonLat },
  Feature,
  geom: { Point },
  source: { Vector: VectorSource, OSM },
  layer: { Vector: VectorLayer, Tile: TileLayer },
  style: { Style, Icon },
  interaction: { Modify },
};

console.log("✅ map.js Loaded!");

let currentMap = null;
let currentVectorSource = null;

window.initMap = function (userLocation = { lat: -5.429, lng: 105.261 }, recommendedLocations = []) {
    console.log("✅ Memulai inisialisasi peta...");

    if (!document.getElementById('map')) {
        console.error("❌ Elemen map tidak ditemukan.");
        return;
    }

    console.log("✅ Elemen map ditemukan.");

    // Bersihkan peta sebelumnya
    if (currentMap) {
        currentMap.setTarget(null);
        currentMap = null;
    }

    const vectorSource = new ol.source.Vector();
    const vectorLayer = new ol.layer.Vector({ source: vectorSource });

    currentMap = new ol.Map({
        target: "map",
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
            vectorLayer,
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([userLocation.lng, userLocation.lat]),
            zoom: 12,
        }),
    });

    console.log("✅ Peta berhasil diinisialisasi.");

    // Tambah marker yang bisa digeser
    const userMarker = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([userLocation.lng, userLocation.lat])),
    });
    userMarker.setStyle(new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 1],
            src: "https://openlayers.org/en/latest/examples/data/icon.png", // Gunakan URL absolut
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
                src: "https://openlayers.org/en/latest/examples/data/icon.png", // Gunakan URL absolut
                scale: 0.1,
            }),
        }));
        vectorSource.addFeature(wisataMarker);
    });
};