@php
 $pageName = 'Rooms';
@endphp
@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{route('rooms.create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>En Name</th>
                <th>Price</th>
                <th>Total view</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($rooms as $key => $room)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$room->name}}</td>
                        <td>{{$room->translate?->name}}</td>
                        <td>{{$room->price}}$ / {{$room->unit}}</td>
                        <td>{{$room->view_count ?? 0}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('rooms.show', $room->id)}}">
                                <i class="far fa-eye"></i>
                            </a>

                            <a href="{{route('rooms.edit', $room->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteRoom('{{$room->id}}')">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $rooms->links() !!}

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
    const prefix = '{{route("rooms.index")}}';
    function deleteRoom(id) {
        Swal.fire({
        title: 'Do you want to delete the Room ?',
        icon: 'question',
        iconHtml: '؟',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        showCancelButton: true,
        showCloseButton: true
      }).then(result => {
            const url = `${prefix}/${id}`;
            $.ajax({
                type: "DELETE",
                url: url,
                data: {_token: csrf},
                dataType: "json",
                success: function (response) {
                    if (response) {
                        window.location.reload();
                    }
                }
            });
      });
    }

    $(document).ready(function () {
        
    });

</script>
@endsection