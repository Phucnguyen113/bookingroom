@php
 $pageName = 'Category';
@endphp
@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{route('category.create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Type</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{App\Enums\TypeCategory::getKey($category->type)}}</td>
                        <td>
                            <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteCategory('{{$category->id}}')">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<style>
    .edit-btn {
        display: inline-block;
    }
    .del-btn {
        display: inline-block;
    }
</style>
@endsection

@section('js')
<script>
    const csrf = '{{csrf_token()}}'
    const prefix = '{{route("tags.index")}}';
    function deleteCategory(id) {
        const url = `${prefix}/${id}`;
        $.ajax({
            type: "DELETE",
            url: url,
            data: {_token: csrf},
            dataType: "json",
            success: function (response) {
                console.log('re', response);
                if (response) {

                }
            }
        });
    }

    $(document).ready(function () {
        
    });
</script>
@endsection