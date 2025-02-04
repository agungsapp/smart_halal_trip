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
            ['nama' => 'swasta'],
            ['nama' => 'desa'],
            ['nama' => 'kemenhut'],

        ];

        foreach ($items as $item) {
            Jenis::create($item);
        }
    }
}
