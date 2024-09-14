@extends('layouts.app')
<?php use Carbon\Carbon;
?>

@section('main')
@if(session('success'))
    <div class="alert alert-success">{{ session("success") }}</div>
@endif

@if(session('error'))

<div class="alert alert-danger">{{ session("error") }}</div>

@endif

@foreach ($posts as $post)
<div class="card mb-10">
  <h5 class="card-header">{{$post->category}}</h5>
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <p class="card-text">{{$post->description}}</p>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
@endforeach

@endsection