<?php

namespace App\Livewire\Component;

use App\Models\Wisata;
use Livewire\Component;

class TopDestinasi extends Component
{
    public $wisatas;

    public function mount()
    {
        $this->wisatas = Wisata::orderBy('nama', 'asc')->limit(3)->get();
    }

    // Tambahkan listener untuk event
    protected $listeners = ['recommendationUpdated' => 'updateDestinations'];

    public function updateDestinations($recommendedWisataIds)
    {
        // dd($recommendedWisataIds);

        $this->wisatas = Wisata::whereIn('id', $recommendedWisataIds)
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
