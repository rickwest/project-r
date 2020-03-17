@extends('layouts.app-3-col')

@section('content-center')
<div class="card">
    @if (count($post->images) === 1)
        <img class="card-img-top" src="{{ $post->images[0] }}" alt="{{ $post->title }}">
    @elseif (count($post->images) > 1)
        <div id="carousel-controls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($post->images as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img class="d-block w-100 card-img-top" alt="" src="{{ $image }}" data-holder-rendered="true">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carousel-controls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-controls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    @endif
    <div class="card-body">
        <h4>{{ $post->title }}</h4>
        <div class="text-muted">{{ $post->body }}</div>
        <div class="d-flex align-items-center pt-5 mt-auto">
            <div class="avatar avatar-md mr-3" @if($post->user->profile->avatar)style="background-image: url({{ $post->user->profile->avatar }})"@endif>@unless($post->user->profile->avatar){{ $post->user->profile->initials }}@endunless</div>
            <div>
                <a href="{{ route('user', ['user' => $post->user]) }}" class="text-default">{{ $post->user->name }}</a>
                <small class="d-block text-muted">{{ $post->fromNow }}</small>
            </div>
            <div class="ml-auto text-muted">
                <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
