<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.svg') }}" class="header-brand-img" alt="{{ config('app.name') }} logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
Q                <div class="nav-item">
                    <a href="{{ route('post.create') }}" class="btn btn-sm btn-outline-primary"><i class="fe fe-plus-circle"></i><span class="d-none d-md-inline-flex">&nbsp;Create a post</span></a>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar" @if(Auth::user()->profile->avatar)style="background-image: url({{ Auth::user()->profile->avatar }})"@endif>@unless(Auth::user()->profile->avatar){{ Auth::user()->profile->initials }}@endunless</span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{ Auth::user()->name }}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="dropdown-icon fe fe-log-out"></i> {{__('logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Dashboard</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{ route('dashboard') }}" class="dropdown-item ">Activity Feed</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
