<?php

use Illuminate\Database\Seeder;

class NotifikasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Notifikasi::class, 1000)->create();
    }
}
