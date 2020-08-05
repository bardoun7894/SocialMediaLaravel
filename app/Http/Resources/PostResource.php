<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post_id' => $this->id,
            'author' => new AuthorResource($this->author),
            'post_body' => $this->body,
            "created_at" => $this->created_at->toDayDateTimeString(), 'likes' => $this->likes,
            'status' => $this->status,
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
