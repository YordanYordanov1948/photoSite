@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h4>Welcome to the Admin Dashboard</h4>
                </div>
            </div>

            <div class="row">
                {{-- Recent Users --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Recent Users</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentUsers as $user)
                                <li class="list-group-item">
                                    {{ $user->name }} - Registered on {{ $user->created_at->format('M d, Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Recent Photos --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Recent Photos</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentPhotos as $photo)
                            <li class="list-group-item">
                                <img src="{{ asset('storage/photos/' . basename($photo->image_path)) }}" alt="Photo" class="img-fluid">
                                <p>Uploaded by {{ $photo->user->name }} on {{ $photo->created_at->format('M d, Y') }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
