@extends('master')
@section('title', 'About Us')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/aboutus.css')}}">
@endsection
@section('content')
@include('inc.navbar')
<main class="container">


    <div class="welcome--container container-fluid">
        
        <div class="row">

            <h1 class="welcome">Welcome to InkTheUnsaid - Creative Minds !</h1>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-5 text-center">

                <div class="welcome--img px-4 my-md-5 xs-my-5 my-sm-5">

                    <img src="{{asset('assets/images/AboutUs/wp7110622.jpg')}}" class="writer--img img-fluid" alt="welcomeimg">

                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-4 text-center">

                <div class="welcome--txt px-4 my-md-5">
                    
                    <p>
                        At <b>InkTheUnsaid</b>, we believe in the power of expression. In a world inundated with noise, we provide a haven for authentic voices to be heard, stories to be shared, and creativity to flourish. Our mission is to empower individuals to express themselves freely, fostering a diverse and vibrant community where every voice matters.
                    </p>

                </div>

            </div>

        </div>
    </div>

    <div class="whatSetUsApart-container  container-fluid px-5">


        <div class="row my-5">
    
            <h1 class="SetsUsApart slide-in">What Sets Us Apart:</h1>
    
            <!--ITEM 1-->
            <div class="col col-lg-6 col-md-6 col-sm-12 col mb-4 xs-px-5">
                <div class="card mx-lg-5 my-md-4 mx-sm-4 xs-mx-5 mt-5" style="height: 100%;">
                   
                        <img src="{{asset('assets/images/AboutUs/abstract-7.jpg')}}" alt="abstract-7" class="img-fluid">

                        <h4 class="card-title mt-3">Freedom of Expression</h4>
                        <p class="card-text">We value diversity and individuality. <b>InkTheUnsaid</b> is a space where you can be unapologetically yourself, sharing your thoughts, experiences, and creativity without constraints.</p>

                </div>
            </div>
    
            <!--ITEM 2-->
            <div class="col col-lg-6 col-md-6 col-sm-12 col mb-4 xs-px-5">
                <div class="card mx-lg-5 my-md-4 mx-sm-3 xs-mx-5 mt-5" style="height: 100%;">

                        <img src="{{asset('assets/images/AboutUs/couple-browsing-digital-device-concept.jpg')}}" alt="app" class="img-fluid">

                        <h4 class="card-title mt-3">User-Centric Design</h4>
                        <p class="card-text">Our app is crafted with you in mind. An intuitive interface, personalized features, and a seamless user experience make expressing yourself a joy.</p>

                </div>
            </div>
    
    
        </div>
    </div>
    


    <div class="container-fluid px-5">

        <div class="row my-5">

            <h1 class="team slide-in">The Team</h1>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-4 text-center">
                <div class="px-4 my-md-5 xs-my-5 my-sm-5">

                    <p>
                        Behind <b>InkTheUnsaid</b> is a passionate team dedicated to fostering a culture of expression. We are writers, designers, developers, and dreamers who believe in the transformative power of words and creativity.
                    </p>
                    
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-4 text-center">
                <div class="px-4 my-md-5">
                    
                    <img src="{{asset('assets/images/AboutUs/The Team.jpg')}}" class="img-fluid" alt="welcomeimg">
                    
                </div>
            </div>

        </div>
    </div>




    <div class="container-fluid px-5">

        <div class="row my-5">

            <h1 class="founder slide-in">Founder's Note</h1>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-4 text-center">
                <div class="px-4 my-md-5 xs-my-5 my-sm-5">

                    <img src="{{asset('assets/images/AboutUs/brian-chesky-1.png')}}" class="img-fluid" alt="welcomeimg">
                    
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center my-4 text-center">
                <div class="px-4 my-md-5">
                    
                    <p>
                        "Nathan Smith, the visionary behind <b>InkTheUnsaid</b>, embarked on this journey with a simple belief – that everyone has a story worth sharing. This inspired the creation of <i><b>InkTheUnsaid</b></i>: a digital haven for authentic expression, fostering empathy globally."
                    </p>
                    
                </div>
            </div>

        </div>
    </div>


    <div class="container-fluid px-5">

        <div class="row my-5">

            <h1 class="join slide-in">Join Us, Share Your Story:</h1>

            <div class="col d-flex flex-column justify-content-center align-items-center my-4 text-center">
                <div class="px-4 my-md-5">
                    
                    <p>
                        Calling all writers and storytellers! <b>InkTheUnsaid</b> is your creative hub.
                        <br>
                        Connect, explore, and grow with a community that values your voice.
                        <br>
                        
                    </p>

                    <p>
                        <a href="/signup">SignUp</a> today and start sharing !
                        <br>
                        Already have an account? <a href="/login">Login</a>.

                    </p>
                    
                </div>
            </div>

        </div>
    </div>
</main>
@include('inc.footer')
@endsection
@section('javascript')
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/aboutUsAnimate.js')}}"></script>
@endsection