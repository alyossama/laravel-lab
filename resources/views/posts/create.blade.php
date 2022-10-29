@extends('layouts.app')
@section('title', 'Blog - Create new post')
@section('content')
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-4">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="mb-3">
                    <p class="h1">Create new post</p>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value="{{ old('title') }}"
                        class="form-control
                    @error('title')
                    is-invalid
                    @enderror"
                        name="title" id="title">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" rows="5"
                        class="form-control @error('description')
                    is-invalid
                    @enderror"
                        name="description" id="description">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
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
                        <option selected disabled>Select an option</option>
                        @foreach ($users as $user)
                            <option {{ old('post-creator') ? 'selected' : '' }} value="{{ $user['id'] }}">
                                {{ $user['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('post-creator')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
