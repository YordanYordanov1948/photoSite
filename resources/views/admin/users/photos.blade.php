@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s Photos</h1>
    <div class="row">
        @foreach($photos as $photo)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/photos/' . basename($photo->image_path)) }}" alt="Photo" class="card-img-top">

                    <div class="card-body">
                        <h5 class="card-title">{{ $photo->title }}</h5>
                        <p>Uploaded on: {{ $photo->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $photos->links() }}
</div>
@endsection
