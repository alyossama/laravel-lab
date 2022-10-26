@extends('layouts.app')
@section('title', 'Blog - Index')
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
        <div class="col-8">
            <div class="row align-items-center">
                <div class="col-6">
                    <p class="h1">Posts Index</p>
                </div>
                <div class="text-center col-6">
                    <a href="{{ route('post.create') }}" class="mt-4 btn btn-success">Create Post</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-hover mt-4 text-center">
                <thead class="bg-primary border-none">
                    <tr class="text-white">
                        <th class="rounded-pill" scope="col">#</th>
                        <th class="rounded-pill" scope="col">Title</th>
                        <th class="rounded-pill" scope="col">Slug</th>
                        <th class="rounded-pill" scope="col">Posted By</th>
                        <th class="rounded-pill" scope="col">Created At</th>
                        <th class="rounded-pill" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    {{-- @dd($post->user) --}}
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td class="row">
                                <div class="col-4"><a href="{{ route('post.show', $post->id) }}"
                                        class="btn btn-info">View</a></div>
                                <div class="col-4"><a href="{{ route('post.edit', $post->id) }}"
                                        class="btn btn-warning">Edit</a></div>
                                <div class="col-4">
                                    <form method="post" action="{{ route('post.destroy', $post->id) }}">
                                        @method('delete')
                                        @csrf
                                        <input type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger" value="Delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($posts->links())
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
            @endif

        </div>
    </div>







@endsection
