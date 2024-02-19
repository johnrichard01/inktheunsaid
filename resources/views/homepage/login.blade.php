@extends('master')
@section('title', 'Signup')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('/assets/css/signup.css')}}">
@endsection
@section('content')
<a href="/" class="btn home-button btn-lg" id="homeButton">
    <i class="fas fa-home"></i> <!-- Font Awesome home icon -->
   </a>

   @if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
    @endif

   <!--LOGIN FORM-->
   <main class="container">

    <div class="container-fluid">
        <!-- Login Form -->
        <form action="/login/authenticate" method="POST" class="loginForm" id="login">
            @csrf
            <h1 class="form__title">Login</h1>

            @error('credentials')
                <div class="form__error--message text-center">{{$message}}</div>
            @enderror
            <div class="form__error--message text-center" id="errorMessageLogin"></div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" id="emailLogin">
            </div>

            <div class="form__error--message text-center" id="emailErrorLogin"></div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="material-symbols-outlined">
                        lock
                    </span>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" id="passwordLogin">
            </div>

            <div class="form__error--message text-center" id="passwordErrorLogin"></div>

            <button class="form__button" type="submit" id="loginButton">Login</button>

            <p class="form__text">
                <a href="/forgot-password" class="form__link" id="linkForgotPassword">Forgot your password?</a>
            </p>

            <p class="form__text mt-0">
                <a href="/signup" class="form__link" id="linkCreateAccount">Don't have an account? Sign Up</a>
            </p>
        </form>
    </div>
</main>

@section('javascript')
    <script src="{{asset('assets/js/login.js')}}"></script>
@endsection
@endsection