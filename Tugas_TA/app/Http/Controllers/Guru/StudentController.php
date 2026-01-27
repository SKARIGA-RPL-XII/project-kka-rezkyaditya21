<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // Students enrolled in any of this teacher's classes
        $students = User::where('role', 'murid')
            ->whereHas('enrolledClassrooms', function($q) {
                $q->where('teacher_id', Auth::id());
            })->with('enrolledClassrooms')->get();

        return view('guru.murid.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Auth::user()->classrooms;
        $all_students = User::where('role', 'murid')->get();
        return view('guru.murid.create', compact('classrooms', 'all_students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $classroom = Classroom::findOrFail($validated['classroom_id']);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        $student = User::findOrFail($validated['user_id']);
        if ($student->role !== 'murid') {
            return back()->withErrors(['user_id' => 'User is not a student.']);
        }

        $classroom->students()->syncWithoutDetaching([$student->id]);

        return redirect()->route('guru.murid.index')->with('success', 'Murid berhasil ditambahkan ke kelas.');
    }

    public function destroy(string $id, Request $request)
    {
        // Remove student from a specific class
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);
        if ($classroom->teacher_id !== Auth::id()) {
            abort(403);
        }

        $classroom->students()->detach($id);

        return redirect()->route('guru.murid.index')->with('success', 'Murid berhasil dikeluarkan dari kelas.');
    }
}
