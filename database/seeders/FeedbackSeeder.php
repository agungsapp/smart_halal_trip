<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nama' => 'Rahmat',
                'kota_asal' => 'Bandar Lampung, Indonesia',
                'ulasan' => '"Sangat membantu! Saya jadi lebih mudah menemukan destinasi wisata sesuai minat saya. Rekomendasinya juga akurat!"'
            ],
            [
                'nama' => 'Dewi Lestari',
                'kota_asal' => 'Lampung, Indonesia',
                'ulasan' => '"Aplikasi ini sangat membantu dalam merencanakan liburan saya. Saya menemukan tempat yang belum pernah saya kunjungi sebelumnya!"'
            ],
            [
                'nama' => 'Andi Wijaya',
                'kota_asal' => 'Lampung, Indonesia',
                'ulasan' => '"Saya tidak menyangka sistem ini bisa merekomendasikan tempat yang sesuai dengan keinginan saya! Sangat direkomendasikan!"'
            ],
        ];

        foreach ($items as $item) {
            Feedback::create($item);
        }
    }
}
