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


   <!--LOGIN FORM-->


<main class="container">

    <div class="container-fluid">

        <!-- SIGN UP FORM-->
        <form action="/users" method="POST" class="signupForm" id="signup" >
            @csrf
            <h1 class="form__title">Sign Up</h1>
            
            <div class="input-group mb-3">
                <span class="input-group-text " id="basic-addon1">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            @error('username')
            <div class="form__error--message text-center">{{$message}}</div>
            @enderror
            <div class="form__error--message text-center" id="usernameError"></div>

            <div class="input-group mb-3">
                <span class="input-group-text " id="basic-addon1">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                </span>
                <input type="email"  id="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                
            </div>
            @error('email')
                <div class="form__error--message text-center">{{$message}}</div>
            @enderror
            <div class="form__error--message text-center" id="emailError"></div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="material-symbols-outlined">
                        passkey
                    </span>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
            </div>

            <div class="form__error--message text-center" id="passwordError"></div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="material-symbols-outlined">
                        passkey
                    </span>
                </span>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon1">
            </div>
            <div class="form__error--message text-center" id="cpasswordError"></div>
            <button class="form__button" type="submit" id="signupButton">Sign Up</button>

            <p class="form__text mt-0">
                <a href="/login" class="form__link" id="linkLogin">Already have an account? Login</a>
            </p>
        </form>

    </div>
</main>
@section('javascript')
    <script src="{{asset('assets/js/signup.js')}}"></script>
@endsection
@endsection