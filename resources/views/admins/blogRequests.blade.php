@extends('layouts.app_without_hero')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- User information card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <img src="{{ asset('storage/images/traveller_2517614.png')}}" alt="User Avatar" class="img-fluid rounded-circle" style="max-width: 100px;">

                        <p class="card-text"><strong>Role:</strong> {{ Auth::user()->role }}</p>


                        <!-- Calculate and display the time since joining -->
                        @php
                            $joinDate = Auth::user()->created_at;
                            $timeSinceJoining = $joinDate->diffForHumans();
                        @endphp

                        <p class="card-text"><strong>Joined :</strong> {{ $timeSinceJoining }}</p>

                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <h3>Blog Requests</h3>
                @foreach($blogRequests as $request)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">User: {{ $request->user->email }}</h5>
                            <p class="card-text"><strong>Role:</strong> {{ $request->user->role }}</p>

                            <div class="mt-3">
                                <!-- route and controller method for approval -->
                                <form action="{{ route('admin.approveRequest', ['id' => $request->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <!-- route and controller method for declining -->
                                <form action="{{ route('admin.declineRequest', ['id' => $request->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
