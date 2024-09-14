<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Assuming you're using Laravel Mix or a CSS file -->
</head>
<body>

    <!-- Main Layout with two columns -->
    <div class="container mx-auto mt-6 flex space-x-4">
        
        <!-- Profile Info Section (left side) -->
        <div class="w-1/3 bg-gray-100 p-4 rounded">
            <h1 class="text-3xl font-bold mb-4">Welcome, {{ $user->name }}</h1>
            
            <!-- Profile Image -->
            <div class="mb-4">
                @if($user->image)
                    <img src="{{ asset('uploads/' . $user->image) }}" alt="Profile Image" class="img-thumbnail" width="150">
                @else
                    <img src="{{ asset('uploads/default-profile.jpeg') }}" alt="Default Profile Image" class="img-thumbnail" width="150">
                @endif
            </div>  

            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
            
            <!-- Add a button to edit profile -->
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">
                Edit Profile
            </a>
        </div>

<<<<<<< HEAD
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profileimage" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                                @if ($user->image)
                                    <img src="{{ asset('uploads/' . $user->image) }}" alt="Profile Image" class="img-thumbnail mb-3" width="150">
                                @else
                                    <p>No profile image uploaded.</p>
                                @endif
                                <input id="profileimage" type="file" class="form-control @error('profileimage') is-invalid @enderror" name="image">

                                @error('profileimage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
=======
        <!-- Applications Section (right side) -->
        <div class="w-2/3 bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Your Applications (Status: {{ ucfirst($currentStatus) }})</h2>
            
            <!-- Links to filter applications by status -->
            <div class="mb-4">
                <a href="{{ route('profile.index', ['status' => 'waiting']) }}" class="mx-2 text-blue-500 hover:underline">
                    Waiting Applications
                </a>
                <a href="{{ route('profile.index', ['status' => 'accepted']) }}" class="mx-2 text-blue-500 hover:underline">
                    Approved Applications
                </a>
                <a href="{{ route('profile.index', ['status' => 'rejected']) }}" class="mx-2 text-blue-500 hover:underline">
                    Rejected Applications
                </a>
                <a href="{{ route('profile.index', ['status' => 'cancelled']) }}" class="mx-2 text-blue-500 hover:underline">
                    Cancelled Applications
                </a>
>>>>>>> 94a28b295747ba53def4cc4494cf619df9e3e56f
            </div>
            
            <!-- Display success or error messages -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- List of Applications -->
            <ul class="list-disc pl-6">
                @foreach ($applications as $application)
                    <li class="flex items-center mb-2">
                        Application ID: {{ $application->id }} - Status: {{ ucfirst($application->status) }}
                        @if($application->status === 'waiting')
                            <!-- Cancel Button -->
                            <form action="{{ route('applications.cancel', $application) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Cancel
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>

</body>
</html>
