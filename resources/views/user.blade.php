@extends('layouts.app-3-col')

@section('content-left')
@include('partials.profile-card', ['user' => $user])
@endsection

@section('content-center')
<posts :user-id='@json($user->id)'></posts>
@endsection

@section('content-right')
@include('partials.suggestions')
@endsection
