@extends('layouts.admin')

@section('styles')

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Song</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('songsUpdate', $song->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="song name" class="col-form-label">Song Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" value="{{ $song->name }}" placeholder="{{ $song->name }}" required>
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
                                                <option value="{{$category->id}}" {{ $category->id == $song->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="album name" class="col-form-label">Album Name<span class="text-danger">*</span></label>
                                        <input type="text" name="album_name" class="form-control {{ $errors->has('album_name') ? ' is-invalid' : '' }}" id="" value="{{ $song->album_name }}" placeholder="{{ $song->album_name }}" required>
                                        @if ($errors->has('album_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('album_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Is Favroite<span class="text-danger">*</span></label>
                                        <select id="" name="favroite" class="form-control" required>
                                            <option value="" selected>Select Favroite</option>
                                            <option value="0" {{($song->is_favourite == '0')?'selected':''}}>No</option>
                                            <option value="1" {{($song->is_favourite == '1')?'selected':''}}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="" selected="selected">Select Status</option>
                                            <option value="0" {{($song->status == '0')?'selected':''}}>InActive</option>
                                            <option value="1" {{($song->status == '1')?'selected':''}}>Active</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-light" href="{{ route('songsUpdateClearFilter') }}">Cancel</a>
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
