<!-- resources/views/profile.blade.php -->

@extends('master')
@section('title', $user->username . "'s Profile")
@section('css')
    <!-- Add any additional CSS files if needed -->
@endsection

@section('content')
    @include('inc.navbar')

    <main>
        <div class="container mt-5">
            <div class="profile-header">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar" class="avatar-img">
                <h1>{{ $user->username }}</h1>
            </div>

            <div class="profile-posts">
                <h2>Posts</h2>
                @foreach($user->posts as $post)
                    <div class="post">
                        <p>{{ $post->content }}</p>
                        <!-- Add any other post details you want to display -->
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('inc.footer')
@endsection

@section('javascript')
    <!-- Bootstrap JS, Popper.js, and Cropper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
