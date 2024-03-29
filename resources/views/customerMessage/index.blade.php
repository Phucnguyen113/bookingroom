@php
 $pageName = 'Customer message';
@endphp
@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{route('customer-messages.create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Message</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $message)
                    <tr>
                        <td>{{$message->id}}</td>
                        <td>{{$message->name}}</td>
                        <td>{!!$message->message!!}</td>
                        <td>
                            <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modal{{$message->id}}">
                                <i class="far fa-eye"></i>
                            </button> -->
                            @include('components.modal.default', ['modalId' => 'modal'.$message->id, 'title' => $message->name, 'content' => $message->content])
                            <a href="{{route('customer-messages.edit', $message->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn" onclick="deleteMessage('{{$message->id}}')">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!!$data->links()!!}
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
    const prefix = '{{route("customer-messages.index")}}';
    function deleteMessage(id) {
        Swal.fire({
        title: 'Do you want to delete the Customer message ?',
        icon: 'question',
        iconHtml: '؟',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        showCancelButton: true,
        showCloseButton: true
      }).then(result => {
        if (!result.isConfirmed) {
            return;
        }
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
      })
    }

    $(document).ready(function () {
        
    });
</script>
@endsection