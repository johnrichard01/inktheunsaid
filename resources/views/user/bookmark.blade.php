@extends('master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/universal.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bookmark.css') }}">
@endsection

@section('content')
    @include('inc.navbar')
    <main>

        <div class="container-fluid title-container py-5">
            <h1 class="fw-bold text-center favorite--header">Favorites</h1>
        </div>

        <div class="container mt-5">
            @if($bookmarks->count() > 0)
                @foreach($bookmarks->groupBy('blog.category') as $category => $blogs)
                    <div class="blog-category">
                        <h2 class="categories--h2">{{ $category }}</h2>
                        <div class="blog-table-container" style="max-height: {{ $blogs->count() > 5 ? '200px' : 'auto' }};">
                            <table class="blog-table">
                                <thead>
                                    <tr>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs->take(5) as $bookmark) {{-- Display only 5 items --}}
                                        <tr class="blog-item">
                                            <td>
                                                <img src="{{ $bookmark->blog->user->avatar ? asset('storage/' . $bookmark->blog->user->avatar) : asset('assets/images/noprofile.png') }}" alt="Author Avatar" class="user-avatar img-fluid">
                                                {{ $bookmark->blog->user->username }}
                                            </td>
                                            <td>
                                                <a href="{{ route('blogs.show', $bookmark->blog->id) }}">{{ $bookmark->blog->title }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('blogs.show', $bookmark->blog->id) }}">
                                                    <img src="{{ $bookmark->blog->thumbnail ? asset('storage/' . $bookmark->blog->thumbnail) : asset('assets/images/noprofile.png') }}" alt="Blog Thumbnail" class="blog-thumbnail img-fluid blog--image">
                                                </a>
                                            </td>
                                            <td class="description-cell">
                                                {!! $bookmark->blog->description !!}
                                            </td>
                                            <td>
                                                @if(auth()->user()->bookmarks->contains('blog_id', $bookmark->blog->id))
                                                    <form action="{{ route('bookmarks.unbookmark', $bookmark->blog) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete--btn" type="submit">
                                                            <span class="material-symbols-outlined">
                                                                delete
                                                            </span>
                                                        </button>
                                                    </form>
                                                @endif
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="zero--booked row">
                <div class="col">
                    <h1>No items yet.</h1>
                        Add Items?
                    <a href="{{ url('/') }}" class="btn btn-lg add--btn">Add</a>
                </div>
                
                <div class="col">
                    <p>
                     
                    </p>
                </div>
            </div>
            @endif
        </div>

    </main>

    
@include('inc.footer')
@endsection


