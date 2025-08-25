<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramUnit;
class MajelisDatasController extends Controller
{
    public function getManagementMajelisTalimAlkhoirData()
    {
        return view('admin.management.view_majelis.Majelis_Talim_Al_Khoir', [
            'majelis_talim_alkhoir' => ProgramUnit::where('type', 'majelis-talim-alkhoir')->get()
        ]);
    }
}
