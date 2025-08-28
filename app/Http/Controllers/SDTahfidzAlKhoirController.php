<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SDTahfidzAlKhoirController extends Controller
{
    public function showSDT()
    {
        $programUnit = \App\Models\ProgramUnit::where('type', 'sd-tahfidz-alkhoir')->first();
        return view('program.sdt_alkhoir.deskripsi', compact('programUnit'));
    }
}
