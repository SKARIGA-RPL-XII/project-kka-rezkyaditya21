<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        $submission = AssignmentSubmission::where('assignment_id', $id)
            ->where('student_id', Auth::id())
            ->first();

        // Optional check access
        
        return view('murid.tugas.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240', // 10MB max
        ]);

        $assignment = Assignment::findOrFail($id);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('assignments', 'public');
        }

        AssignmentSubmission::updateOrCreate(
            [
                'assignment_id' => $id,
                'student_id' => Auth::id(),
            ],
            [
                'content' => $request->content,
                'file_path' => $path,
                'submitted_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
