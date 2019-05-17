<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Mahasiswa;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
            }

//            TODO: notify mahasiswa

            return response()->json(['message' => 'User successfully created']);
        }
    }
}
