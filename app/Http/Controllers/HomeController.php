<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Topics;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $query = Topics::query();
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('content', 'LIKE', '%' . $request->search . '%');
            });
        }
        // $topics = Topics::latest()->get();
        $topics = $query->orderBy('created_at', 'desc')->get();
        $comments = Comments::all();
        return view('home', compact('topics', 'comments'), [
            'title' => 'Beranda'
        ]);
    }

    public function hot_topics(Request $request)
    {
        $query = Topics::query();
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('content', 'LIKE', '%' . $request->search . '%');
            });
        }

        $topics = $query->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->get();

        $comments = Comments::all();
        $hot_topics = $topics;

        return view('hot-topics', compact('hot_topics', 'topics', 'comments'), [
            'title' => 'Topik Populer'
        ]);
    }
}
