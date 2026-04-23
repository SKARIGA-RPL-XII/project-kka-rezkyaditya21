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
        
        // Count total materials (all are now global)
        $materialsCount = \App\Models\Material::where('is_published', 1)->count();

        $completedCount = $user->completedMaterials()->count();
        $progressPercent = $materialsCount > 0 ? round(($completedCount / $materialsCount) * 100) : 0;

        $stats = [
            'materials_count' => $materialsCount,
            'completed_count' => $completedCount,
            'progress_percent' => $progressPercent,
        ];

        $globalMaterials = \App\Models\Material::where('is_published', 1)
            ->latest()
            ->get();

        return view('murid.dashboard', compact('stats', 'globalMaterials'));
    }



    public function profile()
    {
        return view('murid.placeholders.profile');
    }
}
