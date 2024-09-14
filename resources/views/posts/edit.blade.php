@extends('layouts.app')
<?php
use Carbon\Carbon;
?>

@section('navbar')
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
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Posts pending</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected Posts </a>
    </li>
</ul>
@endsection


<!-- <h1 class="text-primary" style="text-align: center;">Edit Post</h1> <br> -->
<!-- <form action="{{ route('posts.update', $post['id']) }}" method="POST" enctype="multipart/form-data" style="width: 70%;"
    class="m-auto">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-primary" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post['title'] }}"
                    placeholder="Enter job title" required>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-primary" for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ $post['category'] }}"
                    placeholder="Enter job category" required>
                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><br>

    <div class="form-group">
        <label class="text-primary" for="description">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter job description"
            required>{{ old('description', $post['description']) }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-primary" for="skills">Skills</label>
                <input type="text" name="skills" id="skills" class="form-control" value="{{ $post['skills'] }}"
                    placeholder="Enter required skills" required>
                @error('skills')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-primary" for="salaryRange">Salary Range</label>
                <input type="text" name="salaryRange" id="salaryRange" class="form-control"
                    value="{{ $post['salaryRange'] }}" placeholder="Enter salary range" required>
                @error('salaryRange')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><br>

    <div class="form-group">
        <label class="text-primary" for="benefites">Benefits</label>
        <textarea name="benefites" id="benefites" class="form-control" value="{{ $post['benefites'] }}"
            placeholder="Enter job benefits" required>{{ old('benefites' , $post['benefites']) }}</textarea>
        @error('benefites')

        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <label class="text-primary" for="location">Location</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ $post['location'] }}"
            placeholder="Enter job location" value="{{ old('location') }}" required>
        @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <label class="text-primary" for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline', Carbon::parse($post['deadline'])->format('Y-m-d')
            ) }}" required>
        @error('deadline')

        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <label class="text-primary">Work Type</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="remote" value="remote"
                {{ old('workType', $post['workType']) == 'remote' ? 'checked' : '' }} required>
            <label class="form-check-label" for="remote">Remote</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="onsite" value="onsite"
                {{ old('workType', $post['workType']) == 'onsite' ? 'checked' : '' }} required>
            <label class="form-check-label" for="onsite">Onsite</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="hybrid" value="hybrid"
                {{ old('workType', $post['workType']) == 'hybrid' ? 'checked' : '' }} required>
            <label class="form-check-label" for="hybrid">Hybrid</label>
        </div>
    </div><br>

    <div class="form-group">
        <label class="text-primary" for="logo">Logo</label>
        <input type="file" name="logo" id="logo" class="form-control">
        <img src="{{  asset('/storage/' . $post->logo) }}" width="100px" height="100px" style="border-radius: 50%;">
        @error('logo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <button type="submit" class="btn btn-primary">Updaet Post</button>
</form> -->
@section('main')
<form action="{{ route('posts.update', $post['id']) }}" method="POST" enctype="multipart/form-data"
    class="container mt-4 form-background">
    @csrf
    @method('PUT')
    <h1 class=" text-center text-primary mb-4">Edit Post</h1>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $post['title']) }}" placeholder="Enter job title" required>
                @error('title')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control"
                    value="{{ old('category', $post['category']) }}" placeholder="Enter job category" required>
                @error('category')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter job description"
            required>{{ old('description', $post['description']) }}</textarea>
        @error('description')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="skills">Skills</label>
                <input type="text" name="skills" id="skills" class="form-control"
                    value="{{ old('skills', $post['skills']) }}" placeholder="Enter required skills" required>
                @error('skills')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="salaryRange">Salary Range</label>
                <input type="text" name="salaryRange" id="salaryRange" class="form-control"
                    value="{{ old('salaryRange', $post['salaryRange']) }}" placeholder="Enter salary range" required>
                @error('salaryRange')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="benefites">Benefits</label>
        <textarea name="benefites" id="benefites" class="form-control" placeholder="Enter job benefits"
            required>{{ old('benefites', $post['benefites']) }}</textarea>
        @error('benefites')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" class="form-control"
            value="{{ old('location', $post['location']) }}" placeholder="Enter job location" required>
        @error('location')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control"
            value="{{ old('deadline', Carbon::parse($post['deadline'])->format('Y-m-d')) }}" required>
        @error('deadline')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label>Work Type</label><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="remote" value="remote"
                {{ old('workType', $post['workType']) == 'remote' ? 'checked' : '' }} required>
            <label class="form-check-label" for="remote">Remote</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="onsite" value="onsite"
                {{ old('workType', $post['workType']) == 'onsite' ? 'checked' : '' }} required>
            <label class="form-check-label" for="onsite">Onsite</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="workType" id="hybrid" value="hybrid"
                {{ old('workType', $post['workType']) == 'hybrid' ? 'checked' : '' }} required>
            <label class="form-check-label" for="hybrid">Hybrid</label>
        </div>
    </div> 

    <div class="form-group mb-4">
        <label class="text-primary" for="logo">Logo</label>
        <input type="file" name="logo" id="logo" class="form-control">
        @if($post->logo)
        <img src="{{ asset('images/posts/' . $post->logo) }}" width="100" height="100" class="mt-2"
            style="border-radius: 50%;" alt="Post Logo">
        @endif
        @error('logo')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
</form>


@endsection