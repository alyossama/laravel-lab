@extends('layouts.app')
@section('title', 'Blog - Edit Post')
@section('content')
    @if (session()->has('success'))
        <div class="row mt-5 justify-content-center">
            <div class="col-6">
                <div class="alert alert-success ">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-6">
            <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <p class="h1">Edit post</p>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                        class="form-control
                        @error('title')
                        is-invalid
                        @enderror"
                        name="title" id="title" value="{{ $post->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text"
                        class="form-control
                        @error('description')
                        is-invalid
                        @enderror"
                        rows="5" name="description" id="description">{{ $post->description }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- @dd($post->image) --}}
                <div class="mb-3">
                    <label for="postImage" class="form-label">Post image</label>
                    <input class="form-control" type="file" name="postImage" id="postImage">
                </div>
                @error('postImage')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="mb-3">
                    <label for="post-creator" class="form-label">Post Creator</label>
                    <select name="post-creator" class="form-control">
                        @foreach ($users as $user)
                            <option {{ $post->user_id == $user['id'] ? 'selected' : '' }} value="{{ $user['id'] }}">
                                {{ $user['name'] }}</option>
                        @endforeach

                    </select>
                    @error('post-creator')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>

@endsection
