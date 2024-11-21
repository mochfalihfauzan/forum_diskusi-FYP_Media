<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topics;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $topics = Topics::latest()->get();
        $users = User::all();
        return view('dashboard-admin', compact('topics', 'users'), [
            'title' => 'Dashboard Admin'
        ]);
    }

    public function topics()
    {
        $topics = Topics::latest()->get();
        return view('admin-topics', compact('topics'), [
            'title' => 'Dashboard Admin'
        ]);
    }
}
