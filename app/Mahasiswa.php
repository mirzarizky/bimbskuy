<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Model
{
    use Notifiable;

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

    public function dosenPembimbing2() {
        return $this->belongsTo(Dosen::class, 'kode_pembimbing_2', 'kode_bimbing');
    }

    public function dosenPembimbing3() {
        return $this->belongsTo(Dosen::class, 'kode_pembimbing_3', 'kode_bimbing');
    }

    /**
     * Cek apakah pembimbing utamanya adalah benar pembimbingnya
     *
     * @param $kode_bimbing
     * @return bool
     */
    public function isPembimbing($kode_bimbing) {
        if($kode_bimbing == $this->kode_pembimbing) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fungsi helper untuk return tipe bimbingann
     *
     * @return string|null
     *
     */
    public function jenisBimbingan() {
        switch ($this->tipe_bimbingan) {
            case 1: return 'Tugas Akhir';
            break;
            case 2: return 'PKL';
            break;
            default: return null;
            break;
        }
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
