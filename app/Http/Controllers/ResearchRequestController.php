<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchRequestController extends Controller
{
    //

    public function index()
    {
        
        return view('admin.research.index');
    }

    public function create()
    {
        return view('admin.research.create');
    }
}
