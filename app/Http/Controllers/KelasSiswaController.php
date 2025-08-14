<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class KelasSiswaController extends Controller
{
    public function getKelasSiswa() {
        $kelassiswa =  KelasSiswa::with(['kelas', 'siswa'])->orderBy('created_at', 'desc')
        ->paginate(10);

        return Inertia::render('KelasSiswa/List', [
            'kelassiswa' => $kelassiswa,
        ]);
    }

    public function create() {
        $kelas = Kelas::all();
        // $siswa = Siswa::all();
        $siswa = Siswa::whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('kelas_siswa')
                ->whereRaw('kelas_siswa.id_siswa = siswas.id');
        })->get();

        return Inertia::render('KelasSiswa/Create', [
            'kelas' => $kelas,
            'siswa' => $siswa,
        ]);
    }

    public function createData(Request $request) {
        $validated = $this->validateData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        foreach ($validated['data'] as $data) {
            KelasSiswa::create($data);
        }

        return redirect()->route('kelas-siswa.list')->with('success', 'Data kelas siswa berhasil ditambahkan.');
    }

    public function edit($id) {
        $kelassiswa = KelasSiswa::findOrFail($id);
        $kelas = Kelas::all();
        $siswa = Siswa::whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('kelas_siswa')
                ->whereRaw('kelas_siswa.id_siswa = siswas.id');
        })->orWhere('id', $kelassiswa->id_siswa)->get();

        return Inertia::render('KelasSiswa/Edit', [
            'kelassiswa' => $kelassiswa,
            'kelas' => $kelas,
            'siswa' => $siswa,
        ]);
    }

    public function editData(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|exists:kelas,id',
            'id_siswa' => 'required|exists:siswas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $kelassiswa = KelasSiswa::findOrFail($id);
        $kelassiswa->update($request->only(['id_kelas', 'id_siswa']));

        return redirect()->route('kelas-siswa.list')->with('success', 'Data kelas siswa berhasil diubah.');
    }

    public function delete($id) {
        $kelassiswa = KelasSiswa::findOrFail($id);
        $kelassiswa->delete();

        return redirect()->route('kelas-siswa.list')->with('success', 'Data kelas siswa berhasil dihapus.');
    }

    private function validateData(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|exists:kelas,id',
            'id_siswa' => 'required|array',
            'id_siswa.*' => 'required|exists:siswas,id',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
            ];
        }

        $data = [];
        foreach ($request->id_siswa as $siswa) {
            $data[] = [
                'id_kelas' => $request->id_kelas,
                'id_siswa' => $siswa,
            ];
        }

        return [
            'success' => true,
            'data' => $data
        ];
    }
}
