@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <a href="{{ route('photos.show', ['id' => $photo->id]) }}">
                            <img src="{{ asset($photo->image_path) }}" alt="Photo" class="card-img-top">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->title }}</h5>
                            <p class="card-text">{{ $photo->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
