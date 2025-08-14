<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasGuru extends Model
{
    protected $table = 'kelas_guru';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kelas',
        'id_guru',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function guru() {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
