<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\Article;



class Dashboard extends Controller
{
    public function index()
    {
        $articleCount = Article::count();
        $admin = Auth::user();
        return view('Back.dashboard', compact('admin', 'articleCount'));

    }


}
