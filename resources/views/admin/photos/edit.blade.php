@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Edit Photo</h2>
    <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="file" class="form-control" id="image" name="image">
            <small>Leave blank to keep current photo.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update Photo</button>
    </form>
</div>
@endsection
