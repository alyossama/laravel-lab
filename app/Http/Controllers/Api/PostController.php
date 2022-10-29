<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::paginate(5);
        //Eager loading
        $posts = Post::with('user')->paginate(15);
        return PostResource::collection($posts);
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post-creator'],
        ]);

        return new PostResource($post);
    }
}
