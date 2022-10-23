<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts=DB::table('posts')->select('posts.id','posts.title','posts.created_at',)
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.id', 'posts.title', 'posts.created_at', 'users.name')
            ->orderBy('posts.id')
            ->paginate(5);
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
        Post::create([
            'title' => $request['title'],
            'description'=>$request['description'],
            'user_id'=>$request['post-creator'],
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
    ]);

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
        $post = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.id', 'posts.title', 'posts.description','posts.created_at', 'users.name','users.email')
        ->where('posts.id', '=', $id)
        ->get();
        return view('posts.show', ['postToShow'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.id', 'posts.title', 'posts.description', 'posts.user_id', 'users.name')
        ->where('posts.id', '=', $id)
        ->get();

        $users = User::all();
        return view('posts.edit', ['postToEdit'=>$post,'users'=>$users]);
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
        $postToUpdate= Post::find($id);
        $postToUpdate->title =$request['title'];
        $postToUpdate->description =$request['description'];
        $postToUpdate->user_id = $request['post-creator'];
        $postToUpdate->updated_at=Carbon::now();

        $postToUpdate->save();

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


        $postToBeDeleted->delete();

        return to_route('post.index')->with(['success'=>'Post deleted successfully!']);
    }
}
