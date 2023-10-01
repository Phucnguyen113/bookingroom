
@php
    $pageName = 'Change password';
@endphp
@extends('master')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-body register-card-body">
        <form action="{{route('update-password')}}" method="post">
            @csrf
            <label for="">Old password</label><br>
            <div class="input-group mb-3">
                <input type="password" name="old_password" class="form-control" placeholder="Old password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <label for="">Password</label><br>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <label for="">Confirm password</label><br>
            <div class="input-group mb-3">
                <input type="password" name="confirm-password" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">Change password</button>
                </div>

                <!-- /.col -->
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
 <style>
    .register-card-body{
        background-color: #fff;
        border-top: 0;
        color: #666;
        padding: 20px;
    }
 </style>
@endsection