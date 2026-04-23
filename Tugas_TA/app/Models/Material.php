<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['title', 'content', 'file_path', 'video_url', 'is_published', 'language', 'sample_code', 'has_compiler', 'has_flowchart'];


    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'material_user')->withTimestamps()->withPivot('completed_at');
    }
}
