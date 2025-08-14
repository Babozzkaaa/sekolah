<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class GuruController extends Controller
{
    public function getGuru(Request $request) {

        $guru = Guru::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Guru/List', [
            'guru' => $guru,
        ]);
    }

    public function create() {
        return Inertia::render('Guru/Create');
    }

    public function createData(Request $request) {
        $validated = $this->ValidatedData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        Guru::create($validated['data']);

        return redirect()->route('guru.list')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id) {
        $guru = Guru::findOrFail($id);
        return Inertia::render('Guru/Edit', [
            'guru' => $guru
        ]);
    }

    public function editData(Request $request, $id) {
        $validated = $this->validatedData($request);

        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        $guru = Guru::findOrFail($id);
        $guru->update($validated['data']);

        return redirect()->route('guru.list')->with('success', 'Data guru berhasil diubah.');
    }

    public function delete($id) {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.list')->with('success', 'Data guru berhasil dihapus.');
    }

    private function validatedData(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|min:1|max:8|unique:gurus,nip',
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
