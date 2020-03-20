@extends('layouts.app-3-col')

@section('content-left')
@include('partials.profile-card', ['user' => $user])
@endsection

@section('content-center')
<posts user_id="{{ $user->id }}"></posts>
@endsection
