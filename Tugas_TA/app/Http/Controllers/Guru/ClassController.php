<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classrooms = Auth::user()->classrooms;
        return view('guru.kelas.index', compact('classrooms'));
    }

    public function create()
    {
        return view('guru.kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        Auth::user()->classrooms()->create($validated);

        return redirect()->route('guru.kelas.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function show(Classroom $kela) // Use $kela because of Laravel's pluralization for route-model binding (kelas -> kela?)
    {
        // Let's actually use a custom identifier if pluralization is weird
        return view('guru.kelas.show', compact('kela'));
    }

    public function edit(Classroom $kela)
    {
        $this->authorizeTeacher($kela);
        return view('guru.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Classroom $kela)
    {
        $this->authorizeTeacher($kela);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $kela->update($validated);

        return redirect()->route('guru.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $kela)
    {
        $this->authorizeTeacher($kela);
        $kela->delete();

        return redirect()->route('guru.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    private function authorizeTeacher(Classroom $classroom)
    {
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }
    }
}
