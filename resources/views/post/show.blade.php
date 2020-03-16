@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    {{ $post }}
                </div>
            </div>
        </div>
    </div>
@endsection
