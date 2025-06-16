<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = [
        'content',
        'likes',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
    public function getHashtagsAttribute(): array
    {
        preg_match_all('/#(\w+)/u', $this->content, $matches);
        return $matches[1];
    }

    public function getFormattedContentAttribute()
    {
        // Encode toàn bộ content để tránh XSS
        $escaped = e($this->content);

        // Thay thế hashtag bằng thẻ <a> có link
        return preg_replace_callback('/#(\w+)/u', function ($match) {
            $tag = strtolower($match[1]);
            $url = url('/hashtag/' . $tag);
            return '<a href="' . $url . '" class="text-blue-600 font-bold hover:underline">#' . $tag . '</a>';
        }, $escaped);
    }
}
