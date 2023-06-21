@extends('layouts.app_guest')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1 class="mb-3 fw-normal" style="color: #A90F00">{{ __('Reset Password') }}</h1>
        <div class="form-floating mb-2">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="email">{{ __('E-Mail Address') }}</label>
        </div>

        <button type="submit" class="w-100 btn btn-lg btn-primary pt-2"
            style="background-color: #E73000; border-color: #E73000">
            {{ __('Send Password Reset Link') }}
        </button>

    </form>
@endsection
