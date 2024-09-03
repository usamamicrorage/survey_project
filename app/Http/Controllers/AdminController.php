<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('admin.dashboard', compact('title'));
    }
}
