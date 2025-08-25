<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RTQ_AlkhoirController extends Controller
{
    public function getManagementRTQAlkhoirContent()
    {
        return view('admin.management.rtq-alkhoir.content');
    }
}
