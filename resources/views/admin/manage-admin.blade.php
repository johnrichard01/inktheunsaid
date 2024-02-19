@extends('master')
@section('title', 'Manage-Admin')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/admin-nav.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-user.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-admin.css')}}">
@endsection
@section('content')
@include('inc.admin-sidebar')
@include('inc.admin-navbar')
{{-- modal for deleting user --}}
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="/dashboard/delete-admin/{user_id}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_delete_id" id="user_id">
                    Are you sure you want to delete this admin ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    {{-- modal for deleting user --}}
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 w-100 text-center" id="exampleModalLabel">Add Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <main class="container container-form">

                        <div class="container-fluid">
                    
                            <!-- SIGN UP FORM-->
                            <form action="/dashboard/manage-admin/admins" method="POST" class="signupForm" id="signup" >
                                @csrf
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text " id="basic-addon1">
                                        <span class="material-symbols-outlined">
                                            person
                                        </span>
                                    </span>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                @error('username')
                                <div class="form__error--message text-center">{{$message}}</div>
                                @enderror
                                <div class="form__error--message text-center" id="usernameError"></div>
                    
                                <div class="input-group mb-3">
                                    <span class="input-group-text " id="basic-addon1">
                                        <span class="material-symbols-outlined">
                                            mail
                                        </span>
                                    </span>
                                    <input type="email"  id="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                    
                                </div>
                                @error('email')
                                    <div class="form__error--message text-center">{{$message}}</div>
                                @enderror
                                <div class="form__error--message text-center" id="emailError"></div>
                    
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <span class="material-symbols-outlined">
                                            passkey
                                        </span>
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                    
                                <div class="form__error--message text-center" id="passwordError"></div>
                    
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <span class="material-symbols-outlined">
                                            passkey
                                        </span>
                                    </span>
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="form__error--message text-center" id="cpasswordError"></div>
                                <div class="w-100 d-flex flex-wrap justify-content-center py-3">
                                    <button class="form__button w-50" type="submit" id="signupButton">ADD</button>
                                </div>
                            </form>
                    
                        </div>
                    </main>
                </div>
        </div>
        </div>
    </div>
    <!-- analytics -->
    <x-admin-container>
                <section class="section1">
                    <div class="container-fluid section-title py-5">
                        <h1 class="fw-bold text-center section-header">Admins</h1>
                    </div>
                    <div class="table-container container mt-5">
                        <div class="d-flex flex-wrap justify-content-center">
                            
                            @if ($users->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" width="30rem" height="30rem" fill="currentColor" class="no-icon bi bi-person-fill-slash" viewBox="0 0 16 16">
                                    <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
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
                                                Email
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        @foreach ($users as $count=>$user)
                                        <tr class="table-content">
                                            <td>
                                                {{$count + 1}}
                                            </td>
                                            <td>
                                                {{$user->username}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                <div class="dropdown-center">
                                                    <a href="#" class="dropdown-toggle btn-action" data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2.25rem" height="2.25rem" fill="currentColor" class="action-icon bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                          <ul class="dropdown-menu">
                                                            <li class="text-center">
                                                                <button class="btn deleteBTN" id="deleteBTN" value="{{$user->id}}">Delete</button>
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
                            <button class="btn btn-addAdmin d-flex flex-wrap justify-content-center align-items-center" id="addBTN">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                  </svg>
                            </button>
                        </div>
                    </div>
                </section>
    </x-admin-container>
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('assets/js/admin-nav.js')}}"></script>
<script src="{{asset('assets/js/manage-admin.js')}}"></script>
@endsection