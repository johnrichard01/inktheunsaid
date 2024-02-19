@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/contact.css')}}">
@endsection
@section('content')
@include('inc.navbar')
@if (session('success'))
<div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
    {{ session('success') }}
</div>
@endif
    <!-- MAIN  -->

    <div class="contact--container container-fluid">

        <h1 class="inTouch">GET IN TOUCH !</h1>
        
        <div class="contact--info row">
            
            <div class="col">

                <span class="material-symbols-outlined">
                    location_on  </span>
                <h4>Address</h4>

                <p class="address--info">
                    Brgy. New Valencia <br>
                    Tugbok District <br>
                    Davao City
                    Philippines
                </p>
                
            </div>

            <div class="col">

                <span class="material-symbols-outlined">
                    call
                    </span>
                <h4>Phone</h4>

                <p class="phone--info">
                    ExpressYourself Main Office <br>
                    +639565715585 <br>
                    244-7036
                </p>

            </div>

            <div class="col">

                <span class="material-symbols-outlined">
                    mail
                    </span>
                <h4>Email</h4>

                <p class="mail--info">
                    bandillamylene.dev@gmail.com
                </p>

            </div>


        </div>
    </div>

    <!--MESSAGE US-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-5 mt-lg-0 d-flex justify-content-center message-container">
                <div class="col-10 d-flex flex-wrap justify-content-center align-content-center">
                    <h1 class="message--us display-4 fw-bold">Message Us</h1>
                    <p class="message--feedback lead fs-6 mt-4 px-lg-3 px-0">
                        We're here and ready to assist you! Your feedback means a lot to us. Whether you have questions, suggestions, or just want to share your experiences, we're all ears. Your satisfaction is our priority, and your input helps us improve. Don't hesitate to reach out – we value your communication and are eager to hear from you!
                    </p>
                </div>
                
            </div>

            <div class="contact--form col-lg-6 col-md-6 col-sm-12 mx-auto">

                <div class="form--wrapper container-fluid  d-flex  justify-content-center">
                        <div class="col-8 p-5">

                                        <!-- Contact Form -->

                            <form action="/contact/send" method="POST" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="firstName">First Name:</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required autocomplete="name">
                                </div>
                                <div class="error-message" id="fname-error">

                                </div>
                                @error('firstName')
                                    <div class="error-message" id="message-error">{{$message}}</div>
                                 @enderror
                                <div class="form-group">
                                    <label for="lastName">Last Name:</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required autocomplete="lastname">
                                </div>
                                <div class="error-message" id="lname-error">
                                    
                                </div>
                                @error('lastName')
                                    <div class="error-message" id="message-error">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="email">Your Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
                                </div>
                                <div class="error-message" id="email-error">
                                    
                                </div>
                                @error('email')
                                <div class="error-message" id="message-error">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="message">Your Message:</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <div class="error-message" id="message-error"></div>
                                @error('message')
                                    <div class="error-message" id="message-error">{{$message}}</div>
                                @enderror
                                
                                <button type="submit" id="contactSubmit" class="btn--message btn">Send Message</button>
                            </form>


                        </div>
                </div>
            </div>
            
        </div>
    </div>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/contact.js')}}"></script>
@endsection