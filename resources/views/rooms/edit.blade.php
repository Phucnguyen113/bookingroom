@php
    $pageName = 'Edit Room';
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
        <form action="{{route('rooms.update', $room->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">

               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$room->name}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="{{$room->price}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Unit</label><br>
                                    <select name="unit" id="unit" style="width:100%">
                                        <option value="day" @if($room->unit === 'day') selected @endif>Day</option>
                                        <option value="month" @if($room->unit === 'month') selected @endif>Month</option>
                                        <option value="year" @if($room->unit === 'year') selected @endif>Year</option>
                                    </select>
                                </div>
                            </div>
                       </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Province</label>
                            <input type="text" class="form-control" name="province" placeholder="Enter province" id="province" value="{{$room->province}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">District</label>
                            <input type="text" class="form-control" name="district" placeholder="Enter district" id="district" value="{{$room->district}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter address" id="address" value="{{$room->address}}">
                        </div>
                    </div>
               </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Start date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="Enter start date" value="{{$room->start_date}}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">End date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="Enter end date" id="end_date" value="{{$room->end_date}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Category</label>
                            <select name="category[]" id="category" class="select2" multiple>
                                @php
                                    $categoryIds = $room->categories->pluck('id')->toArray();
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(in_array($category->id, $categoryIds)) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Bedrooms</label>
                            <input type="number" class="form-control number" name="bedroom" placeholder="Enter end date" id="bedroom" value="{{$room->bedroom}}" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Bathroom</label>
                            <input type="number" class="form-control number" name="bathroom" placeholder="Enter end date" id="bathroom" value="{{$room->bathroom}}" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Acreage</label>
                            <input type="number" class="form-control number" name="acreage" placeholder="Enter end date" id="acreage" value="{{$room->acreage}}" min="1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">General amenities</label><br>
                            <select class="service" name="general_amenities[]" id="general_amenities" style="width:100%" multiple>
                                @php
                                    $taged = $room->tags()->get()->groupBy('type');
                                    $outdoorTagIds = $taged[App\Enums\Tags::RoomService['general_amenities']]->pluck('id')->toArray();
                                @endphp
                                @foreach($serviceTags[\App\Enums\Tags::RoomService['general_amenities']] as $tag)
                                    <option value="{{$tag->name}}" @if(in_array($tag->id, $outdoorTagIds)) selected @endif >{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Outdoor facilities</label><br>
                            <select class="service" name="outdoor_facilities[]" id="outdoor_facilities" style="width:100%" multiple>
                                 @php
                                    $outdoorTagIds = $taged[App\Enums\Tags::RoomService['outdoor_facilities']]->pluck('id')->toArray();
                                @endphp
                                @foreach($serviceTags[\App\Enums\Tags::RoomService['outdoor_facilities']] as $tag)
                                    <option value="{{$tag->name}}" @if(in_array($tag->id, $outdoorTagIds)) selected @endif >{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label><br>
                    <textarea id="summernote" name="description">

                    </textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Thumnail</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="thumbnail">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Images</span>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="images[]" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
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
        $('#summernote').summernote({
            height: 600
        })
        $('#summernote').summernote('code', '{!!$room->description!!}');

        $('#unit').select2({
            theme: 'bootstrap4'
        });
        $('.service').select2({
            theme: 'bootstrap4',
            tags: true
        });
        $('#category').select2({
            theme: 'bootstrap4'
        })


        $('#start_date').datetimepicker({
            format: 'L'
        });

        $('.number').on('change', function (e) {
            if (Number(e.currentTarget.value) <=0) {
                this.value = 1;
            }
        });
    })
</script>
@endsection