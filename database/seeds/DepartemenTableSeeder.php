<?php

use Illuminate\Database\Seeder;

class DepartemenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        \Illuminate\Support\Facades\DB::table('departemen')->insert([
            ['nama' => 'biologi', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'kimia', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'informatika', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'fisika', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'matematika', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'statistika', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
