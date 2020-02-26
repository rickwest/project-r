@extends('layouts.auth')

@section('auth_content')
<form method="POST" action="{{ route('password.update') }}" class="card">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="card-body p-6">
        <div class="card-title text-center">{{ __('Reset Password') }}</div>
        <div class="form-group">
            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
        </div>
    </div>
</form>
<div class="text-center text-muted">
    Forget it, <a href="{{ route('login') }}">send me back</a> to login.
</div>
@endsection
