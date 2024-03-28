@php
    $pageName = 'Customer messages';
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
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('customer-messages.update', $data->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="">Name</label>
            <input type="text"
                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{$data->name}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <label for="">Message</label>
                <textarea id="message" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#message').summernote({
                height: 600
            })
            $('#message').summernote('code', '{!!$data->message!!}');

        });
    </script>
@endsection