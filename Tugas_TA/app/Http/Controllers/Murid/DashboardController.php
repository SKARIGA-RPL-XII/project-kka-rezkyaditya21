<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $enrolledClassrooms = $user->enrolledClassrooms()->with('assignments')->get();
        
        $classroomsCount = $enrolledClassrooms->count();
        
        // Calculate pending assignments: Total assignments in enrolled classes - User's submissions
        // Note: This is a simplified calculation. Ideally, check specific submission status.
        $totalAssignments = $enrolledClassrooms->pluck('assignments')->flatten()->count();
        
        // We need to count how many assignments the user has submitted.
        // Assuming AssignmentSubmission model exists and has relationship? 
        // Or simpler: count assignments that don't have a submission from this user.
        // Let's use a more direct query for pending assignments if possible, or just raw count for now.
        // For distinct count, we can query AssignmentSubmission.
        
        $submittedCount = \App\Models\AssignmentSubmission::where('student_id', $user->id)->count();
        $pendingAssignmentsCount = max(0, $totalAssignments - $submittedCount);

        $stats = [
            'classrooms_count' => $classroomsCount,
            'pending_assignments_count' => $pendingAssignmentsCount,
            // 'materials_read_count' => ... // Optional
        ];

        return view('murid.dashboard', compact('stats'));
    }
}
