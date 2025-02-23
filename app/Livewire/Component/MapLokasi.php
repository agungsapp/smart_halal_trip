<?php

namespace App\Livewire\Component;

use App\Models\Wisata;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MapLokasi extends Component
{
    // defaultnya adalah ini 
    public $userLat = '-5.5575313';
    public $userLong = '105.2418745';
    public $recommendedLocations = [];



    protected $listeners = ['recommendationUpdated' => 'updateMap'];

    public function mount()
    {
        $this->recommendedLocations = Wisata::orderBy('nama', 'asc')->limit(3)->get();
        Log::info('Initial User Location:', [
            'lat' => $this->userLat,
            'long' => $this->userLong
        ]);


        // Dispatch initial map data
        $this->dispatch('mapDataUpdated', [
            'userLocation' => [
                'lat' => $this->userLat,
                'lng' => $this->userLong
            ],
            'recommendedLocations' => $this->recommendedLocations
        ]);

        // dd([$this->userLat, $this->userLong]);
    }

    public function updateMap($recommendedWisataIds, $userLat, $userLong)
    {
        // dd("event di gas");
        // Update lokasi pengguna
        if (!empty($userLat) && !empty($userLong)) {
            $this->userLat = $userLat;
            $this->userLong = $userLong;
        }

        // Update rekomendasi lokasi wisata
        if (!empty($recommendedWisataIds)) {
            $this->recommendedLocations = Wisata::whereIn('id', $recommendedWisataIds)
                ->orderByRaw("FIELD(id, " . implode(',', $recommendedWisataIds) . ")")
                ->limit(3)
                ->get();
        } else {
            $this->recommendedLocations = [];
        }

        // hasil dd di sini saya cek sudah beda 
        // dd([$this->userLat, $this->userLong]);
        // hasil dd :
        //     array:2 [▼ // app/Livewire/Component/MapLokasi.php:56
        //   0 => "-5.37724125"
        //   1 => "105.24982639278474"
        // ]

        // dd($this->recommendedLocations->toArray());



        // Dispatch event untuk update map
        $this->dispatch('mapDataUpdated', [
            'userLocation' => [
                'lat' => $this->userLat,
                'lng' => $this->userLong
            ],
            'recommendedLocations' => $this->recommendedLocations
        ]);
    }

    public function render()
    {
        return view('livewire.component.map-lokasi');
    }
}
