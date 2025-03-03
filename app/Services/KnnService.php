<?php

namespace App\Services;

use App\Models\Wisata;
use Illuminate\Support\Facades\Log;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Euclidean;

class KnnService
{
    public $lat, $long;
    private const MAX_DISTANCE = 40; // untuk batas maksimal kilometer

    public function cariRekomendasi($lat, $long, $selectedJenis = [])
    {
        $this->lat = $lat;
        $this->long = $long;

        // Query dasar untuk wisata
        $query = Wisata::query();

        // Filter berdasarkan jenis yang dipilih
        if (!empty($selectedJenis)) {
            $query->whereHas('jenis', function ($q) use ($selectedJenis) {
                $q->whereIn('jenis.id', $selectedJenis);
            });
        }

        $wisatas = $query->get();

        // Jika tidak ada wisata yang sesuai dengan filter
        if ($wisatas->isEmpty()) {
            return [];
        }

        $samples = [];
        $labels = [];
        $distances = [];

        // Hitung jarak dan filter berdasarkan jarak maksimum
        foreach ($wisatas as $wisata) {
            $distance = $this->calculateDistance(
                (float)$this->lat,
                (float)$this->long,
                (float)$wisata->lat,
                (float)$wisata->long
            );

            // Hanya masukkan lokasi yang jaraknya dalam batas maksimum
            if ($distance <= self::MAX_DISTANCE) {
                $distances[$wisata->id] = $distance;
                $samples[] = [(float)$wisata->lat, (float)$wisata->long];
                $labels[] = $wisata->id;
            }
        }

        // Jika tidak ada lokasi dalam radius yang ditentukan
        if (empty($distances)) {
            return [];
        }

        // Urutkan berdasarkan jarak terdekat
        asort($distances);

        // Ambil 5 ID wisata terdekat atau semua jika kurang dari 5
        $limit = min(5, count($distances));
        $recommendedWisataIds = array_slice(array_keys($distances), 0, $limit);

        // Log untuk debugging
        Log::info('Rekomendasi wisata:', [
            'lokasi_user' => ['lat' => $this->lat, 'long' => $this->long],
            'jarak_maksimum' => self::MAX_DISTANCE . ' km',
            'jumlah_rekomendasi' => count($recommendedWisataIds),
            'detail_jarak' => array_slice($distances, 0, $limit, true)
        ]);

        return $recommendedWisataIds;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius Bumi dalam kilometer

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) + // buat perhitungan jarak vertikal antara dua titik
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * // menyesuaikan kelengkungan bumi
            sin($lonDelta / 2) * sin($lonDelta / 2); // menghitung jarak horizontal antara dua titik

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
