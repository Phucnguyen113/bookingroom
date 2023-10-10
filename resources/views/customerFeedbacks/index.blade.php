@php
 $pageName = 'Customer Feedback';
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
                <th>Message</th>
                <!-- <th style="width: 200px">Action</th> -->
            </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $customerFeedback)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$customerFeedback->name}}</td>
                        <td>{{$customerFeedback->email}}</td>
                        <td>{{$customerFeedback->phone}}</td>
                        <td>{{$customerFeedback->room->name}}</td>
                        <td>{{$customerFeedback->created_at->format('Y-m-d H:i:s')}}</td>
                        <td data-toggle="tooltip" title="{{$customerFeedback->message}}"> {{substr($customerFeedback->message, 0, 50)}} @if(strlen($customerFeedback->message) > 50)...@endif</td>
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