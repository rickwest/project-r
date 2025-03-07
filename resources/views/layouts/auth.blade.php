@extends('layouts.base')

@section('body')
<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="/">
                <img src="{{ asset('images/logo.svg') }}" class="header-brand-img" alt="{{ config('app.name', 'Laravel') }} logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                @yield('nav')
            </div>
        </div>
    </div>
</div>
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col col-login mx-auto">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
@endsection
