@extends('layouts.base')

@section('body')
<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="/">
                <img src="{{ asset('images/logo.svg') }}" class="header-brand-img" alt="{{ config('app.name', 'Laravel') }} logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">{{ __('Login') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1 class="display-2">The #1 site for car enthusiasts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm col-login mx-auto mr-sm-0 ml-sm-auto d-flex align-items-center">
                <img src="{{ asset('images/car.svg') }}" class="img-fluid">
            </div>
            <div class="col-sm col-login mx-auto ml-sm-0 mr-sm-auto mt-6">
                <div class="card">
                    <div class="card-body p-6">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-block my-5">{{ __('Register') }}</a>
                        <div class="text-center text-muted">
                            Already a member? <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </div>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block my-5">Continue as {{ Auth::user()->name }}</a>
                        <div class="text-center text-muted">
                            Not {{ Auth::user()->name }}? <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Switch Accounts</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
@endsection
