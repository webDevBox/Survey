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
                        <h4 class="card-title">Edit Categories</h4>
                    </div>
                    <div class="card-box">
                            <form action="{{ route('categoryUpdate', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $category->name }}" id="" placeholder="Enter Category">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status" class="col-form-label">Status</label>
                                        <select id="" name="status" class="form-control" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>InActive</option>
                                        </select>
                                    </div>
                                    

                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-light" href="{{ route('categoryUpdateCancel') }}">Cancel</a>
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
