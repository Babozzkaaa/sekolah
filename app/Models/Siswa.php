<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'nis',
        'jenis_kelamin',
        'tanggal_lahir'
    ];
    public function orangTua() {
        // return $this->belongsTo(OrangTua::class, 'id');
        return $this->hasMany(OrangTua::class, 'id_siswa');
        // return $this->hasMany(OrangTua::class, 'id_siswa');
        // return $this->hasOne(OrangTua::class, 'id_siswa');
    }
}
