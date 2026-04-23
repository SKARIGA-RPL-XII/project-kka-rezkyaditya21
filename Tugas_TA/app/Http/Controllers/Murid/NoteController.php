<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return view('murid.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('murid.notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('murid.notes.index')->with('success', 'Catatan berhasil dibuat!');
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }
        return view('murid.notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('murid.notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('murid.notes.index')->with('success', 'Catatan berhasil dihapus!');
    }
}
