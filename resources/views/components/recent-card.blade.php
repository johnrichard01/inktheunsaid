@props(['blog'])
<div class="d-flex flex-wrap mb-4">
    <div class="recent-image-container col-6 col-lg-4">
        <img class="img-fluid image-recent" src="{{$blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('assets/images/nothumbnail.png')}}" alt="">
    </div>
    <div class="recent-container col-6 d-flex justify-content-center justify-content-lg-start">
        <div class="mx-0 mx-lg-3">
            <div class="time-container d-flex">
                <div class="recent-time">{{$blog->created_at}}</div>
                <div class="recent-categ">-{{$blog->category}}</div>
            </div>
            <div class="title-container">
                <h5 class="fw-bold recent-title">{{$blog->title}}</h5>
            </div>
            <div class="content-container">
                    {{$blog->about}}
            </div>
            <div class="read-container">
                <a href="/blogs/{{$blog->id}}" class="btn btn-read  btn-recent text-decoration-none fw-bold" type="button">Read more</a>
            </div>
        </div> 
    </div>
</div>