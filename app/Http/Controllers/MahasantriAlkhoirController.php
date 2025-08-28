<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasantriAlkhoirController extends Controller
{
    public function showMHS()
    {
        $programUnit = \App\Models\ProgramUnit::where('type', 'mahasantri-alkhoir')->first();
        return view('program.mhs_alkhoir.deskripsi', compact('programUnit'));
    }
}
