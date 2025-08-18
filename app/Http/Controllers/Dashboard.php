<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visi_misi;
use App\Models\sejarah;
use App\Models\StrukturOrganisasi;
class Dashboard extends Controller
{

    public function welcome (){
        $visiMisi = visi_misi::first();
        return view('welcome', compact('visiMisi'));
    }
    public function about (){
        $visiMisi = visi_misi::first();
        return view('tentang_kami.Visi-Misi', compact('visiMisi'));
    }

    public function sejarah (){
        $sejarah = sejarah::first();
        return view('tentang_kami.sejarah', compact('sejarah'));
    }

    public function struktur_organisasi (){
        $strukturOrganisasi = StrukturOrganisasi::orderBy('created_at', 'desc')->get();
        return view('tentang_kami.struktur_organisasi', compact('strukturOrganisasi'));
    }
}
