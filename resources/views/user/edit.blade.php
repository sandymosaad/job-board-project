@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
        <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror   
        </div>

        <div class="form-group mb-3">
        <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror    
        </div>

        <div class="form-group mb-3">
            <label for="password">Password (leave blank to keep current password)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="type">Role</label>
            <select name="type" class="form-control" required>
                <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="employer" {{ $user->type == 'employer' ? 'selected' : '' }}>Employer</option>
                <option value="candidate" {{ $user->type == 'candidate' ? 'selected' : '' }}>Candidate</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
