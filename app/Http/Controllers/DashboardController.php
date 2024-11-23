<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        $topics = $query->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('topics'), [
            'title' => 'Dashboard'
        ]);
    }

    public function dashboard_old()
    {
        $topics = Topics::where('user_id', Auth::user()->id)->get();
        return view('dashboard-old', compact('topics'), [
            'title' => 'Dashboard'
        ]);
    }
}
