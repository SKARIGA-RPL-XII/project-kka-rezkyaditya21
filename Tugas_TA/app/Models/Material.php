<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['classroom_id', 'title', 'content', 'file_path', 'is_published'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
