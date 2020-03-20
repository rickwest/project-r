@extends('layouts.app-3-col')

@section('content-left')
@include('partials.profile-card', ['user' => $authUser])
@endsection

@section('content-center')
<posts></posts>
@endsection
