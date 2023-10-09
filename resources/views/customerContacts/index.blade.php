@php
 $pageName = 'Customer Contact';
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
                <th>Subject</th>
                <th>Created At</th>
                <th>Message</th>
                <!-- <th style="width: 200px">Action</th> -->
            </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $customerContact)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$customerContact->name}}</td>
                        <td>{{$customerContact->email}}</td>
                        <td>{{$customerContact->phone}}</td>
                        <td>{{$customerContact->subject}}</td>
                        <td>{{$customerContact->created_at->format('Y-m-d H:i:s')}}</td>
                        <td data-toggle="tooltip" title="{{$customerContact->message}}"> {{substr($customerContact->message, 0, 50)}} @if(strlen($customerContact->message) > 50)...@endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $data->links() !!}

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

</script>
@endsection