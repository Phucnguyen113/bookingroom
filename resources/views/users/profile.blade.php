
@php
    $pageName = 'Profile';
@endphp
@extends('master')

@section('content')
<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <!-- <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div> -->

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->roleString}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$user->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Password</b> <a class="float-right">*******</a>
                  </li>
                </ul>

                <a href="{{route('edit-password')}}" class="btn btn-primary btn-block"><b>Edit password</b></a>
              </div>
              <!-- /.card-body -->
            </div>
@endsection