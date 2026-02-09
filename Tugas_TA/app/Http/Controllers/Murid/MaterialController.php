<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function show($id)
    {
        $material = Material::findOrFail($id);
        
        // Optional: Check if user has access to this material's class
        // if (!Auth::user()->enrolledClassrooms->contains($material->classroom_id)) {
        //     abort(403);
        // }

        return view('murid.materi.show', compact('material'));
    }
}
