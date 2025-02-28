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
            ['nama' => 'Gunung & Perbukitan'], // 2
            ['nama' => 'Pantai & Kepulauan'], // 3 
            ['nama' => 'Danau & Waduk'], // 4
            ['nama' => 'Hutan & Konservasi'], // 5 
            ['nama' => 'Wisata Budaya & Sejarah'], // 6 (gabungan dari sebelumnya)
            ['nama' => 'Wisata Religi'], // 7 (kategori baru)
            ['nama' => 'Pasar Tradisional'], // 8
            ['nama' => 'Taman Kota & Rekreasi'], // 9
            ['nama' => 'Restoran & Kuliner Halal'], // 10
            ['nama' => 'Hotel & Penginapan Syariah'], // 11
            ['nama' => 'Wisata Petualangan & Olahraga'], // 12
            ['nama' => 'Wisata Kuliner'], // 13
        ];


        foreach ($items as $item) {
            Jenis::create($item);
        }
    }
}
