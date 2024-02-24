@php
 $pageName = 'Add Blog';
@endphp
@extends('master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card card-primary">
        <form action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">En Title</label>
                            <input type="text" class="form-control" name="en_title" placeholder="Enter english title" value="{{old('en_title')}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Category</label>
                                    <select class="category" name="category[]" style="width:100%" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Tags</label>
                                    <select class="tags" name="tags[]" style="width:100%" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="form-group">
                    <span>Thumnail</span>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content">Description</label><br>
                    <textarea class="description" name="description" >
                        {{old('description')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">En Description</label><br>
                    <textarea class="description" name="en_description">
                        {{old('en_description')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label><br>
                    <textarea class="summernote" name="content">
                        {{old('content')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">En Content</label><br>
                    <textarea class="summernote" name="en_content">
                        {{old('en_content')}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!-- /.card-body -->
        </form>
    </div>

</div>
@endsection

@section('js')
<script>
    $(function () {
        // Summernote
        $('.summernote').summernote()
        $('.description').summernote({
                toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        })
        $('.category').select2();

        $('.tags').select2({
            tags: true
        });
    })
</script>
@endsection