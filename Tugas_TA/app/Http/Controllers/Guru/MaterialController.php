<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::whereHas('classroom', function($q) {
            $q->where('teacher_id', Auth::id());
        })->with('classroom')->get();
        return view('guru.materi.index', compact('materials'));
    }

    public function create()
    {
        $classrooms = Auth::user()->classrooms;
        return view('guru.materi.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'is_published' => 'boolean',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('materials');
        }

        Material::create($validated);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Material $materi)
    {
        $this->authorizeTeacher($materi);
        return view('guru.materi.show', compact('materi'));
    }

    public function edit(Material $materi)
    {
        $this->authorizeTeacher($materi);
        $classrooms = Auth::user()->classrooms;
        return view('guru.materi.edit', compact('materi', 'classrooms'));
    }

    public function update(Request $request, Material $materi)
    {
        $this->authorizeTeacher($materi);
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'is_published' => 'boolean',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            if ($materi->file_path) {
                Storage::delete($materi->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('materials');
        }

        $materi->update($validated);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $materi)
    {
        $this->authorizeTeacher($materi);
        if ($materi->file_path) {
            Storage::delete($materi->file_path);
        }
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    private function authorizeTeacher(Material $material)
    {
        if ($material->classroom->teacher_id !== Auth::id()) {
            abort(403);
        }
    }
}
