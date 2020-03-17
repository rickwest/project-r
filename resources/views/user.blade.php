@extends('layouts.app-3-col')

@section('content-left')
<div class="card card-profile">
    <div class="card-body text-center">
        <span class="avatar avatar-xxl mb-4" @if ($user->profile->avatar)style="background-image: url({{ $user->profile->avatar }})"@endif>@unless($user->profile->avatar){{ $user->profile->initials }}@endunless</span>
        <h3 class="mb-0">{{ $user->name }}</h3>
        @if ($user->profile->full_name)
            <p class="text-muted mb-4">{{ $user->profile->full_name }}</p>
        @endif
        @if ($user->profile->bio)
            <p class="mt-4">{{ $user->profile->bio }}</p>
        @endif
        @if ($user->id === Auth::user()->id)
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">Edit Profile</a>
        @endif
    </div>
</div>
@endsection

@section('content-center')
<posts-list user_id="{{ $user->id }}"></posts-list>
@endsection
