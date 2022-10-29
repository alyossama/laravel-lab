<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $postImage = $request->file('postImage');

        $request->hasFile('postImage') ? $postImageName = $postImage->hashName() : null
        ;

        $request->hasFile('postImage') ? $postImage->storeAs('images/'. Str::slug($request['title']).'/', $postImage->hashName()) : null;
        $post = Post::create([
             'title' => $request['title'],
             'description'=>$request['description'],
             'user_id'=>$request['post-creator'],
             'image'=>($request->hasFile('postImage') ? $postImageName : null)
    ]);


        // $post->replicate();

        return to_route('post.index')->with(['success'=>'New post added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        return view('posts.edit', compact('users', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        if ($request->hasFile('postImage')) {
            //get the current image & delete it

            $currentImageDirectory = "images/$post->slug/";
            Storage::deleteDirectory($currentImageDirectory);

            // assign new image
            $post->image = $request->postImage->hashName();
            $post->slug = Str::slug($request->title) ;
            $newImage = $request->file('postImage');
            $newImage->storeAs("images/$post->slug/", $newImage->hashName());
        }

        $post->title = $request->title;
        // $post->slug = Str::slug($request->title) ;
        $post->description = $request->description;
        $post->user_id = $request->input('post-creator');



        $post->save();

        return to_route('post.edit', $id)->with(['success'=>'Post updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postToBeDeleted = Post::find($id);

        // $postImagePath = "images/$postToBeDeleted->slug/".$postToBeDeleted->image;
        $postImageDirectory = "images/$postToBeDeleted->slug/";
        // dd($postImageDirectory);
        // Storage::delete($postImageDirectory);
        Storage::deleteDirectory($postImageDirectory);

        $postToBeDeleted->delete();

        return to_route('post.index')->with(['success'=>'Post deleted successfully!']);
    }
}
