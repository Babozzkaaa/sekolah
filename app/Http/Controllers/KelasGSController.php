<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KelasGSController extends Controller
{
    public function getGuruByKelas($id_kelas) {
        $kelasguru = KelasGuru::with('guru')->where('id_kelas', $id_kelas)->paginate(10);
        $kelas = Kelas::find($id_kelas);
        // dd($kelasguru);
        return Inertia::render('KelasGS/ListGK', [
            'kelasguru' => $kelasguru,
            'kelas' => $kelas,
        ]);
    }

    public function getSiswaByKelas($id_kelas) {
        $kelassiswa = KelasSiswa::with('siswa')->where('id_kelas', $id_kelas)->paginate(10);
        $kelas = Kelas::find($id_kelas);
        return Inertia::render('KelasGS/ListKS', [
            'kelassiswa' => $kelassiswa,
            'kelas' => $kelas,
        ]);
    }

    public function getKelasGuruSiswa($id_kelas) {
        $kelasguru = KelasGuru::with(['kelas', 'guru'])->where('id_kelas', $id_kelas)->orderBy('created_at', 'desc')->paginate(10);
        $kelassiswa = KelasSiswa::with(['kelas', 'siswa'])->where('id_kelas', $id_kelas)->orderBy('created_at', 'desc')->paginate(10);
        $kelas = Kelas::find($id_kelas);
        // dd($kelasguru, $kelassiswa);

        return Inertia::render('KelasGS/List', [
            'kelasguru' => $kelasguru,
            'kelassiswa' => $kelassiswa,
            'kelas' => $kelas,
        ]);
    }
}
