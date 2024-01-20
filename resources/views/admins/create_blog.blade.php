@extends('layouts.app_without_hero')

@section('content')
<div class="container">
    <div class="row justify-content-center"> <!-- Added justify-content-center to center the column -->
        <div class="col-md-8">
            <h2>Msafiri Blogs</h2>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <h5 class="card-title">New Blog</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <strong><label for="title">Title</label></strong>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                        <strong><label for="Content">Content</label></strong>
                            <textarea name="content" class="description ckeditor form-control" name="wysiwyg-editor">
                                {{ old('description')}}
                            </textarea>

                            @error('description')
                                <span class="invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong><label for="published_at">Publication Date</label></strong>
                            <input type="date" class="form-control" id="published_at" name="published_at" required>
                        </div>

                        <!-- Image Upload Fields -->
                        <strong><label for="title">Optional Images</label></strong>
                        <div class="form-group">
                            <label for="image_1">Image 1</label>
                            <input type="file" class="form-control" id="image_1" name="image_1">
                        </div>
                        <div class="form-group">
                            <label for="image_2">Image 2</label>
                            <input type="file" class="form-control" id="image_2" name="image_2">
                        </div>
                        <div class="form-group">
                            <label for="image_3">Image 3</label>
                            <input type="file" class="form-control" id="image_3" name="image_3">
                        </div>
                        <div class="form-group">
                            <label for="image_4">Image 4</label>
                            <input type="file" class="form-control" id="image_4" name="image_4">
                        </div>
                        <div class="form-group">
                            <label for="image_5">Image 5</label>
                            <input type="file" class="form-control" id="image_5" name="image_5">
                        </div>

                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection