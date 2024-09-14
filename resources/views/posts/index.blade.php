@extends('layouts.app')



@php
use Carbon\Carbon;
@endphp


<!-- @section('navbar')
<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item active">
        <a class="nav-link" href="#raina">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/posts/create">Create Post</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'approved']) }}">Approved Posts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Pending Posts </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected Posts </a>
    </li>
</ul>
@endsection -->

@section('main')

@if (session('success'))
<div class="alert alert-success" id="flash-message">
    {{ session('success') }}
</div>
@endif
<!-- back to sandy -->
@if (session('error'))
<div class="alert alert-success" id="flash-message">
    {{ session('error') }}
</div>
@endif

@if ($posts->count() > 0)
@foreach($posts as $post)


<div class="container  mt-5">
    <div class="card mb-2">
        <img src="{{ asset('images/posts/' .$post->logo ) }}" class="card-img-side" alt="Post Image">

        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <h3 class="card-title mb-0">{{ $post['title'] }}</h3>
                <h5 class="card-subtitle mb-0 text-muted ms-2">
                    <i><small>{{ $post['workType'] }}</small></i>
                </h5>
            </div>
            <h5 class="card-subtitle mb-2 text-muted">
                <small>{{ $post['location'] }}</small> <i class="material-icons">location_on</i>
            </h5>
            <p class="card-text">{{ $post['description'] }}</p>
            <div class="d-flex gap-2 mt-3">

                <a href="{{ route('posts.showForEveryOne', $post['id']) }}" class="btn btn-outline-primary">Read More</a>
            </div>
        </div>

        <div class="card-footer text-muted">
            Posted on {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}, by {{ $post->user->name }}
        </div>
    </div>
</div>

@endforeach

@else
<h1 class="text-center mt-5 p-4"
    style="background-color: #f8d7da; color: #721c24; border-radius: 5px; border: 1px solid #f5c6cb; width: 70%; margin: 0 auto;">
    There are no posts available.
</h1>

@endif
<script>
setTimeout(function() {
    documen
    t.getElementById('flash-message').style.display = 'none';
}, 1000);
</script>
<script src="{{ mix('js/app.js') }}"></script>

@endsection
