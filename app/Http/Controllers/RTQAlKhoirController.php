<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RTQAlKhoirController extends Controller
{
    public function showRTQ()
    {
        $programUnit = \App\Models\ProgramUnit::where('type', 'rtq-alkhoir')->first();
        return view('program.rtq_alkhoir.deskripsi', compact('programUnit'));
    }
}
