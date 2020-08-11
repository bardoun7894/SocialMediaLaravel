<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()
            {
        $this->middleware(['auth:sanctum']);
            }

    public function index()
        {
        return PostResource::collection(Post::paginate());
        }
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return  PostResource
     */
    public function store(PostRequest $request)
    {
        return new PostResource(Post::create([
            'user_id' => 120,
            'body' => $request->body,
            'status' => $request->has('status') ? $request->status : 'draft'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         $this->authorize('update',$post);
        if($request->has('status')){
            $post->status = $request->status;
        }
        if($request->has('likes')){
            $post->likes = $request->likes;
        }
        if($request->has('body')){
            $post->body = $request->body;
        }
        $post->save();
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        Post::destroy($post->id);
        return response()->json([
            'message'=>'the post has deleted'
        ]);
    }
    public function comment(CommentRequest $request,Post $post){
        Comment::create([
            'user_id'=>auth()->user()->id,
            'body'=>$request->body,
            'commentable_id'=>$post->id,
            'commentable_type'=>Post::class,
            'likes'=>$request->likes

            ]);
        $post->refresh();
        return new PostResource($post);
    }
}
