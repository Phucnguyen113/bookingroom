@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{route('blogs.create')}}" class="btn btn-block btn-success" style="width: fit-content;">Add</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Content</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $metaTag)
                    <tr>
                        <td>{{$metaTag->id}}</td>
                        <td>{{$metaTag->name}}</td>
                        <td>{!!$metaTag->content!!}</td>
                        <td>
                            <a href="{{route('tags.edit', $metaTag->id)}}" class="btn btn-primary edit-btn mr-10">Edit</a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteMetaTag('{{$metaTag->id}}')">Delete</a>
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