<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'departemen_id',
        'alamat_ortu',
        'alamat_kos',
        'hp_ortu',
        'hp_mahasiswa',
        'email',
        'foto',
        'krs',
        'tipe_bimbingan',       // 1|2 ; skripsi|pkl
        'judul',                // judul skripsi/pkl
        'nilai',                // A|B|C|D|E default:null
        'berita_acara',         // file upload default:null
        'kode_wali',            // kode dosen wali
        'kode_pembimbing',      // kode dosen pembimbing utama
        'kode_pembimbing_2',    // kode dosen pembimbing kedua | default:null | nullable
        'kode_pembimbing_3',    // kode dosen pembimbing ketiga | default:null | nullable
        'user_id'
    ];

    public function departemen() {
        return $this->belongsTo(Departemen::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dosenWali() {
        return $this->belongsTo(Dosen::class, 'kode_wali', 'kode_wali');
    }

    public function dosenPembimbing() {
        return $this->belongsTo(Dosen::class, 'kode_pembimbing', 'kode_bimbing');
    }
}
