<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class majelis_talim_alkhoirController extends Controller
{
    public function getManagementMajelisTalimAlkhoirContent()
    {
        // Cek apakah ada data untuk type 'majelis-talim-alkhoir'
        $programUnit = \App\Models\ProgramUnit::where('type', 'majelis-talim-alkhoir')->first();

        if (!$programUnit) {
            // Jika tidak ada data, redirect ke index
            return redirect()->route('admin.management.program_unit.index', 'majelis-talim-alkhoir');
        }

        // Jika ada data, tampilkan view
        return view('admin.management.majelis-talim-alkhoir.content', compact('programUnit'));
    }
}
