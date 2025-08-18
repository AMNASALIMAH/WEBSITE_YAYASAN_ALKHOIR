<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Struktur_OrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::orderBy('created_at', 'desc')->get();
        return view('admin.struktur_organisasi.index', compact('strukturOrganisasi'));
    }

    public function create()
    {
        return view('admin.struktur_organisasi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan maksimal 255 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];

            // Handle foto upload
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $fotoPath = $foto->storeAs('public/struktur-organisasi', $fotoName);
                $data['foto'] = $fotoPath;
            }

            StrukturOrganisasi::create($data);

            return redirect()->route('admin.struktur_organisasi.index')
                ->with('success', 'Data struktur organisasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur_organisasi.edit', compact('strukturOrganisasi'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan maksimal 255 karakter.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);
            
            $data = [
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];

            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Delete old foto if exists
                if ($strukturOrganisasi->foto && Storage::exists($strukturOrganisasi->foto)) {
                    Storage::delete($strukturOrganisasi->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $fotoPath = $foto->storeAs('public/struktur-organisasi', $fotoName);
                $data['foto'] = $fotoPath;
            }

            $strukturOrganisasi->update($data);

            return redirect()->route('admin.struktur_organisasi.index')
                ->with('success', 'Data struktur organisasi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);
            
            // Delete foto if exists
            if ($strukturOrganisasi->foto && Storage::exists($strukturOrganisasi->foto)) {
                Storage::delete($strukturOrganisasi->foto);
            }
            
            $strukturOrganisasi->delete();

            return redirect()->route('admin.struktur_organisasi.index')
                ->with('success', 'Data struktur organisasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.struktur_organisasi.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
