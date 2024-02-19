@extends('master')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('tite', $blog->title)
@section('css')
<link rel="stylesheet" href="{{asset('/assets/css/universal.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/view.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
@include('inc.navbar')
@if (session('success'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" class="alert alert-success flash-messages">
        {{ session('success') }}
    </div>
@endif
{{-- modal for reporting blogs --}}
<div class="modal fade modal-report-content" id="modalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/blogs/{blog}/report" method="POST">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-4 w-100 fw-bold text-center report-text" id="exampleModalLabel">Report Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body modal-scrollable">
                    <div class="mx-5">
                        <input type="hidden" name="blog_id" id="blog_id">
                    <h2 class="fw-bold report-text">What type of issue are you reporting ?</h2>
                    <div class="error-print" id="reportError">

                    </div>
                    <div class="report-group">
                        <label for="hate">
                            <p class="h5 report-text">Hate Speech</p>
                            <p class="lead fs-6 pe-5 report-text">Slurs, Racist or sexist stereotypes, Dehumanization, Incitement of fear or discrimination, Hateful references, Hateful symbols & logos</p>
                        </label>
                        <input type="radio" id="hate" name="report_reason" value="Hate Speech"><br>
                    </div>
                    <div class="report-group">
                        <label for="abuse_harassment">
                            <p class="h5 report-text">Abuse & Harassment</p>
                            <p class="lead fs-6 pe-5 report-text">Insults, Unwanted Sexual Content & Graphic Objectification, Unwanted NSFW & Graphic Content, Violent Event Denial, Targeted Harassment and Inciting Harassment</p>
                        </label>
                        <input type="radio" id="abuse_harassment" name="report_reason" value="Abuse & Harassment"><br>
                    </div>
                    <div class="report-group">
                        <label for="privacy">
                            <p class="h6 report-text">Privacy</p>
                            <p class="lead fs-6 pe-5 report-text">Sharing private information, threatening to share/expose private information, sharing non-consensual intimate images, sharing images of me that I don’t want on the platform</p>
                        </label>
                        <input type="radio" id="privacy" name="report_reason" value="Privacy"><br>
                    </div>
                    <div class="report-group">
                        <label for="violent_speech">
                            <p class="h5 report-text">Violent Speech</p>
                            <p class="lead fs-6 pe-5 report-text">Violent Threats, Wish of Harm, Glorification of Violence, Incitement of Violence, Coded Incitement of Violence</p>
                        </label>
                        <input type="radio" id="violent_speech" name="report_reason" value="Violent Speech"><br>
                    </div>
                    <div class="report-group">
                        <label for="spam">
                            <p class="h5 report-text">Spam</p>
                            <p class="lead fs-6 pe-5 report-text">Fake accounts, financial scams, posting malicious links, misusing hashtags, fake engagement, repetitive replies, Reposts, or Direct Messages</p>
                        </label>
                        <input type="radio" id="spam" name="report_reason" value="Spam"><br>
                    </div>
                    <div class="report-group">
                        <label for="suicide_self_harm">
                            <p class="h5">Suicide or Self-Harm</p>
                            <p class="fs-6 pe-5 lead">Encouraging, promoting, providing instructions or sharing strategies for self-harm.</p>
                        </label>
                        <input type="radio" id="suicide_self_harm" name="report_reason" value="Suicide or Self-Harm"><br>
                    </div>
                    <div class="report-group">
                        <label for="sensitive_media">
                            <p class="h5 report-text">Sensitive or Disturbing Media</p>
                            <p class="fs-6 pe-5 lead report-text">Graphic Content, Gratutitous Gore, Adult Nudity & Sexual Behavior, Violent Sexual Conduct, Bestiality & Necrophilia, Media depicting a deceased individual</p>
                        </label>
                        <input type="radio" id="sensitive_media" name="report_reason" value="Sensitive or Disturbing Media"><br>
                    </div>
                    <div class="report-group">
                        <label for="violent_hateful_entities">
                            <p class="h5 report-text">Violent and Hateful Entities</p>
                            <p class="pe-5 fs-6 lead report-text">Violent extremism and terrorism, hate groups & networks</p>
                        </label>
                        <input type="radio" id="violent_hateful_entities" name="report_reason" value="Violent and Hateful Entities"><br>
                    </div>                 
                    </div>   
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-danger w-50" id="reportSubmit">Submit</button>
              </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end modal --}}
