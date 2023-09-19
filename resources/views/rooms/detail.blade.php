@php
 $pageName = 'Rooms / ' . $room->name;
@endphp

@extends('master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div>
            <p class="card-text">
                Images
            </p>
            <div>
                @foreach($room->images as $image)
                    <img src="{{$image->getUrl()}}" />
                @endforeach
            </div>
        </div>
        <p class="card-text">{!!$room->description!!}</p>
      </div>
    </div>
  </div>
</div>
@endsection