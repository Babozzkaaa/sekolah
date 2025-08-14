<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    protected $table = 'kelas_siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kelas',
        'id_siswa',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
