<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'body', 'status', 'likes'
                          ];
    public function author()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
