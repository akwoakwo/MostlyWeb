<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.data-admin.index', [
            'title' => 'index',
            'data' => User::where('role','admin')->get(),
        ]);
    }
}
