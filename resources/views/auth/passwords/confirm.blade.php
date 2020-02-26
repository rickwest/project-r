@extends('layouts.base')

@section('auth_content')
<form method="POST" action="{{ route('password.confirm') }}" class="card">
    @csrf
    <div class="card-body p-6">
        <div class="card-title text-center">{{ __('Confirm Password') }}</div>
        {{ __('Please confirm your password before continuing.') }}

        <div class="form-group">
            <label class="form-label" for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
</form>
@endsection
