@php
    $pageName = 'Rooms';
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
        <form action="{{route('rooms.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">En Name</label>
                            <input type="text" class="form-control" name="en_name" id="en_name" placeholder="Enter english name" value="{{old('en_name')}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="{{old('price')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Unit</label><br>
                                    <select name="unit" id="unit" style="width:100%">
                                        <option value="month" selected>Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                            </div>
                       </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Province</label>
                            <!-- <input type="text" class="form-control" name="province" placeholder="Enter province" id="province" value="{{old('province')}}"> -->
                            <select name="province" id="province" class="service" style="width:100%">
                                @foreach($locations as $province)
                                    <option value="{{$province['code']}}" @if($province['code'] == old('province')) selected @endif>{{$province['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">District</label>
                            <!-- <input type="text" class="form-control" name="district" placeholder="Enter district" id="district" value="{{old('district')}}"> -->
                            <select name="district" id="district" class="service" style="width:100%">
                                @foreach(collect($locations)->first(function ($item) {
                                        return $item['code'] == (old('province') ?? 1);
                                    })['districts'] ?? [] as $district)
                                    <option value="{{$district['code']}}" @if(old('district') == $district['code']) selected @endif>{{$district['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter address" id="address" value="{{old('address')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">En Address</label>
                            <input type="text" class="form-control" name="en_address" placeholder="Enter english address" id="en_address" value="{{old('en_address')}}">
                        </div>
                    </div>
               </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Start date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="Enter start date" value="{{old('start_date')}}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">End date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="Enter end date" id="end_date" value="{{old('end_date')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Category</label>
                            <select name="category[]" id="category" class="select2" multiple>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Bedrooms</label>
                            <input type="number" class="form-control number" name="bedroom" placeholder="Enter end date" id="bedroom" value="{{old('bedroom')}}" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Bathroom</label>
                            <input type="number" class="form-control number" name="bathroom" placeholder="Enter end date" id="bathroom" value="{{old('bathroom')}}" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Acreage</label>
                            <input type="number" class="form-control number" name="acreage" placeholder="Enter end date" id="acreage" value="{{old('acreage')}}" min="1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Room type</label><br>
                            <select class="service" name="room_type" id="room_type" style="width:100%">
                                @foreach(App\Enums\RoomType::asSelectArray() as $key => $description)
                                    <option value="{{$key}}">{{$description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">General amenities</label><br>
                            <select class="service" name="general_amenities[]" id="general_amenities" style="width:100%" multiple>
                                @foreach($serviceTags[App\Enums\Tags::RoomService['general_amenities']] as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Outdoor facilities</label><br>
                            <select class="service" name="outdoor_facilities[]" id="outdoor_facilities" style="width:100%" multiple>
                                @foreach($serviceTags[App\Enums\Tags::RoomService['outdoor_facilities']] as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label><br>
                    <textarea class="summernote" name="description">
                        {{old('description')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="description">En Description</label><br>
                    <textarea class="summernote" name="en_description">
                        {{old('en_description')}}
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
    function convertCaseAsTitle(input) {
        return input.replace(/\S+/g, function(word) {
            return word.charAt(0).toUpperCase() + word.substr(1).toLowerCase();
        });
    }
    $(function () {
        const locations = JSON.parse('@json($locations)');
        // Summernote
        $('.summernote').summernote({
            height: 600
        })
        $('#unit').select2({
            theme: 'bootstrap4'
        });

        $('.service').select2({
            theme: 'bootstrap4',
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: convertCaseAsTitle(term),
                    text: convertCaseAsTitle(term),
                    newTag: true // add additional parameters
                }
            }
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

        $('#province').on('change', function (value, i) {
            const provinceCode = this.value;
            const province = locations.filter(function (item) {
                return item.code == provinceCode;
            });
            $('#district').empty().trigger('change');
            let option = '';
            if (province?.[0]) {
                province[0].districts.map(function (district) {
                    option += `<option value="${district.code}">${district.name} </option>`
                });
            }
            $('#district').append(option);
        });
    })
</script>
@endsection