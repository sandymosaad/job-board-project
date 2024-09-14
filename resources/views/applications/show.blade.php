@extends('layouts.app')

@section('title')
Application Details
@endsection

@section('main')
<div class="card mx-auto my-2 w-75">
    <div class="card-header">
        {{$application->user->name}}
    </div>
    <div class="card-body">
        <h5 class="card-title">Applicant jobTitle</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

        <a href="{{--asset('resumes/applications/' . $post['resume'])--}}" class="btn btn-primary">Resume</a>
        <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Accept</button>
        </form>
        <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
    </div>
</div>
@endsection