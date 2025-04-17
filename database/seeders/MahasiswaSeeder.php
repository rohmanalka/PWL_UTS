<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_mahasiswa' => 1, 'nim' => '2341760001', 'nama' => 'm rohman al k'],
            ['id_mahasiswa' => 2, 'nim' => '2341760002', 'nama' => 'iga ramadhan'],
            ['id_mahasiswa' => 3, 'nim' => '2341760003', 'nama' => 'm bhimantara'],
            ['id_mahasiswa' => 4, 'nim' => '2341760004', 'nama' => 'ivan rizal'],
            ['id_mahasiswa' => 5, 'nim' => '2341760005', 'nama' => 'm zacky y'],
            ['id_mahasiswa' => 6, 'nim' => '2341760006', 'nama' => 'malik adzano'],
            ['id_mahasiswa' => 7, 'nim' => '2341760007', 'nama' => 'luthfi mahardika'],
            ['id_mahasiswa' => 8, 'nim' => '2341760008', 'nama' => 'alfin afrian'],
        ];
        DB::table('mahasiswa')->insert($data);
    }
}
