<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'body',
        'commentable_id',
        'commentable_type'
    ];
    public function author()
    {
        return $this->belongsTo(User::class);
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
