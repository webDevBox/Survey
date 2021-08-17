@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- general form elements -->
        <div class="card card-info col-md-12 px-0">
          <div class="card-header">
            <h3 class="card-title">Add Banner</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{route('storeBanner')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="Enter Banner Name" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required="">
                            <option value="" selected="" disabled="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" maxlength="300" id="description" style="resize:none"
                            class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3"
                            placeholder="Enter Banner Description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Image <span class="text-danger">*</span> (jpeg,bmp,png,jpg)</label>
                        <input type="file" id="image"
                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                            name="image" required>
                            <img class="d-none" width="100px" id="show_img" src="#" />
                        @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif

                        <img src="" id="banner_display" class="hidden banner-thumbnail-image" />
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-flat">Add</button>
                      </div>
                </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
</div>

@endsection

@section('scripts')
<script>
var OldValueStatus = '{{ old('status') }}';
if(OldValueStatus !== '') {
$('#status').val(OldValueStatus )};

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#show_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        }
    }

$("#image").change(function(){
    readURL(this);
    $('#show_img').removeClass('d-none');
});
</script>

@endsection
