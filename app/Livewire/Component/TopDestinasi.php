<?php

namespace App\Livewire\Component;

use App\Models\Wisata;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TopDestinasi extends Component
{
    public $wisatas;
    public $lokasi = [];

    public function mount()
    {
        $this->wisatas = Wisata::orderBy('nama', 'asc')->limit(3)->get();
        $this->lokasi = Session::get('selectedLocation');
    }

    // Tambahkan listener untuk event
    protected $listeners = ['recommendationUpdated' => 'updateDestinations'];

    public function updateDestinations($recommendedWisataIds)
    {
        // dd($recommendedWisataIds);
        $this->lokasi = Session::get('selectedLocation');
        $this->wisatas = Wisata::with('jenis')->whereIn('id', $recommendedWisataIds)
            ->limit(3)
            ->get();
        // $this->wisatas = $wisatas;
        // dd("update di jalankan");
    }

    public function render()
    {
        return view('livewire.component.top-destinasi');
    }
}
