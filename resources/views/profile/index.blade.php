@extends('layouts.app')

@section('content')

<!-- Check if user is logged in -->
@if (Auth::check())
    <!-- User Menu -->
    <div class="btn-group" role="group" aria-label="Basic example">
        <a class="btn btn-primary me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
            Upload Photo
        </a>
        <a class="btn btn-primary me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#profileEditModal">
            Edit Profile
        </a>
        <a class="btn btn-primary" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endif
<x-photo-upload-modal/>
<x-profile-edit-modal/>

@endsection
