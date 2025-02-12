<?php

namespace Database\Seeders;

use App\Models\Kota;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataSeederCSV extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->wisatas();
    }

    public function wisatas()
    {
        $csvFilePath = public_path('seeder/data_wisata.csv');
        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
            $header = fgetcsv($handle); // Baca header

            while (($data = fgetcsv($handle)) !== FALSE) {
                // Pastikan jumlah kolom sesuai
                if (count($data) < 5) {
                    Log::warning('Skipping incomplete row:', $data);
                    continue;
                }

                // Ekstrak nama kota dari alamat
                try {
                    $alamat = $data[2];
                    $namaKota = trim(explode(',', $alamat)[0]);
                } catch (\Throwable $th) {
                    $namaKota = 'Unknown'; // Default jika gagal parsing
                }

                // Cari atau buat data kota
                $kota = Kota::firstOrCreate(
                    ['nama' => $namaKota],
                    [
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );

                // Insert data wisata dengan id_kota yang sesuai
                DB::table('wisatas')->insert([
                    'id' => $data[0],
                    'nama' => $data[1],
                    'id_jenis' => $data[5],
                    'id_kota' => $kota->id,
                    'alamat' => $data[2] ?? 'N/A',
                    'lat' => $data[3] ?? '0', // Default value jika latitude kosong
                    'long' => $data[4] ?? '0', // Default value jika longitude kosong
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            fclose($handle);
        }
    }
    // public function wisatas()
    // {
    //     $csvFilePath = public_path('seeder/wisatas.csv');
    //     if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
    //         $header = fgetcsv($handle);
    //         while (($data = fgetcsv($handle)) !== FALSE) {
    //             DB::table('wisatas')->insert([
    //                 'id' => $data[0],
    //                 'nama' => $data[1],
    //                 'id_jenis' => 1,
    //                 'alamat' => $data[2],
    //                 'lat' => $data[3],
    //                 'long' => $data[4],
    //                 'created_at' => Carbon::now(),
    //                 'updated_at' => Carbon::now(),

    //             ]);
    //         }
    //         fclose($handle);
    //     }
    // }
}
