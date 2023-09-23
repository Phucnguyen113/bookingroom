@php
    $pageName = 'Info';
@endphp

@extends('master')
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <label for="">Name</label>
            <input type="text"
                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{$data->where('type', 'name')->first()?->value}}">
            </div>
            <div class="form-group">
                <label>Logo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <label for="">Address</label>
            <input type="text"
                class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{$data->where('type', 'address')->first()?->value}}">
            </div>
            <div class="form-group">
            <label for="">Email</label>
            <input type="email"
                class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{$data->where('type', 'email')->first()?->value}}">
            </div>
            <div class="form-group">
            <label for="">Phone</label>
            <input type="text"
                class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="" value="{{$data->where('type', 'phone')->first()?->value}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
