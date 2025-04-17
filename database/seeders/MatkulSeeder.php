<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_matkul' => 1, 'nama_matkul' => 'APSI', 'nama_dosen' => 'Bu Vivin'],
            ['id_matkul' => 2, 'nama_matkul' => 'Data Warehouse', 'nama_dosen' => 'Bu Vit'],
            ['id_matkul' => 3, 'nama_matkul' => 'PWL', 'nama_dosen' => 'Bu Priska'],
            ['id_matkul' => 4, 'nama_matkul' => 'Statistika', 'nama_dosen' => 'Bu Ridzda'],
            ['id_matkul' => 5, 'nama_matkul' => 'Bing Lanjut', 'nama_dosen' => 'Mam Farida'],
            ['id_matkul' => 6, 'nama_matkul' => 'Pancasila', 'nama_dosen' => 'Bu Wida'],
            ['id_matkul' => 7, 'nama_matkul' => 'Data Mining', 'nama_dosen' => 'Pak Rudi'],
        ];
        DB::table('matakuliah')->insert($data);
    }
}
