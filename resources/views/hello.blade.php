@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Hello {{ $name }}</h2>
        <h3>{{ $photo }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('hello.verify') }}" method="post">
            @csrf
            <input type="text" name="name">
            <input type="submit" value="submit">
        </form>

        <!-- POSTS -->
        <ul>
        @foreach($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
        </ul>
    </div>
@endsection