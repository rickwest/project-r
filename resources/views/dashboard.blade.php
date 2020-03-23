@extends('layouts.app-3-col')

@section('content-left')
<div class="d-none d-lg-block">
    @include('partials.profile-card', ['user' => $authUser])
</div>
@endsection

@section('content-center')
<posts :auth-user-id='@json($authUser->id)'></posts>
@endsection

@section('content-right')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Suggestions For You</h3>
    </div>
    <ul class="list-group card-list-group">
        @foreach($suggestions as $suggestion)
        <a href="{{ route('user', ['user' => $suggestion]) }}" class="list-group-item list-group-item-action">
            <div class="media">
                @if($suggestion->profile->avatar)
                <span class="avatar avatar-md mr-4" style="background-image: url({{$suggestion->profile->avatar}})"></span>
                @elseif($suggestion->profile->initials)
                <span class="avatar avatar-md mr-4">{{ $suggestion->profile->initials }}</span>
                @endif
                <div class="media-body">
                    <h5 class="m-0">{{ $suggestion->name }}</h5>
                    <p class="text-muted mb-0">{{ $suggestion->profile->full_name }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </ul>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Trending Posts</h3>
    </div>
    <ul class="list-group card-list-group">
        @foreach($trending as $post)
            <a href="{{ route('post.show', ['post' => $post]) }}" class="list-group-item list-group-item-action">
                <div class="media">
                    <div class="media-body">
                        <h5 class="m-0">{{ ucfirst($post->title)}}</h5>
                        @if(count($post->likes) > 0 )
                            @if (count($post->likes) === 1)
                            <p class="text-muted mb-0">Liked by {{ $post->likes[0]->user->name }}</p>
                            @elseif(count($post->likes) === 2)
                            <p class="text-muted mb-0">Liked by {{ $post->likes[0]->user->name }} and 1 other</p>
                            @else
                            <p class="text-muted mb-0">Liked by {{ $post->likes[0]->user->name }} and {{ $post->likes->count() - 1 }} others.</p>
                            @endif
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </ul>
</div>
@endsection
