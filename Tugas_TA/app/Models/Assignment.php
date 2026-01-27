<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['classroom_id', 'title', 'description', 'file_path', 'is_published'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
