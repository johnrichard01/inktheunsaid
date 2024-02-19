@extends('master')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/index.css')}}">
@endsection
@section('content')
@include('inc.navbar')
    @if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
    @endif
<div class="container-fluid">
    <div class="title-container">
        <div class="container mt-5">
            <h1 class="fw-bold title-hero text-center">Discover new stories and creative ideas</h1>
        </div>
    </div>
    <div class="first-section mt-5">
        <div class="container">
            <div class="d-flex flex-wrap">
                @if(!$latestBlog)
                    <p>No blogs found</p>
                @else
                    <div class="image-container col-12 col-lg d-flex justify-content-center">
                        <img class="img-fluid hero-image" src="{{ $latestBlog->thumbnail ? asset('storage/' . $latestBlog->thumbnail) : asset('assets/images/nothumbnail.png') }}" alt="">
                    </div>
                    <div class="container col-12 col-lg d-flex flex-wrap align-content-center justify-content-lg-start justify-content-center mx-0 mx-lg-5">
                        <div class="blog-title col-12">
                            <h1 class="fw-bold blog-title text-center text-lg-start mt-3 mt-lg-0">{{ $latestBlog->title }}</h1>
                        </div>
                        <div class="content-container col-12">
                            {{ $latestBlog->about }}
                        </div>
                        <div class="read-container col-12">
                            <a href="/blogs/{{ $latestBlog->id }}" class="btn btn-read text-decoration-none fw-bold" type="button">Read more</a>

                                <div>
                                    @auth
                                        @if(auth()->user()->bookmarks)
                                            @if(auth()->user()->bookmarks->contains('blog_id', $latestBlog->id))
                                                <form action="{{ route('bookmarks.unbookmark', $latestBlog) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="book--remove btn  py-0 px-4" type="submit">
                                                        <span class="material-symbols-outlined remove--bm">
                                                            bookmark
                                                        </span>
                        
                                                        <p class="mt-3">Remove</p>
                        
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('bookmarks.bookmark', $latestBlog) }}" method="POST">
                                                    @csrf
                                                    <button class="book--add btn p-0 px-3" type="submit">
                                                        <span class="material-symbols-outlined add--bm">
                                                            bookmark
                                                        </span>
                                                        <p class="mt-3">Bookmark</p>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endauth
                                </div>


                            
                        </div>
            
                        
                    </div>
                @endif
            </div>
        </div>            
    </div>
    <div class="second-section my-5 container-fluid bg-body-tertiary py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title fw-bold text-lg-start text-center">Categories</h2>
            </div>
            <div class="d-flex flex-wrap">
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="/category/?category=artwork" class="w-50 categ-btn btn btn-lg btn-artwork fw-bold">
                        Artwork
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="/category/?category=craft" class="w-50 categ-btn btn btn-lg btn-craft fw-bold">
                        Craft
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="/category/?category=literature" class="w-50 categ-btn btn btn-lg btn-literature fw-bold">
                        literature
                    </a>
                </div>
                <div class="d-flex justify-content-center col-12 col-md-6 col-lg mb-3 mb-md-4 mb-lg-0">
                    <a href="/category/?category=photography" class="w-50 categ-btn btn btn-lg btn-photography fw-bold">
                        Photography
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="third-section mt-5 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9">
                <div class="mb-5">
                    <h2 class="section-title fw-bold text-lg-start text-center">Recent Posts</h2>
                </div>
                <div class="container-fluid">
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
            </div>
            <div class="col-12 col-lg-3">
                <div class="popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4">
                    <div class="popular-conten mb-4">
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
@include('inc.footer')
@endsection
@section('javascript')
    <script src="{{asset('assets/js/universal.js')}}"></script>
@endsection