@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $post->title }}</h2>
                <p>posted by  {{ $post->user['name'] }} on 
                    {{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y')}} 
                </p>
                <div>
                {!! $post->content !!}
                </div>
            </div>
            
        </div>
    </div>
@endsection