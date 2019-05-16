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
        factory(App\Dosen::class, 50)->create()->each(function ($dosen) {

            $user = factory(App\User::class)->create([
                'name'      => $dosen->nama,
                'role_id'   => 3,
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
