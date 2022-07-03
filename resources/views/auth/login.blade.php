@extends('layouts.app')

@section('content')
<section class="vh-100">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-start">
                        <img src="assets/img/Rodicord.png" alt="RODICORD" style="margin-top: -40px; margin-left: -25px;">
                        <h3><strong>Login</strong></h3>
                        {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                        <p class="mb-3" style="font-size: 14px"><strong>Harap masukkan Username dan Password Anda</strong></p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-outline mb-2">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-2">
                                <label for="password" class="form-label" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <input class="me-2 ms-2 mx-2 mt-3" type="checkbox" onclick="showPassword()">Show Password
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="btn">
                                <button type="submit" class="btn btn-success btn-lg mt-3" style="border-radius: 25px; width:350px;">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer')
    </div>
</section>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
