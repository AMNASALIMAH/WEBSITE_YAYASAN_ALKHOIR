<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SD_tahfidz_AlkhoirController extends Controller
{
    public function getManagementSDTahfidzAlkhoirContent()
    {
        // Cek apakah ada data untuk type 'sd-tahfidz-alkhoir'
        $programUnit = \App\Models\ProgramUnit::where('type', 'sd-tahfidz-alkhoir')->first();

        if (!$programUnit) {
            // Jika tidak ada data, redirect ke index
            return redirect()->route('admin.management.program_unit.index', 'sd-tahfidz-alkhoir');
        }

        // Jika ada data, tampilkan view
        return view('admin.management.sd-tahfidz-alkhoir.content', compact('programUnit'));
    }
}
