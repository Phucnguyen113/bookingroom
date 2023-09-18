@php
 $pageName = 'Blogs / ' . $blog->title;
@endphp

@extends('master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <p class="card-text">{!!$blog->content!!}</p>
      </div>
    </div>
  </div>
</div>
@endsection