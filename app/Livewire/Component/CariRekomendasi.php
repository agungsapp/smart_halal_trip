<?php

namespace App\Livewire\Component;

use App\Models\Wisata;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Phpml\Classification\KNearestNeighbors;

class CariRekomendasi extends Component
{
    public $lat, $long;
    public $recommendedWisatas = [];

    public function mount()
    {
        if (Session::has('lat') && Session::has('long')) {
            $this->lat = Session::get('lat');
            $this->long = Session::get('long');
        } else {
            // Default ke Bandar Lampung
            $this->lat = -5.429;
            $this->long = 105.261;
        }
    }


    public function setLocation($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;

        Session::put('lat', $lat);
        Session::put('long', $long);
    }


    public function cariRekomendasi()
    {
        $this->validate([
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

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
        $recommendedWisataIds = $knn->predict([$input]);

        $this->dispatch(
            'recommendationUpdated',
            recommendedWisataIds: $recommendedWisataIds,
            userLat: $this->lat,
            userLong: $this->long
        );
    }

    public function render()
    {
        return view('livewire.component.cari-rekomendasi');
    }
}
