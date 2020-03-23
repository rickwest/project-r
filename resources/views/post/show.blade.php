@extends('layouts.app-3-col')

@section('content-center')
<post :post='@json($post)' :auth-user-id='@json($authUser->id)' :full-body="true"></post>
<post-comments :post-id='@json($post->id)' :auth-user-id='@json($authUser->id)'></post-comments>
@endsection
