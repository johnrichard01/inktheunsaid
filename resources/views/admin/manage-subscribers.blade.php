@extends('master')
@section('title', 'Manage-Blogs')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/admin-nav.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-user.css')}}">
@endsection
@section('content')
@include('inc.admin-sidebar')
@include('inc.admin-navbar')
{{-- modal for deleting subs --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="/dashboard/delete-subscriber/{user_id}" method="POST">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Subscriber</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_delete_id" id="user_id">
                Are you sure you want to delete this subscriber ?
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
                        <h1 class="fw-bold text-center section-header">Newsletter</h1>
                    </div>
                    <div class="table-container container mt-5">
                        <div class="d-flex flex-wrap justify-content-center">
                            
                            @if ($subs->isEmpty())
                            <svg xmlns="http://www.w3.org/2000/svg" width="30rem" height="30rem" fill="currentColor" class="no-icon bi bi-send-fill" viewBox="0 0 16 16">
                                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
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
                                                Email
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        @foreach ($subs as $count=>$sub)
                                        <tr class="table-content">
                                            <td>
                                                {{$count + 1}}
                                            </td>
                                            <td>
                                                {{$sub->email}}
                                            </td>
                                            <td>
                                                {{$sub->created_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <a href="#" class="dropdown-toggle btn-action" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2.25rem" height="2.25rem" fill="currentColor" class="action-icon bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                          <ul class="dropdown-menu">
                                                            <li class="text-center">
                                                                <button class="btn deleteBTN" id="deleteBTN" value="{{$sub->id}}">Delete</button>
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
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('assets/js/admin-nav.js')}}"></script>
<script src="{{asset('assets/js/manage-subscriber.js')}}"></script>
@endsection