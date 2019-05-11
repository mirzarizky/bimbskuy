<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        \Illuminate\Support\Facades\DB::table('roles')->insert([
            ['name' => 'mahasiswa', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dosen wali', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dosen pembimbing', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
