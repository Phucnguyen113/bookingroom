@php
 $pageName = 'Edit Category';
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
    <div class="card card-primary">
        <form action="{{route('category.update', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{$category->name}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Type</label>
                            <select name="type" id="type" class="select2">
                                @foreach($types as $key => $type)
                                    <option value="{{$key}}" @if($category->type === $key) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!-- /.card-body -->
        </form>
    </div>

</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
            })
        });
    </script>
@endsection