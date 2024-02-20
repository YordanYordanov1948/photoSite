@extends('layouts.app')

@section('title', 'Welcome to Photos Website')

@section('content')
    <div class="container mt-4">
        <h1>Welcome to Photos Website</h1>

        <div class="row">
            @foreach($photos as $photo)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="{{ route('photos.show', ['id' => $photo->id]) }}">
                            <img src="{{ asset('storage/photos/' . basename($photo->image_path)) }}" alt="Photo" class="img-fluid">

                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
