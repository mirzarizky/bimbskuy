<?php

use Illuminate\Database\Seeder;

class DosenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Dosen::class, 100)->create()->each(function ($dosen) {

            $user = factory(App\User::class)->create([
                'name' => $dosen->nama,
            ]);

            $user->roles()->saveMany([
                \App\Role::where('id', 3)->first(),
                \App\Role::where('id', 4)->first(),
            ]);

            $dosen->user_id = $user->id;
            $dosen->save();
        });
    }
}
