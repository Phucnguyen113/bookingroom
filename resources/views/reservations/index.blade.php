@php
 $pageName = 'Reservations';
@endphp
@extends('master')
@section('content')

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Room</th>
                <th>Created At</th>
                <!-- <th style="width: 200px">Action</th> -->
            </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $reservation)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$reservation->name}}</td>
                        <td>{{$reservation->email}}</td>
                        <td>{{$reservation->phone}}</td>
                        <td><a href="{{route('rooms.show', $reservation->room->id)}}">{{$reservation->room->name}}</a></td>
                        <td>{{$reservation->created_at->format('Y-m-d H:i:s')}}</td>
                        <td>
                            <!-- <a href="{{route('reservations.edit', $reservation->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteReservation('{{$reservation->id}}')">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $data->links() !!}

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
    const prefix = '{{route("reservations.index")}}';
    function deleteReservation(id) {
        Swal.fire({
        title: 'Do you want to delete the reservation ?',
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