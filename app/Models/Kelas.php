<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        // 'id_siswa',
        // 'id_guru',
        'id_wali_kelas'
    ];

    public function guru() {
        return $this->belongsTo(Guru::class, 'id_wali_kelas');
    }
    public function kelasGuru() {
        return $this->hasMany(KelasGuru::class, 'id_kelas');
    }

    public function kelasSiswa() {
        return $this->hasMany(KelasSiswa::class, 'id_kelas');
    }
}
