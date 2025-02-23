<?php

namespace App\Livewire\Component;

use App\Models\Jenis;
use App\Services\KnnService;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CariLokasi extends Component
{
    public $query = '';
    public $locations = [];
    public $jenis;
    public $selectedJenis = [];

    protected $listeners = [
        'saveLocationToSession',
        'resetJenis'
    ];

    public function mount()
    {
        $this->jenis = Jenis::all();
    }

    public function resetJenis()
    {
        $this->selectedJenis = [];

        // Jika ada lokasi yang sudah dipilih, update rekomendasi
        $location = Session::get('selectedLocation');
        if ($location) {
            $this->cariRekomendasi($location);
        }
    }

    public function updatedSelectedJenis($value)
    {
        // Ketika jenis berubah dan ada lokasi yang sudah dipilih,
        // update rekomendasi
        $location = Session::get('selectedLocation');
        if ($location) {
            $this->cariRekomendasi($location);
        }
    }

    public function searchLocations()
    {
        if (strlen($this->query) > 2) {
            $url = 'https://nominatim.openstreetmap.org/search';
            $params = [
                'q' => $this->query,
                'format' => 'json',
                'limit' => 5,
                'countrycodes' => 'id',
            ];

            $response = Http::withHeaders([
                'User-Agent' => 'YourAppName/1.0 (+https://yourwebsite.com)',
            ])->get($url, $params);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data)) {
                    $this->locations = collect($data)->map(function ($item) {
                        return [
                            'display_name' => $item['display_name'] ?? 'Unknown Location',
                            'lat' => $item['lat'] ?? null,
                            'lon' => $item['lon'] ?? null,
                        ];
                    })->toArray();
                } else {
                    $this->locations = [];
                }
            } else {
                Log::error('Nominatim API Error:', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                $this->locations = [];
            }
        } else {
            $this->locations = [];
        }
    }

    public function saveLocationToSession($location)
    {
        Session::put('selectedLocation', $location);
        Log::info('Lokasi disimpan ke session Laravel:', $location);

        $this->cariRekomendasi($location);
        $this->reset('locations');
    }

    public function cariRekomendasi($location)
    {
        $knnService = new KnnService();
        $recommendedWisataIds = $knnService->cariRekomendasi(
            $location['latitude'],
            $location['longitude'],
            $this->selectedJenis // Kirim jenis yang dipilih ke KNN Service
        );

        $this->dispatch(
            'recommendationUpdated',
            recommendedWisataIds: $recommendedWisataIds,
            userLat: $location['latitude'],
            userLong: $location['longitude']
        );
    }

    public function render()
    {
        return view('livewire.component.cari-lokasi');
    }
}
