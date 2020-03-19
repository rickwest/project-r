@extends('layouts.app-3-col')

@section('content-center')
<div class="card">
    @if (count($post->images) === 1)
    <img href="{{ $post->url }}" class="card-img-top" src="{{ $post->images[0] }}" alt="{{ $post->title }}">
    @elseif(count($post->images) > 1)
    <div id="post-carousel-{{ $post->id }}" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <ol class="carousel-indicators">
            @foreach($post->images as $image)
                <li data-target="#post-carousel-{{ $post->id }}" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
            </ol>
        @foreach($post->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100 card-img-top" alt="" src="{{ $image }}" data-holder-rendered="true">
            </div>
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#post-carousel-{{ $post->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#post-carousel-{{ $post->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    @endif
    <div class="card-body d-flex flex-column">
        <h4><a href="{{ $post->url }}">{{ $post->title }}</a></h4>
        <div class="text-muted">{{ $post->body }}</div>
        <div class="d-flex align-items-center pt-5 mt-auto">
            <div class="avatar avatar-md mr-3" style="background-image: url({{ $post->user->profile->avatar }})"></div>
            <div>
                <a href="{{ route('user', ['user' => $post->user]) }}" class="text-default">{{ $post->user->name }}</a>
                <small class="d-block text-muted">{{ $post->from_now }}</small>
            </div>
            <div class="ml-auto text-muted">
                <post-like v-bind:post="{{ $post }}"></post-like>
            </div>
        </div>
    </div>
</div>
@endsection
