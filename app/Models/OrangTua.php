<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = "orang_tuas";
    protected $primayKey = 'id';

    protected $fillable = [
        'nama', 'id_siswa',
    ];
    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function orangTua() {
        return $this->hasMany(Siswa::class, 'id_siswa');
    }
}