<div class="container-fluid p-0">
    <div class="container-fluid categ-container px-0 py-5">
        
        <div class="container categ-title-container">
            <h1 class="categ-title fw-bold text-start">{{$blog->title}}</h1>
            <p class="author-view">by: {{$author->username}}</p>
            <div class="dropdown option-btn">
                <a type="button" class="btn option-btn" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                      </svg>
                </a>
                <ul class="dropdown-menu"> 
                    <li>
                        <a href="#" class="dropdown-item">Edit</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item">Edit</a>
                    </li>
                    <li>
                        <button class="btn dropdown-item report-btn text-center" id="ReportBTN" value="{{$blog->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="currentColor" class="bi bi-flag" viewBox="0 0 16 16">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                            </svg>
                            Report
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="third-section mt-3 pb-5">
        <div class="container d-flex flex-lg-row flex-column">
            <div class="col-12 col-lg-9 px-5">
                <div class="content">
                    <div class="show-image d-flex justify-content-center">
                        <img src="{{$blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('assets/images/nothumbnail.png')}}" alt="">
                    </div> 
                </div>

                <div class="desc-container mt-5">
                    <div class="description">
                            {!!$blog->description!!}

                            @if(auth()->check() && auth()->user()->bookmarks)
                                @if(auth()->user()->bookmarks->contains('blog_id', $blog->id))
                                    <form action="{{ route('bookmarks.unbookmark', $blog) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="book--remove btn" type="submit">
                                            <span class="material-symbols-outlined remove--bm">
                                                bookmark                                               
                                            </span>

                                            <p class="mt-3">Remove</p>
                                            
                                        </button>
                                    </form>
                                @else
                                <form action="{{ route('bookmarks.bookmark', $blog) }}" method="POST">
                                        @csrf
                                        <button class="book--add btn py-0 px-3" type="submit">
                                            <span class="material-symbols-outlined add--bm">
                                                bookmark
                                            </span>
                                            <p class="mt-3">Bookmark</p>
                                        </button>
                                    </form>
                                @endif
                            @endif
                    </div>

                    <div class="comments--container">

                        <!-- COMMENTS -->
                        <div class="comments">
                            <ul id="comments-container">
                                @foreach ($comments as $comment)
                                    <li class="comment---lists">

                                        <!-- Display the comment text, AVATAR, USERNAME -->

                                        <div class="comment-body">
                                            <img src="{{$comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('assets/images/noprofile.png')}}" alt="Profile Picture"
                                                class="profile__myAvatar img-fluid rounded-circle">
                                            <span class="username"><b>{{ $comment->user->username }}</b></span>
                                            {{ $comment->comment_text }}
                                        </div>

                                        <button class="like-button" data-comment-id="{{ $comment->id }}" data-reply-id="">
                                            <span class="material-symbols-outlined">
                                                thumb_up
                                            </span>
                                        </button>
                                        
                                        <span class="like-count" id="like-count-{{ $comment->id }}-"> {{ $comment->likes_count }} </span>
                                        



                                        

                                            <!-- Reply Link for each comment -->
                                            <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}" data-parent-reply-id="0">
                                                <span class="material-symbols-outlined">
                                                    add_comment
                                                </span>
                                            </a>

                                            <!-- Replies link for each comment -->
                                            @if ($comment->replies->count() > 0)
                                                <a href="#" class="replies" data-comment-id="{{ $comment->id }}">
                                                    <span class="material-symbols-outlined">
                                                        forum
                                                    </span>
                                                </a>
                                                <!-- Display replies for this comment -->
                                                <ul class="replies-list" id="replies-list-{{ $comment->id }}" style="display: none;">
                                                    @foreach ($comment->replies as $reply)
                                                        <li class="reply">
                                                            <!-- Display the reply text -->
                                                            <div class="comment-body">
                                                                <img src="{{ optional($reply->user)->avatar ? asset('storage/' . $reply->user->avatar) : asset('assets/images/noprofile.png') }}"
                                                                    alt="Profile Picture" class="profile--avatar img-fluid rounded-circle">
                                                                <span class="username"><b>{{ optional($reply->user)->username }}</b></span>
                                                                {{ $reply->reply_text }}
                                                            </div>

                                                            <!-- Like Button for each reply -->
                                                            <button class="like-button" data-comment-id="{{ $comment->id }}" data-reply-id="{{ $reply->id }}">
                                                                <span class="material-symbols-outlined">
                                                                    thumb_up
                                                                </span>
                                                            </button>

                                                            <!-- Display the like count for each reply -->
                                                            <span class="like-count" id="like-count-{{ $reply->id }}">{{ $reply->likes_count }}</span>

                                                            <!-- Reply Link for each reply -->
                                                            <a href="#" class="reply-link" data-comment-id="{{ $comment->id }}" data-parent-reply-id="{{ $reply->id }}">
                                                                <span class="material-symbols-outlined">
                                                                    add_comment
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            @endif
                                        </div>

                                        <!-- Reply Form for all comments -->
                                        <form class="reply-form" data-comment-id="{{ $comment->id }}" style="display:none;">
                                            <h4>Reply to {{ $comment->user->username }}'s comment</h4>
                                            @auth
                                                <div class="form-group">
                                                    <textarea name="reply_text" class="form-control" rows="4" placeholder="Type your reply" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                                            @else
                                                <p>Please <a href="{{ route('login') }}"><b><i>log in</i></b></a> to leave a reply.</p>
                                            @endauth
                                        </form>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <!-- New Comment Form -->
                        <div class="comment-form">
                            <h4>Add a Comment</h4>
                            <form id="new-comment-form" action="{{ route('comments.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="form-group">
                                    <textarea name="comment_text" class="form-control" rows="4" placeholder="Type your comment" required></textarea>
                                </div>
                                <button type="submit" class="btn submit--comment">Submit</button>
                            </form>
                        </div>

                    </div>
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
                <div class="container popular-container">
                    <div class=" mb-5">
                        <h2 class="section-title fw-bold  text-lg-start text-center">Most Popular</h2>
                    </div>
                <div class="d-flex flex-wrap justify-content-center gap-lg-2 gap-4 px-3">
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
@include('inc.footer')
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('assets/js/universal.js')}}"></script>
    <script src="{{asset('assets/js/comments.js')}}"></script>
    <script src="{{asset('assets/js/show.js')}}"></script>
    <script src="{{asset('assets/js/replies.js')}}"></script>
    <script src="{{asset('assets/js/like.js')}}"></script>
@endsection