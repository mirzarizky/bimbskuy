<?php

use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosens = \App\Dosen::all();

        foreach ($dosens as $dosen) {
            factory(App\Mahasiswa::class, 10)->create([
                'departemen_id'      => $dosen->departemen_id,
                'kode_wali'         => $dosen->kode_wali,
                'kode_pembimbing'   => $dosen->kode_bimbing,

            ])->each(function ($mhs) {
                $newUser = factory(App\User::class)->create([
                    'name'      => $mhs->nama,
                    'email'     => $mhs->email,
                    'role_id'   => 1
                ]);

                $newUser->roles()->save(\App\Role::where('id', 1)->first());

                $mhs->user_id = $newUser->id;
                $mhs->save();
            });
        }
    }
}
