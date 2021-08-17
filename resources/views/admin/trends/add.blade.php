@extends('layouts.admin')

@section('styles')
    
@endsection

@section('content')
{{-- <div class="content-page"> --}}
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add Trend</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('trendStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6" id="myModal">
                                        <label for="category" class="col-form-label">Add New Trend</label>
                                        <select class="form-control " name="category" id="mySelect2">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-light" href="{{ route('trendAddCancel') }}">Cancel</a>
                            </form>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#myModal')
        });
    </script>
@endsection
