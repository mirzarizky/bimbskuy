<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Http\Resources\MahasiswaResource;
use App\Mahasiswa;
use App\Notifications\MahasiswaApproved;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Dosen pembimbing utama approve registrasi mahasiswa bimbingannya
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $currentDosen = Dosen::where('user_id', $request->user()->id)->first();

        if(!$mahasiswa->isPembimbing($currentDosen->kode_bimbing)) {
            return response()->json([
                'message' => 'Hanya dosen pembimbing utama yang dapat menyetujui registarsi mahasiswa.'
            ], 422);
        }
        else {
            $user = User::where('email', $mahasiswa->email)->first();
            if($user) {
                $mahasiswa->user_id = $user->id;
                $mahasiswa->save();
            }

            else {
                $role_mahasiswa = Role::where('name', 'mahasiswa')->first();

                $newUser = User::create([
                    'name'       => $mahasiswa->nama,
                    'email'     => $mahasiswa->email,
                    'avatar'    => $mahasiswa->foto,
                    'role_id'   => $role_mahasiswa->id
                ]);
                $newUser->roles()->save($role_mahasiswa);

                $mahasiswa->user_id = $newUser->id;
                $mahasiswa->save();

                $newUser->notify(new MahasiswaApproved($mahasiswa));
            }


//            TODO: notify mahasiswa

            return response()->json(['message' => 'Mahasiswa berhasil diverifikasi.']);
        }
    }

    // delete registrasi mahasiswa
    public function deleteMahasiswa(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $currentDosen = Dosen::where('user_id', $request->user()->id)->first();

        if(!$mahasiswa->isPembimbing($currentDosen->kode_bimbing)) {
            return response()->json([
                'message' => 'Hanya dosen pembimbing utama yang dapat menghapus registarsi mahasiswa.'
            ], 422);
        }
        else {
            if (Storage::exists($mahasiswa->krs)) {
                Storage::delete([
                    $mahasiswa->foto,
                    $mahasiswa->krs,
                ]);
            }
            $mahasiswa->delete();
            return response()->json(['message' => 'Mahasiswa berhasil dihapus.']);
        }

    }

    public function getAwaitedMahasiswa(Request $request)
    {
        $dosen = Dosen::where('user_id', $request->user()->id)->first();

        $mahasiswa = Mahasiswa::where([
            'kode_pembimbing' => $dosen->kode_bimbing,
            'user_id' => null
        ])->get();

        return response()->json(['mahasiswa' => MahasiswaResource::collection($mahasiswa)]);
    }
}
