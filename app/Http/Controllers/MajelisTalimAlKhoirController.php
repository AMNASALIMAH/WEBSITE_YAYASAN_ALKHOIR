<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajelisTalimAlKhoirController extends Controller
{
    public function showMT()
    {
        $programUnit = \App\Models\ProgramUnit::where('type', 'majelis-talim-alkhoir')->first();
        return view('program.mt_alkhoir.deskripsi', compact('programUnit'));
    }
}
