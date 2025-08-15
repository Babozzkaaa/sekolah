<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Log;

class KelasGuruController extends Controller
{
    public function getKelasGuru() {
        $kelasguru =  KelasGuru::with(['kelas', 'guru'])->orderBy('created_at', 'desc')
        ->paginate(10);

        // dd($kelasguru);
        // Log::info($kelasguru);
        return Inertia::render('KelasGuru/List', [
            'kelasguru' => $kelasguru,
        ]);
    }

    public function create() {
        $kelas = Kelas::all();
        // $guru = Guru::all();
        $guru = Guru::whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('kelas_guru')
                ->whereRaw('kelas_guru.id_guru = gurus.id');
        })->get();

        return Inertia::render('KelasGuru/Create', [
            'kelas' => $kelas,
            'guru' => $guru,
        ]);
    }

    public function createData(Request $request) {
        $validated = $this->validateData($request);
        
        if (!$validated['success']) {
            return redirect()->back()->withErrors($validated['errors'])->withInput();
        }

        foreach ($validated['data'] as $data) {
            KelasGuru::create($data);
        }

        return redirect()->route('kelas-guru.list')->with('success', 'Data kelas guru berhasil ditambahkan.');
    }

    public function edit($id) {
        $kelasguru = KelasGuru::findOrFail($id);
        $kelas = Kelas::all();
        // $guru = Guru::all();
        $guru = Guru::whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('kelas_guru')
                ->whereRaw('kelas_guru.id_guru = gurus.id');
        })->orWhere('id', $kelasguru->id_guru)->get();

        return Inertia::render('KelasGuru/Edit', [
            'kelasguru' => $kelasguru,
            'kelas' => $kelas,
            'guru' => $guru,
        ]);
    }

    public function editData(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|exists:kelas,id',
            'id_guru' => 'required|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $kelasguru = KelasGuru::findOrFail($id);
        $kelasguru->update($request->only(['id_kelas', 'id_guru']));

        return redirect()->route('kelas-guru.list')->with('success', 'Data kelas guru berhasil diubah.');
    }

    public function delete($id) {
        $kelasguru = KelasGuru::findOrFail($id);
        $kelasguru->delete();

        return redirect()->route('kelas-guru.list')->with('success', 'Data kelas guru berhasil dihapus.');
    }

    private function validateData(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|exists:kelas,id',
            'id_guru' => 'required|array',
            'id_guru.*' => 'required|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors(),
            ];
        }

        $data = [];
        foreach ($request->id_guru as $guru) {
            $data[] = [
                'id_kelas' => $request->id_kelas,
                'id_guru' => $guru,
            ];
        }

        return [
            'success' => true,
            'data' => $data
        ];
    }
}
