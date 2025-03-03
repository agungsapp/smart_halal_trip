<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Feedback;

class FeedbackComponent extends Component
{
    public $nama;
    public $kota_asal;
    public $ulasan;


    public $showFeedback = false;
    public $isSubmit = false;


    // Dengarkan event recommendationUpdated dari CariLokasi
    protected $listeners = [
        'recommendationUpdated' => 'showFeedbackComponent',
    ];

    // Method untuk mengatur visibilitas feedback component
    public function showFeedbackComponent()
    {
        $this->showFeedback = true;
    }

    // Aturan validasi
    protected $rules = [
        'nama' => 'required|string|max:255',
        'kota_asal' => 'required|string|max:255',
        'ulasan' => 'required|string',
    ];

    public function submit()
    {
        // Validasi data
        $this->validate();

        // Simpan feedback ke database
        Feedback::create([
            'nama' => $this->nama,
            'kota_asal' => $this->kota_asal,
            'ulasan' => $this->ulasan,
        ]);

        // Reset form setelah submit
        $this->reset(['nama', 'kota_asal', 'ulasan']);

        // Berikan notifikasi sukses
        session()->flash('message', 'Feedback berhasil dikirim!');

        $this->isSubmit = true;
    }

    public function render()
    {
        return view('livewire.component.feedback-component');
    }
}
