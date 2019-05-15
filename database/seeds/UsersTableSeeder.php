<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        factory(App\User::class, 6)->create()->each(function ($user) {
            $user->roles()->save(\App\Role::where('id', 2)->first());
        });

        // Mahasiswa
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->roles()->save(\App\Role::where('id', 1)->first());
        });

    }
}
