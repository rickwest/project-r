@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col col-md-8 offset-md-2">
        <post-create v-bind:user="{{ Auth::user() }}" csrf-token="{{ csrf_token() }}"></post-create>
    </div>
</div>
@endsection
