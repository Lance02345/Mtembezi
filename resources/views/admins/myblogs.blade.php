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
                          <!-- Calculatio and display the time since joining -->
               @php
                  $joinDate = Auth::user()->created_at;
                  $timeSinceJoining = $joinDate->diffForHumans();
               @endphp

              <p class="card-text"><strong>Joined :</strong> {{ $timeSinceJoining }}</p> 
              
                           <!-- Display the number of blogs the user has -->
               @php
                  $userBlogCount = Auth::user()->posts->count();
               @endphp

              <p class="card-text"><strong>Number of Blogs :</strong> {{ $userBlogCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        @foreach($blogs as  $blog)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $blog->title }}</h3> 

                    <!-- Fetch publication date  -->                     
                    <p class="card-text"><small class="text-muted">Published on {{ $blog->published_at->format('F d, Y') }} </small></p>

                    <!-- Options for edit and delete -->
                    <div class="mt-3">
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <form action="" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
</div>
@endsection
