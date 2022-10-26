<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {

        $post = Post::findOrFail($request['post_id']);


        $post->comments()->create([
            'body'=>$request['comment'],
            'post_id'=>$request['post_id'],
            'user_id'=>Auth::id()
        ]);


        return redirect()->back()->with(['success'=>'Your comment has been posted successfully']);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with(['success'=>'Comment deleted successfully']);
    }

}
