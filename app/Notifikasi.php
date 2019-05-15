<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = [
        'message',
        'read_at',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
