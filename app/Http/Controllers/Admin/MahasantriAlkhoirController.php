<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasantriAlkhoirController extends Controller
{
    public function getManagementMahasantriAlkhoirContent()
    {
        return view('admin.management.mahasantri-alkhoir.content');
    }
}
