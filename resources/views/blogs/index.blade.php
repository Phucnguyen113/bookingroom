@php
 $pageName = 'Blogs';
@endphp
@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{route('blogs.create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Title</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $blog)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$blog->title}}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal{{$blog->id}}">
                                <i class="far fa-eye"></i>
                            </button>
                            @include('components.modal.default', ['modalId' => 'modal'.$blog->id, 'title' => $blog->title, 'content' => $blog->content])
                            <a href="{{route('blogs.edit', $blog->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteBlog('{{$blog->id}}')">
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
    const prefix = '{{route("blogs.index")}}';
    function deleteBlog(id) {
        const url = `${prefix}/${id}`;
        $.ajax({
            type: "DELETE",
            url: url,
            data: {_token: csrf},
            dataType: "json",
            success: function (response) {
                console.log('re', response);
                if (response) {
                    window.location.reload();
                }
            }
        });
    }

    $(document).ready(function () {
        
    });

</script>
@endsection