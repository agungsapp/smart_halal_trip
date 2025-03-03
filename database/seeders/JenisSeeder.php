<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['nama' => 'Wisata Alam'], // 1
            ['nama' => 'Danau & Waduk'], // 2
            ['nama' => 'Hutan & Konservasi'], // 3 
            ['nama' => 'Wisata Budaya & Sejarah'], // 4 (gabungan dari sebelumnya)
            ['nama' => 'Wisata Religi'], // 5 (kategori baru)
            ['nama' => 'Pasar Tradisional'], // 6
            ['nama' => 'Taman Kota & Rekreasi'], // 7
            ['nama' => 'Restoran & Kuliner Halal'], // 8
        ];


        foreach ($items as $item) {
            Jenis::create($item);
        }
    }
}
