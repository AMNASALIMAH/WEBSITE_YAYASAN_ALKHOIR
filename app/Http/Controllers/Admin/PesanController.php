<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KirimPesan;

class PesanController extends Controller
{
    public function index()
    {
        return view('kontak.kontak');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'nullable',
            'no_hp' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        KirimPesan::create($request->all());

        return redirect()->route('kontak')->with('success', 'Pesan berhasil dikirim');
    }


    public function delete($id)
    {
        $pesan = KirimPesan::findOrFail($id);
        $pesan->delete();
        return redirect()->route('admin.management.messages')->with('success', 'Pesan berhasil dihapus');
    }

    //ADMIN
    public function getManagementMessagesContent()
    {
        $pesan = KirimPesan::all();
        return view('admin.management.messages', compact('pesan'));
    }

}
