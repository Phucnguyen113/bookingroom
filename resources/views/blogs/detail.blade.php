@php
 $pageName = 'Blogs / ' . $blog->title;
@endphp

@extends('master')

@section('content')

<div class="">
  <div class="meta">
      <p>Created at: <span id="publish-date">{{$blog->created_at->format('Y/m/d')}}</span></p>
  </div>
  <div class="description">
      <p id="blog-description">
          {{$blog->description}}
      </p>
  </div>
  <div class="content">
      <p id="blog-content">
      {!!$blog->content!!}
      </p>
  </div>
</div>

@endsection
