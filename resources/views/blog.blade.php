@extends('layouts.app')
@section('content')

<div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        From the Firehose
      </h3>

      @foreach($posts as $post)
      <article class="blog-post">
        <a href="{{ route('blog.id', ['id'=>$post->id]) }}">
        <h2 class="blog-post-title">{{$post->title}}</h2>
        </a>
        
        <p class="blog-post-meta">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }} by <a href="#">{{ $post->user['name'] }}</a></p>

        <div> {{ $post->content }}</div>
      </article>
      @endforeach

      {{ $posts->links() }}

    </div>

    @include('components.about')
  </div>

@stop