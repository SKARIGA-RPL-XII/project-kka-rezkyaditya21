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
            'due_date' => 'nullable|date',
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

    public function show(Assignment $tuga)
    {
        $this->authorizeTeacher($tuga);
        
        $assignment = $tuga;
        $classroom = $assignment->classroom;
        
        // Get all students in the class
        $students = $classroom->students; // Assuming 'students' relationship exists on Classroom model (belongsToMany User)
        
        // Get all submissions for this assignment keyed by student_id for easy lookup
        $submissions = $assignment->submissions->keyBy('student_id');

        return view('guru.tugas.show', compact('assignment', 'students', 'submissions'));
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
            'due_date' => 'nullable|date',
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

    public function gradeSubmission(Request $request, $id)
    {
        $submission = \App\Models\AssignmentSubmission::findOrFail($id);
        
        // Authorize: Check if the assignment belongs to a class taught by the user
        if ($submission->assignment->classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission->update($validated);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    private function authorizeTeacher(Assignment $assignment)
    {
        if ($assignment->classroom->teacher_id !== Auth::id()) {
            abort(403);
        }
    }
}
