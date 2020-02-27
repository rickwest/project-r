@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="card">
    @csrf
    <div class="card-body p-6">
        <div class="card-title text-center">{{ __('Reset Password') }}</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group">
            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
        </div>
    </div>
</form>
<div class="text-center text-muted">
    Forget it, <a href="{{ route('login') }}">send me back</a> to login.
</div>
@endsection
