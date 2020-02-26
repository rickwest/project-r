@extends('layouts.auth')

@section('auth_nav')
<div class="nav-item d-none d-md-flex">
    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">{{ __('Register') }}</a>
</div>
@endsection

@section('auth_content')
<form method="POST" action="{{ route('login') }}" class="card">
    @csrf
    <div class="card-body p-6">
        <div class="card-title text-center">{{ __('Login') }}</div>

        <div class="form-group">
            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">
                {{ __('Password') }}
                @if (Route::has('password.request'))
                    <a class="float-right small" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="custom-control-label">{{ __('Remember Me') }}</span>
            </label>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
        </div>
    </div>
</form>
<div class="text-center text-muted">
    Don't have an account yet? <a href="{{ route('register') }}">{{ __('Register') }}</a>
</div>
@endsection
