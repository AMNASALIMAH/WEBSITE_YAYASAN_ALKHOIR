<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function getNewsContent()
    {
        $news = \App\Models\News::withTrashed()->latest()->paginate(15);
        return view('admin.news.content', compact('news'));
    }

    public function getGaleryContent()
    {
        return view('admin.galery.content');
    }


    public function getManagementTeachersContent()
    {
        return view('admin.management.teachers');
    }





    public function getManagementAccountContent()
    {
        return view('admin.management.account');
    }

  
    public function getManagementApplicationsContent()
    {
        return view('admin.management.applications');
    }

  


}
