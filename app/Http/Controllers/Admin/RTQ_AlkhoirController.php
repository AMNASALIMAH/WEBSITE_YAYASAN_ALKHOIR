<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RTQ_AlkhoirController extends Controller
{
    public function getManagementRTQAlkhoirContent()
    {
        // Cek apakah ada data untuk type 'rtq-alkhoir'
        $programUnit = \App\Models\ProgramUnit::where('type', 'rtq-alkhoir')->first();

        if (!$programUnit) {
            // Jika tidak ada data, redirect ke index
            return redirect()->route('admin.management.program_unit.index', 'rtq-alkhoir');
        }

        // Jika ada data, tampilkan view
        return view('admin.management.rtq-alkhoir.content', compact('programUnit'));
    }
}
