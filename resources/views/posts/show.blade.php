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
                    <a href="{{ route('posts.index') }}" class="mt-4 btn btn-success">Home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Post Info
                </div>
                <div class="card-body">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text">{{ $id }}</p>
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{ $id }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center align-content-center my-3">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Post Creator Info
                </div>
                <div class="card-body">
                    <h5 class="card-title">Name</h5>
                    <p class="card-text">{{ $id }}</p>
                    <h5 class="card-title">Email</h5>
                    <p class="card-text">{{ $id }}</p>
                    <h5 class="card-title">Created At</h5>
                    <p class="card-text">{{ $id }}</p>
                </div>
            </div>
        </div>
    </div>


@endsection
