@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col col-md-8 offset-md-2">
        <posts-create v-bind:user="{{ Auth::user() }}" csrf-token="{{ csrf_token() }}"></posts-create>
    </div>
</div>
@endsection
