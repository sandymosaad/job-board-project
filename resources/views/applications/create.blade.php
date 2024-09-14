@extends('layouts.app')

@section('title')
Create Application
@endsection

@section('main')
<form action='{{route("applications.store")}}' method='POST' enctype='multipart/form-data' style="width: 70%;"
    class="m-auto form-background">
    @csrf
    <div class='form-group mt-5'>
        <label for='email'>Email</label>
        <input type='text' class='form-control' id='email' name='email' value='{{Auth::user()->email}}'>
        @error('email')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>
    <div class='form-group mt-3'>
        <label for='phone'>Phone</label>
        <input type='text' class='form-control' id='phone' name='phone' value='{{Auth::user()->phone}}'>
        @error('phone')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
    </div>
    <div class='form-group mt-3'>
        <label for='resume'>Upload Resume</label>
        <input type='file' name='resume'>
        @error('resume')
            <div class='alert alert-danger'>{{ $message }}</div>
        @enderror
        <input type='hidden' name='postId' value="{{$postId}}">
    </div>
    <button type='submit' class='btn btn-outline-success mt-3'>Send Application</button>
</form>
@endsection