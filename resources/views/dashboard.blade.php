@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
{{--        <div class="card card-profile">--}}
{{--            <div class="card-header" style="background-image: url(demo/photos/eberhard-grossgasteiger-311213-500.jpg);"></div>--}}
{{--            <div class="card-body text-center">--}}
{{--                <img class="card-profile-img" src="demo/faces/male/16.jpg">--}}
{{--                <h3 class="mb-3">Peter Richards</h3>--}}
{{--                <p class="mb-4">--}}
{{--                    Big belly rude boy, million dollar hustler. Unemployed.--}}
{{--                </p>--}}
{{--                <button class="btn btn-outline-primary btn-sm">--}}
{{--                    <span class="fa fa-twitter"></span> Follow--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="col-md-6">
        <posts-list></posts-list>
    </div>
    <div class="col-md-3">


    </div>
</div>
@endsection
