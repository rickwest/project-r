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
