@extends('layouts.app')
@section('title', 'Blog - Edit Post')
@section('content')
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-6">
            <form method="POST" action="{{ route('posts.update',$id) }}">
                @method('put')
                @csrf
                <div class="mb-3">
                    <p class="h1">Edit post</p>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $id }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description"
                        value="{{ $id }}">
                </div>

                <div class="mb-3">
                    <label for="post-creator" class="form-label">Post Creator</label>
                    <select name="post-creator" class="form-control">
                        <option value="Aly">Aly</option>
                        <option value="Ahmed">Ahmed</option>
                        <option value="Omar">Omar</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>

@endsection
