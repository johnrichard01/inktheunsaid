@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/universal.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/userdash.css') }}">
    <style>
   
    </style>
@endsection
@section('content')
@include('inc.navbar')

<header>
    <div class="activities">
        <h1>Activities</h1>
    </div>
</header>

<section class="activities-container">
    @foreach($userActivities as $activity)
        <div class="activity-card {{ $activity->read ? 'read' : 'unread' }}">
            <h2>{{ $activity->title }}</h2>
            <p>{{ $activity->description }}</p>
            <a href="#" class="btn">View Details</a>
            <div>
                <a href="#" class="delete-btn">Delete</a>
                <a href="#" class="leave-btn">Leave as is</a>
            </div>
        </div>
    @endforeach
</section>

