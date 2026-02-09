<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Auth::user()->enrolledClassrooms;
        return view('murid.kelas.index', compact('classes'));
    }

    public function show($id)
    {
        // Ensure student is enrolled in this class
        $classroom = Auth::user()->enrolledClassrooms()->findOrFail($id);
        $classroom->load(['materials', 'assignments']);
        
        return view('murid.kelas.show', compact('classroom'));
    }
}
