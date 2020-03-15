@extends('layouts.app-3-col')

@section('content-left')
<h3 class="page-title mb-5">My Profile</h3>
<div class="list-group list-group-transparent mb-5">
    <a href="{{ route('profile.update') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <span class="icon mr-3"><i class="fe fe-user"></i></span>My Profile
    </a>
</div>
@endsection

@section('content-center')
<form class="card" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group">
            <label class="form-label" for="avatar">Current Photo</label>
            <span class="avatar avatar-xxl mb-5" @if($profile->avatar)style="background-image: url({{ $profile->avatar }})"@endif>@unless($profile->avatar){{ $profile->initials }}@endunless</span>
            <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" />
            @error('avatar')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="first_name">First Name</label>
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $profile->first_name }}" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="last_name">Last Name</label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $profile->last_name }}">
            @error('last_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="location">Location</label>
            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $profile->location }}">
            @error('location')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="occupation">Occupation</label>
            <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{ $profile->occupation }}">
            @error('occupation')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="o">Bio</label>
            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio">{{ $profile->bio }}</textarea>
            @error('bio')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>e
            @enderror
        </div>
        <div class="mt-4 text-right">
            <button type="submit" class="btn btn-primary">Save Profile</button>
        </div>
    </div>
</form>
@endsection
