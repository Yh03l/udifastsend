@extends('layouts.app_guest')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-success"> {{ Session::get('message') }} </div>
    @endif

    @if (Session::has('messageError'))
        <div class="alert alert-warning"> {{ Session::get('messageError') }} </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <img class="mb-4 img-fluid" src="{{ asset('img/logo.png') }}" alt="">
        </div>
        <h1 class="mb-3 fw-normal">BIENVENIDO(A)</h1>
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

        <div class="form-floating mb-2">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="password">{{ __('Password') }}</label>
        </div>

        <div class="row">
            <div class="col">
                {{-- <input type="checkbox" onclick="mostrarClave()"><small> Mostrar contraseña</small><br><br> --}}
            </div>
            <div class="col-12">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><small>
                    {{ __('Remember Me') }}</small><br><br>
            </div>
        </div>

        <button type="submit" class="w-100 btn btn-lg btn-primary pt-2"
            style="background-color: #2300e7; border-color: #0049e7">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}"
                style="text-decoration-line: none; color: #71c1f7;">
                <small>{{ __('Forgot Your Password?') }}</small>
            </a>
        @endif
    </form>
@endsection

@section('scripts')
    <script>
        function mostrarClave() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
