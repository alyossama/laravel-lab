@extends('layouts.app')
@section('title', 'Blog - Show post')
@section('content')
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
                        <h5 class="card-title bg-light">Email</h5>
                        <p class="card-text">{{ $post->user->email }}</p>
                        <h5 class="card-title bg-light">Created At</h5>
                        <p class="card-text">{{ $post->created_at->format('D, d M Y') }}</p>
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
                    <div class="card-body">
                        <h5 class="card-title bg-light">Title</h5>
                        <p class="card-text">{{ $post->title }}</p>
                        <h5 class="card-title bg-light">Description</h5>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>

    {{-- <div class="row justify-content-center align-items-center my-5">
        <div class="col-8">
            <form action="">

            </form>
        </div>
    </div> --}}
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-8">
            <div class="card shadow-lg">
                <div class="card-header bg-info">
                    Comment
                </div>
                <div class="card-body">
                    <h5 class="card-title bg-light">Title</h5>
                    <p class="card-text"></p>
                    <h5 class="card-title bg-light">Description</h5>
                    <p class="card-text"></p>
                    <h5 class="card-title bg-light">User</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-8">
            <div class="card shadow-lg">
                <div class="card-header bg-info">
                    Comment
                </div>
                <div class="card-body">
                    <h5 class="card-title bg-light">Title</h5>
                    <p class="card-text"></p>
                    <h5 class="card-title bg-light">Description</h5>
                    <p class="card-text"></p>
                    <h5 class="card-title bg-light">User</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>


@endsection
