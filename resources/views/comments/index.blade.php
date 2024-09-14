@extends('layouts.app')

@section('sub-main')

<div class="card shadow mb-3">
    <div class="card-body">
        <h4 class="mb-3">Add a comment</h4>
        <form method="post" action="{{ route('comment.create') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="comment_body" class="form-control" placeholder="Enter your comment"
                    aria-label="Comment" />
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning">Add Comment</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <h4>Comments</h4>
        @foreach($post->comments as $comment)
            <div class="mb-4 ps-3 pe-3 pt-2 comment-background border rounded">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection