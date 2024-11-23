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

    public function topics(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $query = Topics::query();
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('content', 'LIKE', '%' . $request->search . '%');
            });
        }

        $topics = $query->orderBy('created_at', 'desc')->get();
        return view('admin-topics', compact('topics'), [
            'title' => 'Topik Management'
        ]);
    }

    public function user_manage(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $query = User::query();
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%');
            });
        }
        $users = $query->orderBy('created_at', 'desc')->get();
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
