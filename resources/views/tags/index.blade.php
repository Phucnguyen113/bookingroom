@extends('master')
@section('content')

<div style="margin-bottom:15px">
    <a href="{{url('tags/create')}}" class="btn btn-block btn-success" style="width: fit-content;">Add</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th style="width: 40px">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $metaTag)
                    <tr>
                        <td>{{$metaTag->id}}</td>
                        <td>{{$metaTag->name}}</td>
                        <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection