<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::where('is_published', 1);

        if ($request->has('type')) {
            $type = $request->input('type');
            if ($type === 'video') {
                $query->whereNotNull('video_url');
            } elseif ($type === 'theory') {
                $query->whereNull('video_url');
            } elseif ($type === 'practice') {
                $query->where('has_compiler', 1);
            }
        }

        $materials = $query->latest()->get();
        return view('murid.kelas.index', compact('materials'));
    }

}
