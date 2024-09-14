<?php
use Carbon\Carbon;
?>

 
@extends('layouts.app')
@section('main')
@if(session('success'))
  <div class="alert alert-success">{{ session("success") }}</div>
@endif

@if(session('error'))

  <div class="alert alert-danger">{{ session("error") }}</div>

@endif
<div class="container mt-5">
  <h1>Filter Posts</h1>
  <form method="GET" action="{{route('posts.filter')}}" class="mb-4">
    <div class="form-row">
    <div class="col-md-3 mb-3">
    <label for="search">Category</label>
    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" name="search"
     value="{{ request('search') }}"> 
    </div>
      
    <div class="col-md-3 mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
          value="{{ request('title') }}">
      </div>
      <div class="col-md-3 mb-3">
        <label for="deadline">Deadline</label>
        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ request('deadline') }}">
      </div>
      <div class="col-md-3 mb-3">
        <label for="workType">Work Type</label>
        <select class="form-control" id="workType" name="workType">
          <option value="">All</option>
          <option value="remote" {{ request('workType') == 'remote' ? 'selected' : '' }}>Remote</option>
          <option value="onsite" {{ request('workType') == 'onsite' ? 'selected' : '' }}>Onsite</option>
          <option value="hybrid" {{ request('workType') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
        </select>
      </div>
      <div class="col-md-3 mb-3">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Location"
          value="{{ request('location') }}">
      </div>
      <div class="col-md-3 mb-3">
        <label for="skills">Skills</label>
        <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills"
          value="{{ request('skills') }}">
      </div>
      <div class="col-md-3 mb-3">
        <label for="salaryRange">Salary Range</label>
        <input type="text" class="form-control" id="salaryRange" name="salaryRange" placeholder="Salary Range"
          value="{{ request('salaryRange') }}">
      </div>


    </div>
    <button type="submit" class="btn btn-outline-primary">Apply Filters</button>
  </form>

  <!-- Posts Section (Example) -->
  <div class="col-md-9">
    <div id="posts">
      <!-- Example Post -->
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
      <!-- Repeat above card block for each post -->
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->

@endsection