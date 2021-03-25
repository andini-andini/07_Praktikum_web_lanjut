<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'Nim' => '1941720025',
                'Nama' => 'Amelia Widya Andini',
                'Kelas' => 'TI-2I',
                'Jurusan' => 'Teknologi Informasi',
                'Tgl_Lahir' => '2000-01-13',
                'No_Handphone' => '085648989977',
                'Email' => 'andin@gmail.com',
            ],
            [
                'Nim' => '1941720026',
                'Nama' => 'Wahyu Nandira Bakta',
                'Kelas' => 'TI-2H',
                'Jurusan' => 'Teknologi Informasi',
                'Tgl_Lahir' => '2000-03-12',
                'No_Handphone' => '085787893232',
                'Email' => 'nandira@gmail.com',
            ],
            [
                'Nim' => '1941720100',
                'Nama' => 'Della Arselatuiqrom',
                'Kelas' => 'TI-2H',
                'Jurusan' => 'Teknologi Informasi',
                'Tgl_Lahir' => '2001-11-13',
                'No_Handphone' => '082654121236',
                'Email' => 'iqrom@gmail.com',
            ],
            [
                'Nim' => '1941720011',
                'Nama' => 'Abdul Rohman',
                'Kelas' => 'TI-2H',
                'Jurusan' => 'Teknologi Informasi',
                'Tgl_Lahir' => '2000-12-03',
                'No_Handphone' => '082654123123',
                'Email' => 'abdul@gmail.com',
            ],
            [
                'Nim' => '1941720064',
                'Nama' => 'Meliska',
                'Kelas' => 'TI-2H',
                'Jurusan' => 'Teknologi Informasi',
                'Tanggal_lahir' => '2000-06-10',
                'No_Handphone' => '085888321123',
                'Email' => 'meliska@gmail.com',
            ],
            [
                'Nim' => '1941720119',
                'Nama' => 'Ahmad Wildan Fahri',
                'Kelas' => 'TI-2I',
                'Jurusan' => 'Teknologi Informasi',
                'Tgl_Lahir' => '2000-05-23',
                'No_Handphone' => '085888123432',
                'Email' => 'wildan@gmail.com',
            ],
        ];
        DB::table('mahasiswa')->insert($data);
    }
}
