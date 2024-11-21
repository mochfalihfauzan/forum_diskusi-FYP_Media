<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Topics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topics = Topics::latest()->get();
        $comments = Comments::all();
        return view('home', compact('topics', 'comments'), [
            'title' => 'Beranda'
        ]);
    }
}
