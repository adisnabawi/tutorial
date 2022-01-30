<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Blog</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">

    

    <!-- Bootstrap core CSS -->
<link href="{{ url('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ url('css/app.css')}}">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ url('blog.css') }}" rel="stylesheet">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('eb4f82815eec7b3bf8f4', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      // alert(JSON.stringify(data));
      var alertPlaceholder = document.getElementById('liveAlertPlaceholder');
      function alert(message, type) {
        var wrapper = document.createElement('div')
        wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

        alertPlaceholder.append(wrapper)
      }
      alert('New post available (' + data.message.title +
      ') by ' + data.message.name, 'success');

    });
  </script>
  </head>
  <body>
    
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        @auth
        <span class="link-secondary">Welcome {{ Auth::user()->name }}</span>
        @endauth
        @guest
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Log In</a>
        @endguest
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ route('index') }}">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        @auth
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
          </form>
        @endauth
        @guest
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('signup') }}">Sign up</a>
        @endguest

      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 link-secondary" href="{{ route('blog') }}">Blog</a>
      @auth
        @if(Auth::user()->id == 1)
        <a class="p-2 link-secondary" href="{{ route('hello') }}">Add Posts</a>
        @endif
      @endauth
    </nav>
  </div>
</div>

<main class="container">
<div id="liveAlertPlaceholder" style="position: absolute;
    bottom: 20px;
    z-index: 100;
    right: 20px;"></div>
    @yield('content')
</main>

<footer class="blog-footer">
  <p>Tutorial by Adis Nabawi</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ url('js/app.js') }}"></script>
  </body>
</html>