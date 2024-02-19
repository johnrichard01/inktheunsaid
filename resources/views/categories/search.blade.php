@extends('master')
@section('title', 'Search')
@section('css')
<link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/category.css')}}">
@endsection
@section('content')
@include('inc.navbar')
<div class="container-fluid p-0">
    <div class="container-fluid categ-container px-0 py-5">
        <div class="container">
            <h1 class="search-title fw-bold text-start">Search result for: '{{$search}}'</h1>
        </div>
    </div>
    <div class="third-section mt-3 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9">
                <div class="mb-5">
                    <h2 class="section-title fw-bold text-lg-start text-center">Recent Posts</h2>
                </div>
                @if (count($blogs)== 0)
                        <p>No blogs found</p>
                    @else
                        @foreach ($blogs as $blog)
                            <x-recent-card :blog='$blog'/>
                        @endforeach
                    @endif
                   <div class="d-flex justify-content-start">
                    {!!$blogs->links()!!}
                    </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="container-fluid pb-5 pt-3 mb-3">
                    <div class="mb-4">
                        <h2 class="section-title fw-bold text-lg-start text-center">Categories</h2>
                    </div>
                    <div class="second-section">
                        <div class="container">
                            <div class="d-flex flex-wrap">
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=artwork" class="w-100 categ-btn btn btn-lg btn-artwork fw-bold">
                                        Artwork
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=craft" class="w-100 categ-btn btn btn-lg btn-craft fw-bold">
                                        Craft
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3">
                                    <a href="/category/?category=literature" class="w-100 categ-btn btn btn-lg btn-literature fw-bold">
                                        literature
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center col-12 mb-3 ">
                                    <a href="/category/?category=photography" class="w-100 categ-btn btn btn-lg btn-photography fw-bold">
                                        Photography
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4">
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                    <div class="popular-content mb-4">
                        <div class="popular-categ mb-2">
                            <div class="popular-box col-3 d-flex align-items-center justify-content-center">
                                Artwork
                            </div>
                        </div>
                        <div class="popular-title">
                            <a href="#" class="text-decoration-none">
                                <h6 class="popular-title">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</h6>
                            </a>
                        </div>
                        <div class="author-container d-flex">
                            <div class="name-container lead fw-bold">
                                John Doe
                            </div>
                            <div class="author-time lead">
                                -2024-01-13
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- next topic -->
            </div>
        </div>
    </div>
</div>
@include("inc.footer")
@endsection
@section('javascript')
@endsection