@php
 $pageName = 'Rooms / ' . $room->name;
@endphp

@extends('master')

@section('content')
<div class="row">
  <div class="col-md-12">
  <div style="margin-bottom:15px">
    <a href="{{route('rooms.edit', $room->id)}}" class="btn btn-block btn-primary" style="width: fit-content;"><i class="fas fa-edit"></i></a>
  </div>
    <div class="card">
      <div class="card-body">
        <div>
            <div class="form-group">
              <label>Images</label>
            </div>
            <div class="row">
                @foreach($room->images as $image)
                  <div class="col-md-3 mb-2 box-image" id="box-image-{{$image->id}}">
                    <div class="icon-x" onclick="deleteImage('{{$image->id}}')"><i class="fas fa-times"></i></div>
                    <img src="{{$image->getUrl()}}" class="img-fluid"/>
                  </div>
                @endforeach
            </div>
        </div>
        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$room->name}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="{{$room->price}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Unit</label><br>
                                    <select name="unit" id="unit" style="width:100%" disabled>
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
                            <input type="text" class="form-control" name="province" placeholder="Enter province" id="province" value="{{$room->province}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">District</label>
                            <input type="text" class="form-control" name="district" placeholder="Enter district" id="district" value="{{$room->district}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter address" id="address" value="{{$room->address}}" disabled>
                        </div>
                    </div>
               </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Start date</label>
                            <input type="date" class="form-control" name="start_date" placeholder="Enter start date" value="{{$room->start_date}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">End date</label>
                            <input type="date" class="form-control" name="end_date" placeholder="Enter end date" id="end_date" value="{{$room->end_date}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Category</label>
                            <select name="category[]" id="category" class="select2" multiple disabled>
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
                            <input type="number" class="form-control number" name="bedroom" placeholder="Enter end date" id="bedroom" value="{{$room->bedroom}}" min="1" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Bathroom</label>
                            <input type="number" class="form-control number" name="bathroom" placeholder="Enter end date" id="bathroom" value="{{$room->bathroom}}" min="1" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Acreage</label>
                            <input type="number" class="form-control number" name="acreage" placeholder="Enter end date" id="acreage" value="{{$room->acreage}}" min="1" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Room type</label><br>
                            <select class="service" name="room_type" id="room_type" style="width:100%" disabled>
                                @foreach(App\Enums\RoomType::asSelectArray() as $key => $description)
                                    <option value="{{$key}}" @if($room->room_type === $key) selected @endif>{{$description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">General amenities</label><br>
                            <select class="service" name="general_amenities[]" id="general_amenities" style="width:100%" multiple disabled>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="address">Outdoor facilities</label><br>
                            <select class="service" name="outdoor_facilities[]" id="outdoor_facilities" style="width:100%" multiple disabled>
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
                    <textarea id="summernote" name="description" disabled>

                    </textarea>
                </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<style>
  .box-image {
    flex: 0 0 fit-content;
    max-width: 25%;
    position: relative
  }
  .box-image:hover .icon-x {
    visibility: visible;
  }
  .icon-x {
    position: absolute;
    top: 0;
    color: red;
    font-size: 25px;
    background: #1c1b1b36;
    width: calc(100% - 15px);
    height: 100%;
    visibility: hidden;
  }
  .icon-x i {
    float:right;
    cursor: pointer;
    margin-right:10px;
  }
</style>
@endsection

@section('js')
<script>
    function deleteImage(id)
    {
      if ($('.box-image').length === 1) {
        Swal.fire('The Rooms must have least 1 image', '', 'error');
        return;
      }
      let _token = $('meta[name="csrf-token"]').attr('content')
      let api = "{{url('media')}}";
      Swal.fire({
        title: 'Do you want to delete permantly the image ?',
        icon: 'question',
        iconHtml: '؟',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        showCancelButton: true,
        showCloseButton: true
      }).then(result => {
        const { isConfirmed } = result;

        if (isConfirmed) {
          $.ajax({
              type: "DELETE",
              url: `${api}/${id}`,
              data: {_token},
              dataType: "json",
              success: function (response) {
                $(`#box-image-${id}`).remove();
                Swal.fire('Delete image success!', '', 'success');
                
              }
          });
        }
      })
    }
    $(document).ready(function () {
      $('#summernote').summernote({
            height: 600
        })
        $('#summernote').summernote('code', '{!!$room->description!!}');
        $('#summernote').summernote('disable');
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
    });
</script>
@endsection