<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForumTopic;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $topics = ForumTopic::with(['user'])
            ->withCount('replies')
            ->latest()
            ->paginate(10);

        return view('murid.forum.index', compact('topics'));
    }

    public function create()
    {
        return view('murid.forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ForumTopic::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('murid.forum.index')->with('success', 'Topik diskusi berhasil dibuat!');
    }

    public function show($id)
    {
        $topic = ForumTopic::with(['user', 'replies.user'])->findOrFail($id);
        return view('murid.forum.show', compact('topic'));
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        ForumReply::create([
            'forum_topic_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
