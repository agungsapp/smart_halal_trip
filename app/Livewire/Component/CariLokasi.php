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

    protected $listeners = ['saveLocationToSession'];

    public function mount()
    {
        $this->jenis = Jenis::all();
    }

    // Method untuk mencari lokasi berdasarkan query
    public function searchLocations()
    {
        if (strlen($this->query) > 2) {
            // URL dan parameter untuk Nominatim API
            $url = 'https://nominatim.openstreetmap.org/search';
            $params = [
                'q' => $this->query,
                'format' => 'json',
                'limit' => 5, // Batasi hasil pencarian
                'countrycodes' => 'id', // Batasi hasil ke Indonesia
            ];

            // Debugging: Cetak URL dan parameter ke log
            Log::info('Nominatim API URL:', [$url]);
            Log::info('Nominatim API Params:', $params);

            // Kirim permintaan HTTP dengan header User-Agent
            $response = Http::withHeaders([
                'User-Agent' => 'YourAppName/1.0 (+https://yourwebsite.com)',
            ])->get($url, $params);

            // Debugging: Cek status respons
            if ($response->successful()) {
                $data = $response->json();

                // Debugging: Cetak respons dari API ke log
                Log::info('Nominatim API Response:', $data);

                if (!empty($data)) {
                    // Proses data lokasi
                    $this->locations = collect($data)->map(function ($item) {
                        return [
                            'display_name' => $item['display_name'] ?? 'Unknown Location',
                            'lat' => $item['lat'] ?? null,
                            'lon' => $item['lon'] ?? null,
                        ];
                    })->toArray();
                } else {
                    // Jika tidak ada data, kosongkan lokasi
                    $this->locations = [];
                }
            } else {
                // Debugging: Cetak error jika respons gagal
                Log::error('Nominatim API Error:', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                // Kosongkan lokasi jika terjadi error
                $this->locations = [];
            }
        } else {
            // Jika query kurang dari 3 karakter, kosongkan lokasi
            $this->locations = [];
        }
    }

    // Method untuk menyimpan lokasi ke session Laravel
    public function saveLocationToSession($location)
    {
        // dd($location);
        // Simpan lokasi ke session Laravel
        Session::put('selectedLocation', $location);
        Log::info('Lokasi disimpan ke session Laravel:', $location);

        $this->cariRekomendasi($location);
        $this->reset('locations');
    }

    public function cariRekomendasi($location)
    {

        $knnService = new KnnService();
        $recommendedWisataIds = $knnService->cariRekomendasi($location['latitude'], $location['longitude']);
        // dd($recommendedWisataIds);
        $this->dispatch(
            'recommendationUpdated',
            recommendedWisataIds: $recommendedWisataIds,
            userLat: $location['latitude'],
            userLong: $location['longitude']
        );
    }


    // public function mount()
    // {
    //     $lokasi = Session::get('selectedLocation');
    //     dd($lokasi);
    // }

    public function render()
    {
        return view('livewire.component.cari-lokasi');
    }
}
