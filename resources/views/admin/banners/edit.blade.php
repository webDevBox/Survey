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
            <h3 class="card-title">Edit Banner</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{route('updateBanner')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Banner Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="Enter Banner Name" value="{{ old('name', $banner->name) }}" required>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="status"
                            class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                            <option value="" disabled>Select Status</option>
                            <option @if($banner->status == 1) selected @endif value="1">Active</option>
                            <option @if($banner->status == 0) selected @endif value="0">In-Active</option>
                        </select>
                        @error('status')
                            <div class=""><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" maxlength="300" id="description" style="resize:none"
                            class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3"
                            placeholder="Enter Banner Description"
                            required>{{ $banner->description }}</textarea>
                        @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Image </label>
                        <input type="file" id="image_url"
                            class="form-control {{ $errors->has('image_url') ? ' is-invalid' : '' }}"
                            name="image_url">
                        @if ($errors->has('image_url'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image_url') }}</strong>
                        </span>
                        @endif

                        @if($banner->image_url != null && Storage::exists($banner->image_url))
                        <img id="banner_display" src="{{ asset('storage/app/'.$banner->image_url) }}" height="50" width="50"
                            class="banner-thumbnail-image" />
                        @else
                            <img id="banner_display" src="" class="banner-thumbnail-image">
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="banner_id" value="{{$banner->id}}">
                        <button type="submit" class="btn btn-info btn-flat">Update</button>
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
</script>
@endsection
