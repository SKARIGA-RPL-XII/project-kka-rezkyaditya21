<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Models\Classroom;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();
        
        $stats = Cache::remember("dashboard_stats_{$teacherId}", 300, function() use ($teacherId) {
            return [
                'classrooms_count' => Classroom::where('teacher_id', $teacherId)->count(),
                'materials_count' => DB::table('materials')
                    ->join('classrooms', 'materials.classroom_id', '=', 'classrooms.id')
                    ->where('classrooms.teacher_id', $teacherId)
                    ->count(),
                'assignments_count' => DB::table('assignments')
                    ->join('classrooms', 'assignments.classroom_id', '=', 'classrooms.id')
                    ->where('classrooms.teacher_id', $teacherId)
                    ->count(),
                'students_count' => DB::table('classroom_user')
                    ->join('classrooms', 'classroom_user.classroom_id', '=', 'classrooms.id')
                    ->where('classrooms.teacher_id', $teacherId)
                    ->distinct('classroom_user.user_id')
                    ->count(),
            ];
        });

        return view('guru.dashboard', compact('stats'));
    }
}
