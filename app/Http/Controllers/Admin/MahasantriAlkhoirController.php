<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasantriAlkhoirController extends Controller
{
    public function getManagementMahasantriAlkhoirContent()
    {
        // Cek apakah ada data untuk type 'mahasantri-alkhoir'
        $programUnit = \App\Models\ProgramUnit::where('type', 'mahasantri-alkhoir')->first();

        if (!$programUnit) {
            // Jika tidak ada data, redirect ke index
            return redirect()->route('admin.management.program_unit.index', 'mahasantri-alkhoir');
        }

        // Jika ada data, tampilkan view
        return view('admin.management.mahasantri-alkhoir.content', compact('programUnit'));
    }
}
