<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'body',
        'commentable_id',
        'commentable_type',
        'likes'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function post()
    {
        return $this->morphOne(Post::class, 'commentable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
