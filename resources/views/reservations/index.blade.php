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
                <th>Province</th>
                <th>District</th>
                <th>Min price</th>
                <th>Max price</th>
                <th>Bedroom quantity</th>
                <th>Bathroom quantity</th>
                <th>Created At</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $reservation)
                    @php
                        $province = $reservation->province ? collect($locations)->first(function ($province) use ($reservation) {
                            return $province['code'] === $reservation->province;
                        }) : null;

                        if ($province && $reservation->district) {
                            $district = collect($province['districts'])->first(function ($item) use ($reservation) {
                                return $item['code'] === $reservation->district;
                            });
                        }
                    @endphp
                    <tr>
                        <td class="first-row">
                            {{$key + 1}}
                            <input type="checkbox" attr-id="{{$reservation->id}}" class="is_supported" @if($reservation->is_supported) checked @endif>
                        </td>
                        <td>{{$reservation->name}}</td>
                        <td>{{$reservation->email}}</td>
                        <td>{{$reservation->phone}}</td>
                        <td>
                            @if($reservation->room)
                                <a href="{{route('rooms.show', $reservation->room->id)}}">{{$reservation->room->name}}</a>
                            @endif
                        </td>
                        <td>
                            {{$province ? $province['name'] : ''}}
                        </td>
                        <td>
                            {{isset($district) ? $district['name'] : ''}}
                        </td>
                        <td>{{$reservation->min_price}}</td>
                        <td>{{$reservation->max_price}}</td>
                        <td>{{$reservation->bedroom}}</td>
                        <td>{{$reservation->bathroom}}</td>
                        <td>{{$reservation->created_at->format('Y-m-d H:i:s')}}</td>
                        <td>
                            <!-- <a href="{{route('reservations.edit', $reservation->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>-->
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteReservation('{{$reservation->id}}')">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a>
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
    .first-row {
        display: flex;
        justify-content: space-between;
        min-width: 50px;
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
        $('.is_supported').on('change', function (event) {
            event.preventDefault();
            const id = $(this).attr('attr-id');
            const supported = $(this).is(":checked");
            let title = 'Do you want to mark this reservation was supported ?';

            if (!supported) {
                title = 'Do you want to mark this reservation wasn\'t supported yet ?';
            }
          
            const url = `${prefix}/mark-supported/${id}`;
            $.ajax({
                type: "POST",
                url: url,
                data: {_token: csrf, supported: $(this).is(":checked")},
                dataType: "json",
                success: function (response) {
                    if (response) {
                        if (supported) {
                            Swal.fire({
                                title: 'You mark this reservation was supported success',
                                icon: 'success',
                            })
                        } else {
                            Swal.fire({
                                title: 'You mark this reservation wasn\'t supported yet success',
                                icon: 'success',
                            })
                        }
                    }
                }
            });
        });
    });

</script>
@endsection