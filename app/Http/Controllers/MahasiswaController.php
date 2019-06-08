<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Dosen;
use App\Mahasiswa;
use App\Notifications\MahasiswaRegistered;
use App\Notifications\MahasiswaRegistration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class MahasiswaController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            // mahasiswa
            'nim'               => 'required|string|min:14|max:14',
            'nama'              => 'required|string|max:35',
            'email'             => 'required|string|email',
            'hp_mahasiswa'      => 'required|numeric|digits_between:10,15',
            'alamat_kos'        => 'required|string|max:255',

            // orangtua
            'hp_ortu'           => 'required|numeric|digits_between:10,15',
            'alamat_ortu'       => 'required|string|max:255',

            // file upload
            'foto'              => 'nullable|image|max:500',
            'krs'               => 'nullable|file|max:500',

            // judul skripsi/pkl
            'tipe_bimbingan'    => 'required|numeric', // 1|2; skripsi|pkl
            'judul'             => 'required|string|max:100',

            // departemen & dosen
            'departemen_id'     => 'required|numeric',
            'kode_wali'         => 'required|numeric',
            'kode_pembimbing'   => 'required|numeric',
            'kode_pembimbing_2' => 'nullable|numeric',
            'kode_pembimbing_3' => 'nullable|numeric',
        ]);

        $dosbing = Dosen::where('kode_bimbing', $request->kode_pembimbing)->first();
        $doswal = Dosen::where('kode_wali', $request->kode_wali)->first();
        $departemen = Departemen::findOrFail($request->departemen_id);

        // validasi dosen pembimbing apakah di departemen yg dipilih mahasiswa
        if(!$dosbing->isInDepartemen($request->departemen_id)){
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => 'Dosen Pembimbing bukan dari Departemen '.Str::ucfirst($departemen->nama)
            ], 422);
        }

        // validasi dosen pembimbing 2 apakah di departemen yg dipilih mahasiswa
        if($request->kode_pembimbing_2){
            $dosbing2 = Dosen::where('kode_bimbing', $request->kode_pembimbing_2)->first();

            if(!$dosbing2->isInDepartemen($request->departemen_id)){
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => 'Dosen Pembimbing 2 bukan dari Departemen '.Str::ucfirst($departemen->nama)
                ], 422);
            }
        }

        // validasi dosen pembimbing 3 apakah di departemen yg dipilih mahasiswa
        if($request->kode_pembimbing_3){
            $dosbing3 = Dosen::where('kode_bimbing', $request->kode_pembimbing_3)->first();

            if(!$dosbing3->isInDepartemen($request->departemen_id)){
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => 'Dosen Pembimbing 2 bukan dari Departemen '.Str::ucfirst($departemen->nama)
                ], 422);
            }
        }

        // validasi dosen wali apakah di departemen yg dipilih mahasiswa
        if(!$doswal->isInDepartemen($request->departemen_id)){
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => 'Dosen Wali bukan dari Departemen '.Str::ucfirst($departemen->nama)
            ], 422);
        }

        $mahasiswa = Mahasiswa::where([
            'nim'               => $request->nim,
            'tipe_bimbingan'    => $request->tipe_bimbingan
        ])->first();

        if(!$mahasiswa) {
            $mahasiswa = Mahasiswa::create([
                'nim'               => $request->nim,
                'nama'              => $request->nama,
                'email'             => $request->email,
                'hp_mahasiswa'      => $request->hp_mahasiswa,
                'alamat_kos'        => $request->alamat_kos,

                // orangtua
                'hp_ortu'           => $request->hp_ortu,
                'alamat_ortu'       => $request->alamat_kos,

                // file upload
                'foto'              => $request->file('foto')->store('foto', 'public'),
                'krs'               => $request->file('krs')->store('krs'),

                // judul skripsi/pkl
                'tipe_bimbingan'    => $request->tipe_bimbingan, // 1|2; skripsi|pkl
                'judul'             => $request->judul,

                // departemen & dosen
                'departemen_id'     => $request->departemen_id,
                'kode_wali'         => $request->kode_wali,
                'kode_pembimbing'   => $request->kode_pembimbing,
                'kode_pembimbing_2' => ($request->kode_pembimbing_2 ? $request->kode_pembimbing_2 : null),
                'kode_pembimbing_3' => ($request->kode_pembimbing_3 ? $request->kode_pembimbing_3 : null),
            ]);

            User::find($dosbing->user_id)->notify(new MahasiswaRegistered($mahasiswa));

            if(!empty($dosbing2)) {
                User::find($dosbing2->user_id)->notify(new MahasiswaRegistered($mahasiswa, 2));
            }

            if(!empty($dosbing2)) {
                User::find($dosbing3->user_id)->notify(new MahasiswaRegistered($mahasiswa, 3));
            }

            Notification::send($mahasiswa, new MahasiswaRegistration($mahasiswa));
        } else {
            return response()->json(['message' => 'Mahasiswa dengan nim telah terdaftar'], 422);
        }

        return response()->json(['message' => 'Berhasil terdaftar.']);
    }
}
