<?php

namespace App\Livewire\Component;

use App\Models\Wisata;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MapLokasi extends Component
{
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
    }

    public function updateMap($recommendedWisataIds, $userLat, $userLong)
    {
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
