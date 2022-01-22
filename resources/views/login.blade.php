@extends('layouts.app')
@section('content')
<div class="row g-5">
    <h3>Login</h3>
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <input type="email" name="email" class="form-control">
        <input type="password" name="password" class="form-control">
        <button type="submit" class="btn btn-primary">Login </button>
    </form>
</div>
@endsection

