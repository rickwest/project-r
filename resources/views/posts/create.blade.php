@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <new-post csrf-token="{{  csrf_token() }}"></new-post>
            </div>
        </div>
    </div>
</div>
@endsection
