@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Msafiri Blogs</h2>

                {{-- Display all blog posts for all users --}}
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text"><small class="text-muted">Published on {{ $post->published_at->format('F d, Y') }}</small></p>
                        </div>
                    </div>
                @endforeach

                {{-- Admin panel for posting --}}
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="card">
                            <div class="card-header">Admin Panel</div>
                            <div class="card-body">
                                <h5 class="card-title">New Post</h5>
                                <form action="{{ route('admin.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="description"  class="description ckeditor form-control" name="wysiwyg-editor">
                                            {{ old('description')}}
                                        </textarea>

                                     @error('description')
                                     <span class="invalid"  role="alert">
                                     <strong>{{ $message }}</strong>
                                     </span>
                                     @enderror         
                                  </div>
                                    <div class="form-group">
                                        <label for="published_at">Publication Date</label>
                                        <input type="date" class="form-control" id="published_at" name="published_at" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </form>
                            </div>
                        </div>


                    @endif
                @endauth
            </div>

            {{-- Add your other columns or sections here --}}
        </div>
    </div>
@endsection
