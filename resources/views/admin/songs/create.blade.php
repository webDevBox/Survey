@extends('layouts.admin')

@section('styles')

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add New Song</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('songsStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="song name" class="col-form-label">Song Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" value="{{ old('name') }}"  placeholder="Name" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6" id="myModal">
                                        <label for="category" class="col-form-label">Select Category<span class="text-danger">*</span></label>
                                        <select id="mySelect2" name="category" class="form-control" required>
                                            <option value="" selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="album name" class="col-form-label">Album Name<span class="text-danger">*</span></label>
                                        <input type="text" name="album_name" class="form-control {{ $errors->has('album_name') ? ' is-invalid' : '' }}" id="" value="{{ old('album_name') }}" placeholder="Album Name" required>
                                        @if ($errors->has('album_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('album_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6" >
                                        <label for="category"  class="col-form-label">Is Favroite<span class="text-danger">*</span></label>
                                        <select name="favroite" class="form-control" required>
                                            <option value="" selected>Select Favroite</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="album name" class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select id="" name="status" class="form-control" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" >Active</option>
                                            <option value="0" >InActive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <p class="col-form-label">Upload Thumbnail(JPG, JPEG, PNG 100*100)<span class="text-danger">*</span></p>
                                        <input type="file" name="thumbnail"  class="form-control {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}"></label></span>
                                        @if ($errors->has('thumbnail'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('thumbnail') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <p class="col-form-label">Upload Song(mp3)<span class="text-danger ">*</span></p>
                                        <input type="file" name="song"  class="form-control {{ $errors->has('song') ? ' is-invalid' : '' }}" ></label></span>
                                        @if($errors->has('song'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('song') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-light" href="{{ route('songsAddClearFilter') }}">Cancel</a>
                            </form>
                            
                            
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
            });
        } );
    </script>

    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#myModal')
        });
    </script>
@endsection
