<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Classroom;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();
        
        $stats = [
            'classrooms_count' => Classroom::where('teacher_id', $teacherId)->count(),
            'materials_count' => Material::whereHas('classroom', function($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })->count(),
            'assignments_count' => Assignment::whereHas('classroom', function($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            })->count(),
            'students_count' => User::where('role', 'murid')
                ->whereHas('enrolledClassrooms', function($q) use ($teacherId) {
                    $q->where('teacher_id', $teacherId);
                })->count(),
        ];

        return view('guru.dashboard', compact('stats'));
    }
}
