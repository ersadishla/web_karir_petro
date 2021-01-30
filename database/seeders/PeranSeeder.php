<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peran')->insert([
            'id_peran'            => 1,
            'nama'          => 'Admin',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('peran')->insert([
            'id_peran'            => 2,
            'nama'          => 'Pegawai',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        //
    }
}
