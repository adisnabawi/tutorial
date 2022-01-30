@extends('layouts.app')
@section('content')
  <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 fst-italic">{{ Str::upper($main->title) }}</h1>
      <p class="lead my-3">{{ Str::limit($main->content, 50) }}</p>
      @php
      $timetoread = (Str::wordCount($main->content) * 100/1000);
      @endphp
      <small>{{  $timetoread > 60 ?  number_format($timetoread/60) . ' minutes ': $timetoread . ' seconds ' }} 
         to read</small>
      <p class="lead mb-0">
        <a href="{{ route('blog.id', ['id'=>$main->id]) }}" class="text-white fw-bold">Continue reading...</a>
      </p>
    </div>
  </div>
  <div>
    <h5>Inspiring Quote</h5>
    <div class="alert alert-primary" role="alert">
      <span id="quote"></span>
      <script>
        var quote = '';
        displayQuote();
        setInterval(displayQuote, 10000);
        function displayQuote(){
          var r = new XMLHttpRequest();
          r.open("GET", "{{ route('api.index') }}", true);
          r.onreadystatechange = function () {
            if (r.readyState != 4 || r.status != 200) return;
            quote = JSON.parse(r.responseText);
            document.getElementById('quote').textContent = quote.quote;
          };
          r.send();
        }
        
      </script>
    </div>
    <br>
  </div>

  <div class="row mb-2">
  @foreach($posts as $post)
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($post->created_at)->format('F, d') }}</div>
          <p class="card-text mb-auto">{{$post->title}}</p>
          <a href="{{ route('blog.id', ['id'=>$post->id]) }}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

        </div>
      </div>
    </div>
  @endforeach
  </div>
@stop



