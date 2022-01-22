@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('signup.create') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name" class="form-control">
            <input type="email" name="email" placeholder="Email" class="form-control">
            <input type="password" name="password" placeholder="Password" class="form-control">
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</div>
@endsection
