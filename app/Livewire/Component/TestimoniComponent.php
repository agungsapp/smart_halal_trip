<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Feedback;

class TestimoniComponent extends Component
{
    public function render()
    {
        // Ambil semua data feedback dari database
        $testimonis = Feedback::all();

        return view('livewire.component.testimoni-component', [
            'testimonis' => $testimonis,
        ]);
    }
}
