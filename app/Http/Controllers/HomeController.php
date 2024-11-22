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

    public function hot_topics()
    {
        $topics = Topics::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->get();
        $comments = Comments::all();
        $hot_topics = $topics;

        return view('hot-topics', compact('hot_topics', 'topics', 'comments'), [
            'title' => 'Topik Populer'
        ]);
    }
}
