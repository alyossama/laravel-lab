<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostsController extends Controller
{
    public $allPosts = [
        ['id' => 1 , 'title' => 'laravel is cool', 'posted_by' => 'Ahmed', 'creation_date' => '2022-10-22'],
        ['id' => 2 , 'title' => 'PHP deep dive', 'posted_by' => 'Mohamed', 'creation_date' => '2022-10-15'],
        ['id' => 3 , 'title' => 'MySQL', 'posted_by' => 'Aly', 'creation_date' => '2022-10-18'],
        ['id' => 4 , 'title' => 'Laravel Passport', 'posted_by' => 'Omar', 'creation_date' => '2022-10-20'],
    ];


    /**
     * Get the value of allPosts
     */
    public function getAllPosts()
    {
        return $this->allPosts;
    }

    /**
     * Set the value of allPosts
     *
     * @return  self
     */
    public function setAllPosts($allPosts)
    {
        $this->allPosts = $allPosts;

        return $this;
    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts'=>$this->getAllPosts()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('posts.index', ['posts' => $this->getAllPosts()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', ['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', ['id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('posts.index', ['posts' => $this->getAllPosts()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('posts.index', ['posts' => $this->getAllPosts()]);
    }
}
