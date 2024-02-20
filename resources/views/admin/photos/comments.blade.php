@extends('admin.layout.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4">Comments for Photo: <strong>{{ $photo->title }}</strong></h3>
            @if($photo->comments->isEmpty())
                <div class="alert alert-info" role="alert">
                    There are no comments for this photo yet.
                </div>
            @else
                <div class="list-group">
                    @foreach($photo->comments as $comment)
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $comment->user->name }}</h5>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ $comment->body }}</p>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
