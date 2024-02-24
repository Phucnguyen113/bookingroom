@php
 $pageName = 'Edit Blog';
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
        <form action="{{route('blogs.update', $blog->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{$blog->title}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">En Title</label>
                            <input type="text" class="form-control" name="en_title" placeholder="Enter title" value="{{$blog->translate?->title}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Category</label>
                                    <select class="category" name="category[]" style="width:100%" multiple>
                                    @php
                                        $categoryIds = $blog->categories->pluck('id')->toArray();
                                    @endphp
                                    @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(in_array($category->id, $categoryIds)) selected @endif)>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Tags</label>
                                    <select class="tags" name="tags[]" style="width:100%" multiple>
                                    @php
                                        $taged = $blog->tags()->get()->pluck('id')->toArray();
                                    @endphp
                                    @foreach($tags as $tag)
                                            <option value="{{$tag->name}}" @if(in_array($tag->id, $taged)) selected @endif>{{$tag->name}}</option>
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
                    <textarea class="description" id="description" name="description">
                        {{old('content')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">En Description</label><br>
                    <textarea class="description" id="en_description" name="en_description">
                        {{old('content')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label><br>
                    <textarea class="summernote" id="content" name="content">

                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">En Content</label><br>
                    <textarea class="summernote" id="en_content" name="en_content">
                      
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
        $('.summernote').summernote({
            height:450
        })
        $('#content').summernote('code', '{!!$blog->content!!}')
        $('#en_content').summernote('code', '{!!$blog->translate?->content!!}')
        $('#description').summernote('code', '{!!$blog->description!!}')
        $('#description').summernote({
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
        $('#en_description').summernote('code', '{!!$blog->translate?->description!!}')
        $('#en_description').summernote({
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