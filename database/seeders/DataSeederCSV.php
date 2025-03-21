<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataSeederCSV extends Seeder
{


    public function run(): void
    {
        $this->seedFromCSV('seeder/data_wisatas.csv', 'wisata');
        $this->seedFromCSV('seeder/resto_image.csv', 'restoran');
    }

    private function seedFromCSV($csvFilePath, $type): void
    {
        $filePath = public_path($csvFilePath);
        if (!file_exists($filePath) || ($handle = fopen($filePath, "r")) === FALSE) {
            Log::error("Gagal membuka file CSV: {$csvFilePath}");
            return;
        }

        $header = fgetcsv($handle); // Skip header
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) < 4) {
                Log::warning("Baris tidak lengkap di {$csvFilePath}:", $data);
                continue;
            }

            // Pemetaan kolom berdasarkan tipe
            if ($type === 'wisata') {
                $id = $data[0]; // Kolom id
                $nama = $data[1]; // nama_lokasi
                $alamat = $data[2] ?? 'N/A';
                $lat = $data[3] ?? '0'; // latitude
                $long = $data[4] ?? '0'; // longitude
                $idJenis = $data[5] ?? null; // jenis
                $images = $data[6] ?? 'default.png'; // path image
            } else { // restoran
                $id = null; // Resto tidak punya ID di CSV
                $nama = $data[0]; // nama
                $alamat = $data[1] ?? 'N/A';
                $lat = $data[2] ?? '0'; // lat
                $long = $data[3] ?? '0'; // long
                $idJenis = 8; // Default untuk restoran (wisata kuliner)
                $images = $data[4] ?? 'default.png'; // path image
            }

            // Ekstrak nama kota dari alamat
            $namaKota = $this->extractCityName($alamat, $nama);

            // Cari atau buat kota
            $kota = Kota::firstOrCreate(
                ['nama' => $namaKota],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );

            // Masukkan data ke tabel wisatas
            $insertData = [
                'nama' => $nama,
                'id_jenis' => $idJenis,
                'id_kota' => $kota->id,
                'alamat' => $alamat,
                'lat' => $lat,
                'long' => $long,
                'image' => 'foto-wisata/' .  $images,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            if ($type === 'wisata' && $id) {
                $insertData['id'] = $id; // Hanya wisata yang punya ID spesifik
            }

            DB::table('wisatas')->insert($insertData);
        }

        fclose($handle);
        Log::info("Selesai seeding data dari: {$csvFilePath}");
    }

    private function extractCityName($alamat, $nama): string
    {
        try {
            $alamatParts = array_map('trim', explode(',', $alamat));
            $namaKota = 'Unknown';

            // Cari pola "Bandar Lampung, Lampung"
            foreach ($alamatParts as $index => $part) {
                if (strtolower($part) === 'lampung' && $index > 0) {
                    $namaKota = $alamatParts[$index - 1];
                    break;
                }
            }

            // Jika tidak ada provinsi, ambil bagian pertama yang bukan nama lokasi
            if ($namaKota === 'Unknown' && !empty($alamatParts[0]) && strtolower($alamatParts[0]) !== strtolower($nama)) {
                $namaKota = $alamatParts[0];
            }

            return $namaKota;
        } catch (\Throwable $th) {
            Log::error("Gagal parsing alamat: {$alamat}", ['error' => $th->getMessage()]);
            return 'Unknown';
        }
    }
}
