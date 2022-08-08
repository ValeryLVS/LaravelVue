<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('app/home', [
            'articles' => Article::lastLimit(6),
        ]);
    }
}
