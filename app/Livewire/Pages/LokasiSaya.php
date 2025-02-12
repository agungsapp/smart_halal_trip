<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class LokasiSaya extends Component
{
    public $savedLocation = null;

    // Listener untuk menerima data dari JavaScript
    protected $listeners = ['setSavedLocation'];

    public function setSavedLocation($location)
    {
        // Simpan lokasi ke properti komponen
        $this->savedLocation = $location;
    }

    public function mount()
    {
        // Cek jika ada lokasi tersimpan saat komponen dimuat
        if (session()->has('selectedLocation')) {
            $this->savedLocation = session('selectedLocation');
        }
    }

    public function render()
    {
        return view('livewire.pages.lokasi-saya');
    }
}
