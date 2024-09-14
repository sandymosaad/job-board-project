<!-- resources/views/jobboard/home.blade.php -->
<?php
    use Carbon\Carbon;
?>

@extends('layouts.app')
@section('content')


@if (session('status'))
<div class="alert alert-success" id="flash-message">
    {{ session('status') }}
</div>
@endif
<div class="container">
    @if ($posts->count() > 0)
        @foreach($posts as $post)
        <div class="container mt-5">
            <div class="card mb-4">
                <img src="{{ asset('images/posts/' . $post->logo) }}" class="card-img-side" alt="Post Image" style="border-radius: 50%;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h3 class="card-title mb-0">{{ $post->title }}</h3>
                        <h5 class="card-subtitle mb-0 text-muted ms-2">
                            <i><small>{{ $post->workType }}</small></i>
                        </h5>
                    </div>
                    <h5 class="card-subtitle mb-2 text-muted">
                        <small>{{ $post->location }}</small>
                    </h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('posts.showForEveryOne', $post->id) }}" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    
                    Posted on {{ Carbon::parse($post->updated_at)->format('d M Y, h:i A') }}, by {{ $post->user->name }}
                </div>
            </div>
        </div>
        @endforeach
    @else
    <h1 class="text-center mt-5 p-4" style="background-color: #f8d7da; color: #721c24; border-radius: 5px; border: 1px solid #f5c6cb;">
        There are no posts available.
    </h1>
    @endif
</div>
@endsection
