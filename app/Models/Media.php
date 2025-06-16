<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['idea_id', 'file_path', 'type'];

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
}

