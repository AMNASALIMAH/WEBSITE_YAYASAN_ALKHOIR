<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SD_tahfidz_AlkhoirController extends Controller
{
    public function getManagementSDTahfidzAlkhoirContent()
    {
        return view('admin.view_majelis.Majelis_Talim_Al_Khoir');
    }
}
