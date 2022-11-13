<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index()
    {
        return view('admins.index');
    }

    public function view()
    {
        return view('admins.view');
    }

    public function searchLinks()
    {
        return view('admins.search');
    }

}
