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
            ['nama' => 'alam'],
            ['nama' => 'pantai'],
            ['nama' => 'hutan'],
            ['nama' => 'cagar budaya'],

        ];

        foreach ($items as $item) {
            Jenis::create($item);
        }
    }
}
