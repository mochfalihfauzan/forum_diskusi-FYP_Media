<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $topics = Topics::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
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
