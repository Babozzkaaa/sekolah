<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class KelasController extends Controller
{
    public function getKelas(Request $request) {

        $kelas = Kelas::with('guru')->orderBy('created_at', 'desc')->paginate(10);
        // $kelas = Kelas::orderBy('created_at', 'desc')->paginate(10);
        // $guru = Guru::all();

        // dd($kelas);
        return Inertia::render('Kelas/List', [
            'kelas' => $kelas,
            // 'guru' => $guru,
        ]);
    }

    public function create() {
        $guru = Guru::all();
        return Inertia::render('Kelas/Create', [
            'guru' => $guru
        ]);
    }

    public function createData(Request $request) {
        $validated = $this->ValidatedData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        Kelas::create($validated['data']);

        return redirect()->route('kelas.list')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit($id) {
        $kelas = Kelas::findOrFail($id);
        // $guru = Guru::findOrFail($id);
        $guru = Guru::all();
        return Inertia::render('Kelas/Edit', [
            'kelas' => $kelas,
            'guru' => $guru
        ]);
    }

    public function editData(Request $request, $id) {
        $validated = $this->validatedData($request);

        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validated['data']);

        return redirect()->route('kelas.list')->with('success', 'Data kelas berhasil diubah.');
    }

    public function delete($id) {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.list')->with('success', 'Data kelas berhasil dihapus.');
    }

    private function validatedData(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_wali_kelas' => 'required|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        return [
            'success' => true,
            'data' => $validator->validated()
        ];
    }
}
