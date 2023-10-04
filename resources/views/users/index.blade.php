@php
    $pageName = 'Users';
@endphp
@extends('master')
@section('content')
    <div style="margin-bottom:15px">
        <a href="{{route('users.create')}}" class="btn btn-block btn-success" style="width: fit-content;"><i class="fa fa-plus"></i></a>
    </div>
    <div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Role</th>
                <th style="width: 200px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->roleString}}</td>
                        <td>
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary edit-btn mr-10">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger del-btn @if($user->role === \App\Enums\UserRole::Admin) disabled @endif" disabled @if($user->role !== \App\Enums\UserRole::Admin) onclick="deleteCategory('{{$user->id}}')" @endif>
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$data->links()}}
    </div>
</div>
@endsection

@section('js')
<script>
    const csrf = '{{csrf_token()}}'
    const prefix = '{{route("users.index")}}';
    function deleteCategory(id) {
        const url = `${prefix}/${id}`;
        $.ajax({
            type: "DELETE",
            url: url,
            data: {_token: csrf},
            dataType: "json",
            success: function (response) {
                Swal.fire('Delete User success!', '', 'success').then(() => {
                    window.location.reload();
                });
            },
            error: function (response) {
                Swal.fire('Delete User failed!', '', 'error');
            } 
        });
    }

    $(document).ready(function () {
        
    });
</script>
@endsection

