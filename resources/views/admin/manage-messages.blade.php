@extends('master')
@section('title', 'Manage-Blogs')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/admin-nav.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-user.css')}}">
@endsection
@section('content')
@include('inc.admin-sidebar')
@include('inc.admin-navbar')
{{-- modal for deleting messages --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="/dashboard/delete-contact/{user_id}" method="POST">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_delete_id" id="user_id">
                Are you sure you want to delete this message ?
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
                        <h1 class="fw-bold text-center section-header">Messages</h1>
                    </div>
                    <div class="table-container container mt-5">
                        <div class="d-flex flex-wrap justify-content-center">
                            
                            @if ($messages->isEmpty())
                            <svg xmlns="http://www.w3.org/2000/svg" width="30rem" height="30rem" fill="currentColor" class="no-icon bi bi-envelope-at-fill" viewBox="0 0 16 16">
                                <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                                <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
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
                                                name
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
                                        @foreach ($messages as $count=>$message)
                                        <tr class="table-content">
                                            <td>
                                                {{$count + 1}}
                                            </td>
                                            <td>
                                                {{$message->firstName}}&nbsp;{{$message->lastName}}
                                            </td>
                                            <td>
                                                {{$message->email}}
                                            </td>
                                            <td>
                                                {{$message->created_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <a href="#" class="dropdown-toggle btn-action" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2.25rem" height="2.25rem" fill="currentColor" class="action-icon bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                          <ul class="dropdown-menu">
                                                            <li  class="text-center">
                                                                <a href="#" class="btn-view text-center text-decoration-none" data-bs-toggle="modal" data-bs-target="#blogsView" data-id={{$message->id}}>View</a>
                                                            </li>
                                                            <li class="text-center">
                                                                <button class="btn deleteBTN" id="deleteBTN" value="{{$message->id}}">Delete</button>
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
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header ">
              <h1 class="modal-title fs-5 w-100 text-center" id="exampleModalLabel">Message Details</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" readonly autocomplete="name">
                    </div>
                    <div class="error-message" id="fname-error">

                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" readonly autocomplete="lastname">
                    </div>
                    <div class="error-message" id="lname-error">
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" readonly autocomplete="email">
                    </div>
                    <div class="error-message" id="email-error">
                        
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" readonly>

                        </textarea>
                    </div>
                    <div class="error-message" id="message-error"></div>
                </form>
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
<script src="{{asset('assets/js/manage-messages.js')}}"></script>
@endsection