@extends('layouts.app')

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

@section('main')

<h1 style="text-align: center;">
    Create New Post
</h1>


<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" style="width: 70%;"
    class="m-auto form-background">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter job title"
                    value="{{ old('title') }}" required>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" placeholder="Enter job category"
                    value="{{ old('category') }}" required>
                @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><br>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter job description"
            required>{{ old('description') }}</textarea>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="skills">Skills</label>
                <input type="text" name="skills" id="skills" class="form-control" value="{{ old('skills') }}"
                    placeholder="Enter required skills">
                @error('skills')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="salaryRange">Salary Range</label>
                <input type="text" name="salaryRange" id="salaryRange" class="form-control"
                    value="{{ old('salaryRange') }}" placeholder="Enter salary range" required>
                @error('salaryRange')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div><br>

    <div class="form-group">
        <label for="benefites">Benefits</label>
        <textarea name="benefites" id="benefites" class="form-control" placeholder="Enter job benefits"
            required>{{ old('benefites') }}</textarea>
        @error('benefites')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <label for="location">Location</label>

        <input type="text" name="location" id="location" class="form-control" placeholder="Enter job location"
            value="{{ old('location') }}" required>
        @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}" required>
        @error('deadline')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <div class="form-group">
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
    </div><br>

    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo" value="{{ old('logo') }}" class="form-control">
        @error('logo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div><br>

    <button type="submit" class="btn btn-primary">Create Post</button>
</form>

@endsection
