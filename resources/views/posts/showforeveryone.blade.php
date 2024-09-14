@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp
 
@section('content')
@if (session('status'))
<div class="alert alert-success" id="flash-message">
    {{ session('status') }}
</div>
@endif
<div class="container mt-5">
    <!-- Job Post Card -->
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/posts/' . $post->logo) }}" class="img-fluid rounded-start" alt="Post Image"
                    style="object-fit: cover; height: 100%;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title text-teal">{{ $post->title }}</h1>
                    <p class="card-text">{{ $post->description }}</p>

                    <div class="mb-3">
                        <p class="text-teal">Location: <small class="text-muted">{{ $post->location }}</small></p>
                        <p class="text-teal">Work Type: <small class="text-muted">{{ $post->workType }}</small></p>
                        <p class="text-teal">Category: <small class="text-muted">{{ $post->category }}</small></p>
                        <p class="text-teal">Skills: <small class="text-muted">{{ $post->skills }}</small></p>
                        <p class="text-teal">Benefits: <small class="text-muted">{{ $post->benefites }}</small></p>
                        <p class="text-teal">Salary: <small class="text-muted">{{ $post->salaryRange }}</small></p>
                        <p class="text-teal">Deadline: <small class="text-muted">
                                {{ Carbon::parse($post->deadline)->format('d M Y') }} at 12:00 AM</small></p>
                    </div>
                    <small class="card-text"><small class="text-muted">Last updated
                            {{ Carbon::parse($post->updated_at)->format('d M Y, h:i A') }}</small></small>
                </div>

                <div class="card-footer d-flex justify-content-start bg-light">
                    @if($post->status == 'approved')
                        @if(Auth::check())
                            @if(Auth::user()->type == 'candidate')
                                <a class="btn btn-outline-success me-2" href="{{ route('applications.createApp', $post->id) }}">Apply</a>
                            @endif
                            @if(Auth::user()->type == 'employer' && Auth::user()->id == $post->user_id)
                                <a class="btn btn-outline-success me-2" href="{{route('applications.indexEmployerApp', $post->id)}}">Applications</a>
                                <a class="btn btn-outline-primary me-2" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                            @endif
                            @if(Auth::user()->type == 'admin' || (Auth::user()->type == 'employer' && Auth::user()->id == $post->user_id))
                                <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#confirmModal-post-{{ $post->id }}">Delete</button>
                                </form>
                            @endif
                        @endif
                    @elseif($post->status == 'pending')
                        <div class="text-center text-warning">
                            This post is awaiting approval
                        </div>
                    @elseif($post->status == 'rejected')
                        <div class="text-center text-danger">
                            This post has been rejected
                        </div>
                    @endif
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="confirmModal-post-{{ $post->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this post?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('posts.destroy', $post) }}" method="post" id="delete-form-{{ $post->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">Delete</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($post->status != 'pending' && $post->status != 'rejected')
    <!-- Comments -->
    <div class="container mt-5">
        <h3>Comments:</h3>
        <!-- Add New Comment Section -->
        @if(Auth::check())
            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Write your comment here..." required></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-outline-primary">
                            Comment
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Display Comments -->
        @foreach ($post->comments as $comment)
            <div class="card comment-box mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>{{ $comment->user->name }}</strong>
                    <small class="comment-time">{{ $comment->created_at->format('M d, Y h:i A') }}</small>
                </div>

                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>

                    @if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->type == 'admin'))
                        <!-- Delete Button -->
                        <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-comment-{{ $comment->id }}">Delete</button>
                        </form>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="confirmModal-comment-{{ $comment->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this comment?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Button -->
                        @if(Auth::check() && (Auth::user()->id == $comment->user_id ))
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCommentModal-{{ $comment->id }}">Edit</button>
                        @endif
                        <!-- Edit Comment Modal -->
                        <div class="modal fade" id="editCommentModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <textarea class="form-control" name="content" rows="3">{{ $comment->content }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach((button) => {
            button.addEventListener('click', (e) => {
                const formId = e.target.getAttribute('data-form-id');
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                }
            });
        });
    });
</script>

<!-- External JS Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>