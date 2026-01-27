<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::whereHas('classroom', function($q) {
            $q->where('teacher_id', Auth::id());
        })->with('classroom')->get();
        return view('guru.tugas.index', compact('assignments'));
    }

    public function create()
    {
        $classrooms = Auth::user()->classrooms;
        return view('guru.tugas.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'is_published' => 'boolean',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('assignments');
        }

        Assignment::create($validated);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Assignment $tuga) // Pluralization again: tugas -> tuga?
    {
        $this->authorizeTeacher($tuga);
        return view('guru.tugas.show', compact('tuga'));
    }

    public function edit(Assignment $tuga)
    {
        $this->authorizeTeacher($tuga);
        $classrooms = Auth::user()->classrooms;
        return view('guru.tugas.edit', compact('tuga', 'classrooms'));
    }

    public function update(Request $request, Assignment $tuga)
    {
        $this->authorizeTeacher($tuga);
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'is_published' => 'boolean',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            if ($tuga->file_path) {
                Storage::delete($tuga->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('assignments');
        }

        $tuga->update($validated);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Assignment $tuga)
    {
        $this->authorizeTeacher($tuga);
        if ($tuga->file_path) {
            Storage::delete($tuga->file_path);
        }
        $tuga->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    private function authorizeTeacher(Assignment $assignment)
    {
        if ($assignment->classroom->teacher_id !== Auth::id()) {
            abort(403);
        }
    }
}
