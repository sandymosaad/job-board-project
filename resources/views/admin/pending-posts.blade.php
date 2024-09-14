@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center">Pending Posts</h3>
    
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($pendingPosts->isEmpty())
        <p class="text-center text-muted">No pending posts at the moment.</p>
    @else
        <div class="row">
            @foreach($pendingPosts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            
                            <ul class="list-unstyled mb-3">
                                <li><strong>Location:</strong> <span class="text-muted">{{ $post['location'] }}</span></li>
                                <li><strong>Work Type:</strong> <span class="text-muted">{{ $post['workType'] }}</span></li>
                                <li><strong>Category:</strong> <span class="text-muted">{{ $post['category'] }}</span></li>
                                <li><strong>Skills:</strong> <span class="text-muted">{{ $post['skills'] }}</span></li>
                                <li><strong>Benefits:</strong> <span class="text-muted">{{ $post['benefites'] }}</span></li>
                                <li><strong>Salary:</strong> <span class="text-muted">{{ $post['salaryRange'] }}</span></li>
                                <li><strong>Deadline:</strong> <span class="text-muted">{{ Carbon::parse($post['deadline'])->format('d M Y') }} at 12:00 AM</span></li>
                            </ul>
                            
                            <small class="text-muted">Last updated: {{ Carbon::parse($post['updated_at'])->format('d M Y, h:i A') }}</small>
                        </div>
                        
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                            <!-- Approve Button -->
                            <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-success me-2">Approve</button>
                            </form>

                            <!-- Reject Button -->
                            <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger me-2 ">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
