<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrangTuaController extends Controller
{
    public function getOT(Request $request) {

        $orang_tua = OrangTua::with('siswa')->orderBy('created_at', 'desc')->paginate(10);

        // dd($ot);
        return Inertia::render('OT/List', [
            'orang_tua' => $orang_tua,
            // 'guru' => $guru,
        ]);
    }

    public function create() {
        $siswa = Siswa::all();
        return Inertia::render('OT/Create', [
            'siswa' => $siswa
        ]);
    }

    public function createData(Request $request) {
        $validated = $this->ValidatedData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        OrangTua::create($validated['data']);

        return redirect()->route('ot.list')->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    public function edit($id) {
        $ot = OrangTua::findOrFail($id);
        $siswa = Siswa::all();

        return Inertia::render('OT/Edit', [
            'ot' => $ot,
            'siswa' => $siswa
        ]);
    }

    public function editData(Request $request, $id) {
        $validated = $this->validatedData($request);

        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        $ot = OrangTua::findOrFail($id);
        $ot->update($validated['data']);

        return redirect()->route('ot.list')->with('success', 'Data orang tua berhasil diubah.');
    }

    public function delete($id) {
        $ot = OrangTua::findOrFail($id);
        $ot->delete();

        return redirect()->route('ot.list')->with('success', 'Data orang tua berhasil dihapus.');
    }

    private function validatedData(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'id_siswa' => 'required|exists:siswas,id',
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
