@extends('layouts.app')

@section('content')
    <div class="container">

        <style>

            .full-width-card {
                flex: 0 0 70%;
                box-sizing: border-box;
                margin-bottom: 2px; /* Adjust the margin to reduce space */
                margin-left: auto; /* Center the card horizontally */
                margin-right: auto; /* Center the card horizontally */
            }
        </style>

        <div class="row">
            @foreach($posts as $post)
                <div class="full-width-card"> <!-- Use the new class -->
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3> 

                            <!-- Check if images exist before rendering the carousel -->
                            @if ($post->image_1 || $post->image_2 || $post->image_3 || $post->image_4 || $post->image_5)
                                <div id="carousel{{ $post->id }}" class="carousel slide" data-ride="carousel" style="height: 350px;">
                                    <div class="carousel-inner" style="height: 100%;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($post->{"image_$i"})
                                                <div class="carousel-item{{ $i === 1 ? ' active' : '' }}" style="height: 100%;">
                                                    <img src="{{ asset($post->{"image_$i"}) }}" class="d-block w-100 h-100" alt="Image {{ $i }}" style="object-fit: cover;">
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel{{ $post->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel{{ $post->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            @endif

                            <!-- Strip tags to make sure it displays exactly what the user input -->
                            <p class="card-text overflow-hidden">{!! $post->content !!}</p>

                            <!-- Fetch publication date and the name of the user who posted the blog -->                     
                            <p class="card-text"><small class="text-muted">Published on {{ $post->published_at->format('F d, Y') }}  - {{ $post->user->name }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
