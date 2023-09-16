@php
 $pageName = 'Tags';
@endphp
@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{url('tags/create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <!-- <th>Content</th> -->
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $metaTag)
                    <tr>
                        <td>{{$metaTag->id}}</td>
                        <td>{{$metaTag->name}}</td>
                        <!-- <td>{!!$metaTag->content!!}</td> -->
                        <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal{{$metaTag->id}}">
                                <i class="far fa-eye"></i>
                            </button>
                            @include('components.modal.default', ['modalId' => 'modal'.$metaTag->id, 'title' => $metaTag->name, 'content' => $metaTag->content])
                            <a href="{{route('tags.edit', $metaTag->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteMetaTag('{{$metaTag->id}}')">
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
    function deleteMetaTag(id) {
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