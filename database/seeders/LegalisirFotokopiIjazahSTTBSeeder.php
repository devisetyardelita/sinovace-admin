<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LegalisirFotokopiIjazahSTTBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Budi',
            'nik' => '12345678',
            'alamat' => 'Jl. Botol Kaca',
            'no_hp' => '08123456789',
            'status' => 'Done',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Pudi',
            'nik' => '012345678',
            'alamat' => 'Jl. Botol Kaca',
            'no_hp' => '08323456789',
            'status' => 'Not Started',
        ]);
        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Tomi',
            'nik' => '112233445',
            'alamat' => 'Jl. Mawar Merah',
            'no_hp' => '08211234567',
            'status' => 'Done',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Sari',
            'nik' => '987654321',
            'alamat' => 'Jl. Melati Putih',
            'no_hp' => '08321234567',
            'status' => 'In Progress',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Wina',
            'nik' => '223344556',
            'alamat' => 'Jl. Anggrek Kuning',
            'no_hp' => '08411223344',
            'status' => 'Not Started',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Adi',
            'nik' => '556677889',
            'alamat' => 'Jl. Jambu Air',
            'no_hp' => '08511223344',
            'status' => 'In Progress',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Budi',
            'nik' => '998877665',
            'alamat' => 'Jl. Cempaka Biru',
            'no_hp' => '08554321678',
            'status' => 'Done',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Cici',
            'nik' => '667788990',
            'alamat' => 'Jl. Kenanga Hijau',
            'no_hp' => '08233445566',
            'status' => 'Not Started',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Deni',
            'nik' => '445566778',
            'alamat' => 'Jl. Dahlia Ungu',
            'no_hp' => '08332211445',
            'status' => 'In Progress',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Edi',
            'nik' => '554433221',
            'alamat' => 'Jl. Cemara Hitam',
            'no_hp' => '08442114332',
            'status' => 'Done',
        ]);

        DB::table('legalisir_fotokopi_ijazah_sttb')->insert([
            'nama' => 'Fani',
            'nik' => '332211445',
            'alamat' => 'Jl. Teratai Putih',
            'no_hp' => '08331221134',
            'status' => 'In Progress',
        ]);

    }
}
