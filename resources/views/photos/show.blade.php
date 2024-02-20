@extends('layouts.app')

@section('title', $photo->title)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $photo->title }}</h5>

                        @if (auth()->check() && auth()->user()->id == $photo->user_id)
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Photo</button>
                            </form>
                         @endif
                    </div>
                </div>

                @if (auth()->check())
                    <div class="card mt-4">
                        <div class="card-body">
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                            </form>
                        </div>
                    </div>
                @endif

                @foreach ($photo->comments as $comment)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $comment->user ? $comment->user->name : 'Unknown User' }}
                            </h5>
                            <p class="card-text">{{ $comment->body }}</p>
                            <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

