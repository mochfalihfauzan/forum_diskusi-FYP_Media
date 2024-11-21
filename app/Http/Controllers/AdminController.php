<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topics;
use Carbon\Carbon;
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
        $current_date = Carbon::now()->locale('id');
        $formatedDate = $current_date->translatedFormat('l, d F Y');
        return view('dashboard-admin', compact('topics', 'users', 'current_date', 'formatedDate'), [
            'title' => 'Dashboard Admin'
        ]);
    }

    public function topics()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $topics = Topics::latest()->get();
        return view('admin-topics', compact('topics'), [
            'title' => 'Topik Management'
        ]);
    }

    public function user_manage()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $users = User::all();
        return view('user-manage', compact('users'), [
            'title' => 'User Management'
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin-user')->with('success', 'User berhasil dihapus');
    }
}
