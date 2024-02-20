@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Photos List</h2>
    <div class="mb-3 text-end">
        <a href="{{ route('admin.photos.create') }}" class="btn btn-success">Upload New Photo</a>
    </div>
    <div class="row g-4">
        @foreach($photos as $photo)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($photo->image_path) }}" class="card-img-top" alt="{{ $photo->title }}" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $photo->title }}</h5>
                        <p class="text-muted">Uploaded by: {{ $photo->user->name }}</p>
                        <p class="text-muted">Upload date: {{ $photo->created_at->format('M d, Y') }}</p>
                        <a href="{{ route('admin.photos.comments', $photo->id) }}" class="btn btn-primary btn-sm">View Comments</a>
                        <button type="button" class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $photo->id }}">
                            Delete
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $photo->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this photo?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $photos->links() }}
    </div>
</div>
@endsection
