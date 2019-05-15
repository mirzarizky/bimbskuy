<?php

use Illuminate\Database\Seeder;

class TransaksiBimbinganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_mahasiswa = \App\Mahasiswa::all();

        foreach ($all_mahasiswa as $mhs) {
            factory(App\TransaksiBimbingan::class)->create([
                'nim'                   => $mhs->nim,
                'jenis_bimbingan'       => $mhs->tipe_bimbingan,
                'kode_pembimbing'       => $mhs->kode_pembimbing,
                'approved_at'           => now(),
                'prosentase'            => 5
            ]);

            // belum di-approve
            factory(App\TransaksiBimbingan::class)->create([
                'nim'                   => $mhs->nim,
                'jenis_bimbingan'       => $mhs->tipe_bimbingan,
                'kode_pembimbing'       => $mhs->kode_pembimbing,
            ]);
        }
    }
}
