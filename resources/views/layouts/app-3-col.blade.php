@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @yield('content-left')
    </div>
    <div class="col-md-6">
        @yield('content-center')
    </div>
    <div class="col-md-3">
        @yield('content-right')
    </div>
</div>
@endsection
