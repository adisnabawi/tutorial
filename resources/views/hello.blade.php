@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
        <h5 class="card-header">Welcome</h5>
        <div class="card-body">
            <h2>Hello <span class="fw-bolder">{{ Auth::user()->name }}</span></h2>
        </div>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br> 
        <h5>Add New Post Title</h5>
        <small class="fs-6 fw-lighter mb-2">Note: The content will be random using Faker</small>
        <form action="{{ route('hello.verify') }}" method="post" class="form mt-2">
            @csrf
            <div class="row">
            <div class="col-8">
                <input type="text" name="name" class="form-control" placeholder="Title">
            </div>
            <div class="col-4 d-grid gap-2">
                <input type="submit" value="Submit" class="btn btn-primary btn-block ">
            </div>
            </div>
            
        </form>

        <!-- POSTS -->
        <div class="row mb-2">
            <div class="col-md-12 my-4">
                <h5>List of Posts</h5>
            </div>
            <div class="col-md-12">
                @foreach($posts as $post)
                    <div class="card mb-2">
                        <div class="card-body">
                            <a href="{{ route('blog.id', ['id'=>$post->id]) }}" target="_blank">{{ Str::headline($post->title) }}</a>
                            <br>
                            {{ Str::limit($post->content, 200)}}
                            <br>
                            <small>posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</small>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>
        </div>
        
    </div>
@endsection