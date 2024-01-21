@extends('layouts.app_without_hero')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Edit Blog</h2>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        <div class="form-group">
                            <strong><label for="title">Title</label></strong>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                        </div>
                        <div class="form-group">
                            <strong><label for="Content">Content</label></strong>
                            <textarea name="content" class="description ckeditor form-control" name="wysiwyg-editor">{{ $post->content }}</textarea>
                            @error('description')
                                <span class="invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong><label for="published_at">Publication Date</label></strong>
                            <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $post->published_at->format('Y-m-d') }}" required>
                        </div>

                        <!-- Image Upload Fields -->
                        <strong><label for="title">Optional Images</label></strong>
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="form-group">
                                <label for="image_{{ $i }}">Image {{ $i }}</label>
                                <input type="file" class="form-control" id="image_{{ $i }}" name="image_{{ $i }}">
                                @if ($post->{"image_$i"})
                                    <p>Current Image:</p>
                                    <img src="{{ asset($post->{"image_$i"}) }}" alt="Current Image {{ $i }}" style="max-width: 200px;">
                                @endif
                            </div>
                        @endfor

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
