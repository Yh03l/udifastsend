@extends('layouts.app_guest')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <h1 class="mb-3 fw-normal fs-3" style="color: #A90F00">{{ __('Reset Password') }}</h1>

        <div class="form-floating mb-2">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="email">{{ __('E-Mail Address') }}</label>
        </div>

        <div class="form-floating mb-2">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="password">{{ __('Password') }}</label>
        </div>

        <div class="form-floating mb-2">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
        </div>

        <button type="submit" class="w-100 btn btn-lg btn-primary pt-2"
            style="background-color: #E73000; border-color: #E73000">
            {{ __('Reset Password') }}
        </button>

    </form>
@endsection
