<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $comment = [
            'comment_id' => $this->id,
            'comment_body' => $this->body,
            "created_at" => $this->created_at->toDayDateTimeString(),
            'author' => new AuthorResource($this->author), 'likes' => $this->likes
        ];

        if ($this->comments->count() > 0) {
            $comment['comments'] = CommentResource::collection($this->comments);
        }

        return $comment;
    }
}
