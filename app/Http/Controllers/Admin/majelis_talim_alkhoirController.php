<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class majelis_talim_alkhoirController extends Controller
{
    public function getManagementMajelisTalimAlkhoirContent()
    {
        return view('admin.management.majelis-talim-alkhoir.content');
    }
}
