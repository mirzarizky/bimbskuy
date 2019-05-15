<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiBimbingan extends Model
{
    protected $table = 'transaksi_bimbingan';

    protected $fillable = [
        'nim',
        'jenis_bimbingan',  // 1|2 ; skripsi|pkl
        'uraian_materi',
        'prosentase',       // nullable
        'approved_at',      // nulllable
        'kode_pembimbing'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'kode_bimbing', 'kode_pembimbing');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}
