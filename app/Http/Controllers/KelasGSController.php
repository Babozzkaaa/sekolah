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
    public function getGuruByKelas() {
        $kelasguru = KelasGuru::with(['guru', 'kelas'])
            ->join('kelas', 'kelas_guru.id_kelas', '=', 'kelas.id')
            ->orderBy('kelas.nama', 'asc')
            ->select('kelas_guru.*')
            ->paginate(10);

        return Inertia::render('KelasGS/ListGK', [
            'kelasguru' => $kelasguru,
        ]);
    }
    // public function getGuruByKelas($id_kelas) {
    //     $kelasguru = KelasGuru::with('guru')->where('id_kelas', $id_kelas)->paginate(10);
    //     $kelas = Kelas::find($id_kelas);
    //     // dd($kelasguru);
    //     return Inertia::render('KelasGS/ListGK', [
    //         'kelasguru' => $kelasguru,
    //         'kelas' => $kelas,
    //     ]);
    // }

    public function getSiswaByKelas() {
        $kelassiswa = KelasSiswa::with(['siswa','kelas'])
        ->join('kelas', 'kelas_siswa.id_kelas', '=', 'kelas.id')
        ->orderBy('kelas.nama', 'asc')
        ->select('kelas_siswa.*')
        ->paginate(10);
        return Inertia::render('KelasGS/ListKS', [
            'kelassiswa' => $kelassiswa,
        ]);
    }
    // public function getSiswaByKelas($id_kelas) {
    //     $kelassiswa = KelasSiswa::with('siswa')->where('id_kelas', $id_kelas)->paginate(10);
    //     $kelas = Kelas::find($id_kelas);
    //     return Inertia::render('KelasGS/ListKS', [
    //         'kelassiswa' => $kelassiswa,
    //         'kelas' => $kelas,
    //     ]);
    // }

    public function getKelasGuruSiswa() {
        // $kelasguru = KelasGuru::with(['guru', 'kelas'])
        //     ->join('kelas', 'kelas_guru.id_kelas', '=', 'kelas.id')
        //     ->orderBy('kelas.nama', 'asc')
        //     ->select('kelas_guru.*')
        //     ->paginate(10);
            
        // $kelassiswa = KelasSiswa::with(['siswa','kelas'])
        // ->join('kelas', 'kelas_siswa.id_kelas', '=', 'kelas.id')
        // ->orderBy('kelas.nama', 'asc')
        // ->select('kelas_siswa.*')
        // ->paginate(10);

        // $kelasgs = array($kelasguru, $kelassiswa);

        // $kelasgs = array_merge($kelassiswa->toArray(), $kelasguru->toArray());
        // $kelasgs = $kelasguru->merge($kelassiswa);

        $gabung = Kelas::with(['kelasGuru.guru', 'kelasSiswa.siswa'])
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $gabung->getCollection()->transform(function ($kelas) {
            return [
                'kelas' => $kelas->nama,
                'guru' => $kelas->kelasGuru->pluck('guru.nama')->toArray(),
                'siswa' => $kelas->kelasSiswa->pluck('siswa.nama')->toArray(),
            ];
        });

        $kelasgs = $gabung;
        
        // dd($kelasgs);

        return Inertia::render('KelasGS/List', [
            'kelasgs' => $kelasgs,
            // 'kelasguru' => $kelasguru,
            // 'kelassiswa' => $kelassiswa,
        ]);
    }
    // public function getKelasGuruSiswa($id_kelas) {
    //     $kelasguru = KelasGuru::with(['kelas', 'guru'])->where('id_kelas', $id_kelas)->orderBy('created_at', 'desc')->paginate(10);
    //     $kelassiswa = KelasSiswa::with(['kelas', 'siswa'])->where('id_kelas', $id_kelas)->orderBy('created_at', 'desc')->paginate(10);
    //     $kelas = Kelas::find($id_kelas);
    //     // dd($kelasguru, $kelassiswa);

    //     return Inertia::render('KelasGS/List', [
    //         'kelasguru' => $kelasguru,
    //         'kelassiswa' => $kelassiswa,
    //         'kelas' => $kelas,
    //     ]);
    // }
}
