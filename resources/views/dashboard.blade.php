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
        @foreach([1, 2, 3, 4, 5] as $value)
        <div class="card">
            <a href="#"><img class="card-img-top" src="https://www.tegiwaimports.com/blog/wp-content/uploads/2020/02/EP3-OultonPark-TypeRTrophy-3-640x427.jpg" alt="And this isn't my nose. This is a false one."></a>
            <div class="card-body d-flex flex-column">
                <h4><a href="#">And this isn't my nose. This is a false one.</a></h4>
                <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice! …Are you suggesting that coconuts migr...</div>
                <div class="d-flex align-items-center pt-5 mt-auto">
                    <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
                    <div>
                        <a href="./profile.html" class="text-default">Rose Bradley</a>
                        <small class="d-block text-muted">3 days ago</small>
                    </div>
                    <div class="ml-auto text-muted">
                        <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-md-3">


    </div>
</div>
@endsection
