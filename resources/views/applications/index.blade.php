@extends('layouts.app')

@section('title')
All Applications
@endsection
 

@section('sub-navbar')
<li class="navbar-item">
    <a class="nav-link " href="{{ route('applications.indexEmployerApp', ['post_id' => $post_id, 'status' => 'waiting']) }}">Pending
        Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.indexEmployerApp', ['post_id' => $post_id, 'status' => 'accepted']) }}">Accepted
            Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.indexEmployerApp', ['post_id' => $post_id, 'status' => 'rejected']) }}">Rejected
            Applications</a>
    </li>
    <li class="navbar-item">
        <a class="nav-link"
            href="{{ route('applications.indexEmployerApp', ['post_id' => $post_id, 'status' => 'cancelled']) }}">Cancelled
            Applications</a>
    </li>
@endsection

@section('main')

@if(session('status') )
<div class="alert alert-success mx-auto my-2 w-75">
    {{ session('status') }}
</div>
@endif

@foreach ($applications as $application)
<div class="card mx-auto my-2 w-75">
    <div class="card-header">
        {{$application->user->name}}
    </div>
    <div class="card-body">
        <!-- <h5 class="card-title">Applicant jobTitle</h5> -->
        <p class="card-text">Email: {{$application->user->email}}</p>
        <p class="card-text">Phone: {{$application->user->phone}}</p>
        <a href="" class="btn btn-outline-primary">Resume</a>
 
        @if ($currentStatus == 'waiting')
        <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="postId" value="{{$post_id}}"> 
            <button type="submit" class="btn btn-outline-success">Accept</button>
        </form>
        <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="postId" value="{{$post_id}}"> 

            <button type="submit" class="btn btn-outline-danger">Reject</button>
        </form>
        @endif
    </div>
@endforeach
{{ $applications->links() }}
@endsection