@extends('layouts.app')
@section('title', 'Blog - Show post')
@section('content')
    {{-- @dd($post->comments) --}}

    <div class="row justify-content-center align-items-center my-5">
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <p class="h1">
                        Show Post
                    </p>
                </div>
                <div class="col-6 text-center">
                    <a href="{{ route('post.index') }}" class="mt-4 btn btn-success">Home</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-content-center my-3">
        <div class="col-5">
            <div class="card shadow-lg">
                <div class="card-header bg-info">
                    Post Creator Info
                </div>
                <div class="card-body">
                    <h5 class="card-title bg-light">Name</h5>
                    <p class="card-text">{{ $post->user->name }}</p>
                    <h5 class="card-title  bg-light">Email</h5>
                    <p class="card-text">{{ $post->user->email }}</p>
                    <h5 class="card-title  bg-light">Created At</h5>
                    <p class="card-text">{{ $post->user->created_at->format('D, d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-items-center">
        <div class="col-8">
            <div class="card shadow-lg">
                <div class="card-header bg-info">
                    Post Info
                </div>

                <div class="row">
                    <div class="card-body col-9">
                        <div class="p-3">
                            <h5 class="card-title bg-light">Title</h5>
                            <p class="card-text">{{ $post->title }}</p>
                            <h5 class="card-title bg-light">Description</h5>
                            <p class="card-text">{{ $post->description }}</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <img src="{{ asset("images/$post->slug/$post->image") }}" alt="Post Has no Image" width="100%"
                            height="100%">
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Comments section --}}
    <div class="row my-5 justify-content-center align-items-center">
        <div class="col-8">
            <div class="col-12">
                <p class="h1">Comments</p>
            </div>
            @foreach ($post->comments as $comment)
                <div class="row my-3">
                    <div class="col-12">
                        <div class="card card-body shadow-sm">
                            <div>
                                <h6>
                                    {{-- Name --}}
                                    {{ $comment->user->name }}
                                    <small class="ms-3 text-muted">
                                        {{-- date --}}
                                        Commented on {{ $comment->created_at->format('g:i A T') }}
                                    </small>
                                </h6>
                                <div class="p-3">
                                    <p>
                                        {{-- body --}}
                                        {{ $comment->body }}
                                    </p>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-1">
                                        {{-- Button --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-warning" data-toggle="modal"
                                            data-target="#editModal{{ $comment->id }}">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $comment->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="EditCommentModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="EditCommentModal">Edit Comment</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('comment.update', $comment->id) }}"
                                                            method="post" id="edit-comment">
                                                            @method('put')
                                                            @csrf
                                                            <input type="hidden" name="post_id" value={{ $post->id }}>
                                                            <label for="comment">Comment</label>
                                                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="5">{{ $comment->body }}</textarea>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" form="edit-comment"
                                                            class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /Button --}}
                                    <div class="col-2">
                                        <form method="post" action="{{ route('comment.destroy', $comment->id) }}">
                                            @method('delete')
                                            @csrf
                                            <input type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-outline-danger" value="Delete">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Write a new comment section --}}
    <div class="row justify-content-center align-items-center mt-4">
        <div class="col-8">
            @error('user_comment_count')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session()->has('success'))
                <div class="row mt-5 justify-content-center">
                    <div class="col-12">
                        <div class="alert alert-success ">
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            @error('comment')
                <div class="alert alert-danger col-12 ">{{ $message }}</div>
            @enderror
            <div class="card card-body bg-light">
                <h5 class="card-title ">Leave a comment</h5>
                <form action="{{ route('comment.store') }}" method="post">
                    @method('post')
                    @csrf
                    <input type="hidden" name="post_id" value={{ $post->id }}>
                    {{-- <input type="hidden" name="user_comment_count" value={{ $userCommentCount }}> --}}
                    <label for="comment">Comment</label>
                    <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea>

                    <input type="submit" class="btn btn-outline-primary mt-3" value="submit">

                </form>
            </div>

        </div>
    </div>
@endsection
