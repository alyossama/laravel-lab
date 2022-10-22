@extends('layouts.app')
@section('title', 'Blog - Index')
@section('content')
    <div class="row justify-content-center align-items-center my-5">
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <p class="h1">Posts Index</p>
                </div>
                <div class="text-center col-6">
                    <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Posted By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post['id'] }}</th>
                            <td>{{ $post['title'] }}</td>
                            <td>{{ $post['posted_by'] }}</td>
                            <td>{{ $post['creation_date'] }}</td>
                            <td class="row">
                                <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info">View</a>
                                <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-primary">Edit</a>
                                <form method="post" action="{{ route('posts.destroy', $post['id']) }}">
                                    @method('delete')
                                    @csrf
                                    <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
