<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahController extends Controller
{
    public function index() {
        $data = Sejarah::all();
        return view('admin.sejarah.index', compact('data'));
    }

    public function create() {
        return view('admin.sejarah.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'konten' => 'required|string',
    ]);

    $path = null;
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('sejarah', 'public');
    }

    Sejarah::create([
        'judul' => $request->judul,
        'gambar' => $path,
        'konten' => $request->konten,
    ]);

    return redirect()->route('admin.sejarah.index')->with('success', 'Artikel berhasil disimpan!');
}

    public function edit($id) {
        $sejarah = Sejarah::findOrFail($id);
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request, $id) {
        $sejarah = Sejarah::findOrFail($id);

        $path = $sejarah->gambar;
        if ($request->hasFile('gambar')) {
            if ($path) Storage::delete($path);
            $path = $request->file('gambar')->store('sejarah');
        }

        $sejarah->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Data diperbarui.');
    }

    public function destroy($id) {
        $sejarah = Sejarah::findOrFail($id);
        if ($sejarah->gambar) Storage::delete($sejarah->gambar);
        $sejarah->delete();
        return redirect()->route('admin.sejarah.index')->with('success', 'Data dihapus.');
    }
}
