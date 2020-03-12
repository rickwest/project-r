@extends('layouts.base')

@section('body')
<div class="flex-fill">
    @include('partials.header')
    <div class="my-3 my-md-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
@include('partials.footer')
@endsection
