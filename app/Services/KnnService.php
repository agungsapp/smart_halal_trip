<?php

namespace App\Services;

use App\Models\Wisata;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Euclidean;

class KnnService
{
    public $lat, $long;

    public function cariRekomendasi($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;

        $wisatas = Wisata::all();
        $samples = [];
        $labels = [];
        $wisataMap = []; // Untuk menyimpan mapping jarak ke ID wisata

        // Persiapkan data untuk KNN
        foreach ($wisatas as $wisata) {
            $samples[] = [(float)$wisata->lat, (float)$wisata->long];
            $labels[] = $wisata->id;
        }

        // Inisialisasi KNN dengan k=5 dan metrik jarak Euclidean
        $knn = new KNearestNeighbors(5, new Euclidean());

        // Hitung jarak untuk setiap titik
        $distances = [];
        $input = [(float)$this->lat, (float)$this->long];

        foreach ($samples as $index => $sample) {
            $distance = $this->calculateDistance(
                $input[0],
                $input[1],
                $sample[0],
                $sample[1]
            );
            $distances[$labels[$index]] = $distance;
        }

        // Urutkan berdasarkan jarak terdekat
        asort($distances);

        // Ambil 5 ID wisata terdekat
        $recommendedWisataIds = array_slice(array_keys($distances), 0, 5);

        return $recommendedWisataIds;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Menggunakan Haversine formula untuk menghitung jarak dalam kilometer
        $earthRadius = 6371; // Radius Bumi dalam kilometer

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
