<?php

namespace App\Services;

use App\Models\Wisata;
use Phpml\Classification\KNearestNeighbors;

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

        foreach ($wisatas as $wisata) {
            $samples[] = [(float)$wisata->lat, (float)$wisata->long];
            $labels[] = $wisata->id;
        }

        $knn = new KNearestNeighbors($k = 5);
        $knn->train($samples, $labels);

        $input = [(float)$this->lat, (float)$this->long];
        return $recommendedWisataIds = $knn->predict([$input]);
    }
}
