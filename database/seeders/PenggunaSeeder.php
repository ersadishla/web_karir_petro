<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengguna')->insert([
            'nama'          => 'Admin Karir Bang SDM',
            'username'      => 'admin',
            'password'      => Hash::make('admin'),
            'email'         => 'admin@petrokimia.id',
            'id_peran'          => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('pengguna')->insert([
            'nama'          => 'Pegawai',
            'username'      => 'pegawai',
            'password'      => Hash::make('pegawai'),
            'email'         => 'pegawai@petrokimia.id',
            'id_peran'          => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        //
    }
}
