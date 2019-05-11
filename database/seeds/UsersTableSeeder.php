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
        factory(App\User::class, 15)->create()->each(function ($user) {
            switch ($user->role_id) {
                case 1:
                    $user->roles()->save(\App\Role::where('id',1)->first());
                    break;
                case 2:
                    $user->roles()->save(\App\Role::where('id', 2)->first());
                    break;
                case 3:
                    $user->roles()->saveMany([
                        \App\Role::where('id', 3)->first(),
                        \App\Role::where('id', 4)->first(),
                    ]);
                    break;
            }

        });
    }
}
