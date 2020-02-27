@extends('layouts.auth')

@section('nav')
    <div class="nav-item d-none d-md-flex">
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">{{ __('Login') }}</a>
    </div>
@endsection

@section('content')
<form method="POST" action="{{ route('register') }}" class="card">
    @csrf
    <div class="card-body p-6">
        <div class="card-title text-center">{{ __('Register') }}</div>
        <div class="form-group">
            <label class="form-label" for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
        </div>
    </div>
</form>

<div class="text-center text-muted">
    Already have an account? <a href="{{ route('login') }}">{{ __('Login') }}</a>
</div>
@endsection
