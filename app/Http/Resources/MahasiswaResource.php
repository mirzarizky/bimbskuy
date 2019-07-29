<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'nim' => $this->nim,
            'nama' => $this->nama,
            'departemen_id' => $this->departemen_id,
            'alamat_ortu' => $this->alamat_ortu,
            'alamat_kos' => $this->alamat_kos,
            'hp_ortu' => $this->hp_ortu,
            'hp_mahasiswa' => $this->hp_mahasiswa,
            'email' => $this->email,
            'foto' => $this->foto,
            'krs' => $this->krs,
            'tipe_bimbingan' => $this->tipe_bimbingan,       // 1|2 ; skripsi|pkl
            'judul' => $this->judul,                // judul skripsi/pkl
            'nilai' => $this->nilai,                // A|B|C|D|E default:null
            'berita_acara' => $this->berita_acara,         // file upload default:null
            'kode_wali' => $this->kode_wali,            // kode dosen wali
            'kode_pembimbing' => $this->kode_pembimbing,      // kode dosen pembimbing utama
            'kode_pembimbing_2' => $this->kode_pembimbing_2,    // kode dosen pembimbing kedua | default:null | nullable
            'kode_pembimbing_3' => $this->kode_pembimbing_3,    // kode dosen pembimbing ketiga | default:null | nullable
            'user_id' => $this->user_id,
            'dosen_wali' => $this->dosenWali,
            'dosen_pembibing' => $this->dosenPembimbing,
            'dosen_pembibing2' => $this->dosenPembimbing2,
            'dosen_pembibing3' => $this->dosenPembimbing3
        ];
    }
}
