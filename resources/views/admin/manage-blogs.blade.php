@extends('master')
@section('title', 'Manage-Blogs')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/admin-nav.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-user.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-blogs.css')}}">
@endsection
@section('content')
@include('inc.admin-sidebar')
@include('inc.admin-navbar')
{{-- modal for deleting user --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="/dashboard/delete-blog/{blog_id}" method="POST">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_delete_id" id="blog_id">
                Are you sure you want to delete this blog ?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
    </div>
</div>
    <!-- analytics -->
    <x-admin-container>
                <section class="section1">
                    <div class="container-fluid section-title py-5">
                        <h1 class="fw-bold text-center section-header">Blogs</h1>
                    </div>
                    <div class="table-container container mt-5">
                        <div class="d-flex flex-wrap justify-content-center">
                            
                            @if ($blogs->isEmpty())
                            <svg xmlns="http://www.w3.org/2000/svg" width="30rem" height="30rem" fill="currentColor" class="no-icon bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                            @else
                            <div class="table-border">
                                <table class="col-12">
                                    <tbody class="">
                                        <tr class="table-header">
                                            <th>
                                                No.
                                            </th>
                                            <th>
                                                Username
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Category
                                            </th>
                                            <th>
                                                Date/Time
                                            </th>
                                            <th>
                                                Updated
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        @foreach ($blogs as $count=>$blog)
                                        <tr class="table-content">
                                            <td>
                                                {{$count + 1}}
                                            </td>
                                            <td>
                                                {{$blog->user->username}}
                                            </td>
                                            <td>
                                                {{$blog->title}}
                                            </td>
                                            <td>
                                                {{$blog->category}}
                                            </td>
                                            <td>
                                                {{$blog->created_at}}
                                            </td>
                                            <td>
                                                {{$blog->updated_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <a href="#" class="dropdown-toggle btn-action" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2.25rem" height="2.25rem" fill="currentColor" class="action-icon bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                          <ul class="dropdown-menu">
                                                            <li  class="text-center">
                                                                <a href="#" class="btn-view text-center text-decoration-none" data-bs-toggle="modal" data-bs-target="#blogsView" data-id={{$blog->id}}>View</a>
                                                            </li>
                                                            <li class="text-center">
                                                                <button class="btn deleteBTN" id="deleteBTN" value="{{$blog->id}}">Delete</button>
                                                            </li>
                                                        </ul>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            </div>
                        </div>
                    </div>
                </section>
    </x-admin-container>
  <div class="modal fade" id="blogsView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header ">
          <h1 class="modal-title fs-5 w-100 text-center" id="exampleModalLabel">Blog Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <div class="container-fluid categ-container px-0 py-5">
            <div class="container">
                <h1 class="categ-title fw-bold text-start" id="modalTitle"></h1>
                <p class="author-view" id="modalAuthor"></p>
            </div>
          </div>
          <div class="container">
            <div class="col-12 px-5">
                <div class="content">
                    <div class="show-image d-flex justify-content-center">
                        <div id="modalUrl" data-base-url="{{ asset('') }}"></div>
                        <img id="modalThumb" class="blog-image-show" alt="">
                    </div> 
                </div>
                <div class="desc-container mt-5">
                    <div class="description" id="modalDesc">
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('assets/js/admin-nav.js')}}"></script>
<script src="{{asset('assets/js/manage-blogs.js')}}"></script>
@endsection