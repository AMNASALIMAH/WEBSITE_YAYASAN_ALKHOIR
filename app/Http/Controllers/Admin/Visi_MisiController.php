<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\visi_misi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Visi_MisiController extends Controller
{
    public function index()
    {
        $visiMisi = visi_misi::first();
        return view('admin.visi_misi.index', compact('visiMisi'));
    }

    public function create()
    {
        $visiMisi = visi_misi::first();
        if ($visiMisi) {
            return redirect()->route('admin.visi_misi.index')
                ->with('error', 'Data Visi, Misi, dan Tujuan sudah ada. Silakan edit data yang ada.');
        }
        return view('admin.visi_misi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visi' => 'required|string|max:2000',
            'misi' => 'required|string|max:2000',
            'tujuan' => 'required|string|max:2000',
        ], [
            'visi.required' => 'Visi harus diisi.',
            'visi.max' => 'Visi maksimal 2000 karakter.',
            'misi.required' => 'Misi harus diisi.',
            'misi.max' => 'Misi maksimal 2000 karakter.',
            'tujuan.required' => 'Tujuan harus diisi.',
            'tujuan.max' => 'Tujuan maksimal 2000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            visi_misi::create([
                'visi' => $request->visi,
                'misi' => $request->misi,
                'tujuan' => $request->tujuan,
            ]);

            return redirect()->route('admin.visi_misi.index')
                ->with('success', 'Data Visi, Misi, dan Tujuan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $visiMisi = visi_misi::findOrFail($id);
        return view('admin.visi_misi.edit', compact('visiMisi'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'visi' => 'required|string|max:2000',
            'misi' => 'required|string|max:2000',
            'tujuan' => 'required|string|max:2000',
        ], [
            'visi.required' => 'Visi harus diisi.',
            'visi.max' => 'Visi maksimal 2000 karakter.',
            'misi.required' => 'Misi harus diisi.',
            'misi.max' => 'Misi maksimal 2000 karakter.',
            'tujuan.required' => 'Tujuan harus diisi.',
            'tujuan.max' => 'Tujuan maksimal 2000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $visiMisi = visi_misi::findOrFail($id);
            $visiMisi->update([
                'visi' => $request->visi,
                'misi' => $request->misi,
                'tujuan' => $request->tujuan,
            ]);

            return redirect()->route('admin.visi_misi.index')
                ->with('success', 'Data Visi, Misi, dan Tujuan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $visiMisi = visi_misi::findOrFail($id);
            $visiMisi->delete();

            return redirect()->route('admin.visi_misi.index')
                ->with('success', 'Data Visi, Misi, dan Tujuan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.visi_misi.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
