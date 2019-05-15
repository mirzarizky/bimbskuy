<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'kode_bimbing',
        'kode_wali',
        'nip',
        'nama',
        'departemen_id',
        'user_id'
    ];

    public function departemen() {
        return $this->belongsTo(Departemen::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function mahasiswaPembimbingan() {
        return $this->hasMany(Mahasiswa::class, 'kode_pembimbing', 'kode_bimbing');
    }

    public function mahasiswaPerwalian() {
        return $this->hasMany(Mahasiswa::class, 'kode_wali', 'kode_wali');
    }
}
