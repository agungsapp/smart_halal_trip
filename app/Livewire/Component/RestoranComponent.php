<?php

namespace App\Livewire\Component;

use App\Models\Restaurant;
use App\Models\Wisata;
use Livewire\Component;
use Livewire\WithPagination;

class RestoranComponent extends Component
{

    use WithPagination; // Menggunakan trait WithPagination untuk pagination

    public $search = ''; // Variabel untuk menyimpan input pencarian

    protected $queryString = ['search']; // Menyinkronkan query string URL dengan input pencarian

    public function render()
    {
        // Query untuk mengambil data wisata dengan filter pencarian
        $restaurants = Wisata::where('id_jenis', 13)
            ->where('nama', 'like', '%' . $this->search . '%')
            ->paginate(6); // Pagination dengan 6 item per halaman

        return view('livewire.component.restoran-component', [
            'restaurants' => $restaurants,
        ]);
    }
}
