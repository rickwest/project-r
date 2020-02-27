@extends('layouts.base')

@section('body')
<div class="flex-fill">
    @include('partials.header')
    <div class="my-3 my-md-5">
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>
@include('partials.footer')
@endsection
