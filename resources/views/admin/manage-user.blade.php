@extends('master')
@section('title', 'Manage-User')
@section('css')
    <link rel="stylesheet" href="{{asset('/assets/css/admin-nav.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/manage-user.css')}}">
@endsection
@section('content')
@include('inc.admin-sidebar')
@include('inc.admin-navbar')
    {{-- modal for deleting user --}}
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="/dashboard/delete-user/{user_id}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <input type="hidden" name="user_delete_id" id="user_id">
                    Are you sure you want to delete this user ?
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
                        <h1 class="fw-bold text-center section-header">Users</h1>
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
                        </div>
                    </div>
                </section>
    </x-admin-container>
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('assets/js/admin-nav.js')}}"></script>
<script src="{{asset('assets/js/manage-user.js')}}"></script>
@endsection