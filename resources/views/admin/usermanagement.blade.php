@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">User Management</h2>

    <!-- Button to Add New User -->
    <a href="{{ route('users.create') }}" class="btn btn-outline-success mb-3">Add New User</a>

    <!-- Table to Display Users -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->type) }}</td> <!-- Capitalize the first letter of role -->
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                    <!-- Delete Button with Confirmation -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" @if($user->type === 'admin') disabled @endif> Delete
                                    </button>
                            </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection