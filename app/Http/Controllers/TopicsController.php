<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('topics.create', [
            'title' => 'Buat Topik Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $title = $request->title;
        $content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        } else {
            $image = null;
        }

        Topics::create([
            'title' => $title,
            'content' => $content,
            'user_id' => auth()->id(),
            'image' => $image,
        ]);

        return redirect()->route('home')->with('success', 'Topik berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comments = Comments::with('user')->where('topic_id', $id)->orderBy('created_at', 'desc')->get();
        $topics = Topics::find($id);
        return view('topics.show', [
            'title' => 'Detail Topik',
            'topics' => $topics,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $topics = Topics::find($id);
        return view('topics.edit', [
            'title' => 'Edit Topik',
            'topics' => $topics
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $title = $request->title;
        $content = $request->content;

        if ($request->File('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $image = $request->file('image')->store('images', 'public');
        } else {
            $image = $request->oldImage;
        }


        Topics::find($id)->update([
            'title' => $title,
            'content' => $content,
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Topik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topics $topics, $id)
    {
        $topic = Topics::find($id);
        if ($topic->image) {
            Storage::disk('public')->delete($topic->image);
        }
        $topic->delete();

        return redirect()->route('dashboard')->with('success', 'Topik berhasil dihapus');
    }

    // public function search(Request $request)
    // {
    //     $query = $request->query;
    //     $topics = Topics::where('title', 'like', '%' . $query . '%')->orWhere('content', 'like', '%' . $query . '%')->get();
    //     return view('home', compact('topics'));
    // }
}
