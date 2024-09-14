<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <img src="{{ asset('/storage/' . $post->logo) }}" alt="Post Image" style="border-radius: 50%;">
    <p>{{ $post->description }}</p>
    <!-- Add Comments and Apply Buttons based on User Role -->
</div>
@endsection
