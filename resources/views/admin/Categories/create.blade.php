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
                        <h4 class="card-title">Categories</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Category</h4>

                            <form action="{{ route('categoryStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                   
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Category">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                        <select id="" name="status" class="form-control" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" >Active</option>
                                            <option value="0" >InActive</option>
                                        </select>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                                <a class="btn btn-light" href="{{ route('categoryCreateCancel') }}">Cancel</a>
                            </form>


                        </div>
                    
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')

@endsection
