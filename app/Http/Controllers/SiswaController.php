<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SiswaController extends Controller
{
    public function getSiswa(Request $request) {

        $siswa = Siswa::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Siswa/List', [
            'siswa' => $siswa,
        ]);
    }

    public function create() {
        return Inertia::render('Siswa/Create');
    }

    public function createData(Request $request) {
        $validated = $this->ValidatedData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        Siswa::create($validated['data']);

        return redirect()->route('siswa.list')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id) {
        $siswa = Siswa::findOrFail($id);
        return Inertia::render('Siswa/Edit', [
            'siswa' => $siswa
        ]);
    }

    public function editData(Request $request, $id) {
        $validated = $this->validatedData($request);

        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        $siswa = Siswa::findOrFail($id);
        $siswa->update($validated['data']);

        return redirect()->route('siswa.list')->with('success', 'Data siswa berhasil diubah.');
    }

    public function delete($id) {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.list')->with('success', 'Data siswa berhasil dihapus.');
    }

    private function validatedData(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|min:1|max:8|unique:siswas,nis',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
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
