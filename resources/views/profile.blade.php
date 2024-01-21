
@extends('layouts.app_without_hero')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- User information card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        
                        <!-- Fetch and display the user's avatar from the database -->
                        <img src="{{ asset(Auth::user()->avatar ? Auth::user()->avatar : 'storage/images/default_avatar.png') }}" alt="User Avatar" class="img-fluid rounded-circle" style="max-width: 100px;">

                        <p class="card-text"><strong>Role:</strong> {{ Auth::user()->role }}</p>

                        <!-- Display other user data -->
                        <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p class="card-text"><strong>Phone Number:</strong> {{ Auth::user()->phone_number ?? 'Not provided' }}</p>

                        <!-- Calculate and display the time since joining -->
                        @php
                            $joinDate = Auth::user()->created_at;
                            $timeSinceJoining = $joinDate->diffForHumans();
                        @endphp

                        <p class="card-text"><strong>Joined :</strong> {{ $timeSinceJoining }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
