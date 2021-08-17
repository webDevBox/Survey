@extends('layouts.admin')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > <a href="{{ route('templateCategoryList') }}"> Categories </a> > Edit</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Template Category</h4>
                    </div>
                    <div class="card-box">
                            <form action="{{ route('templateCategoryUpdate', $templateCategory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $templateCategory->name }}" id="" placeholder="Enter Category">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="selection_type" class="col-form-label">Selection Type<span class="text-danger">*</span></label>
                                        <select id="" name="selection_type" class="form-control {{ $errors->has('selection_type') ? ' is-invalid' : '' }}" >
                                            <option value="" disabled >-- Select type --</option>
                                            <option  {{ $templateCategory->selection_type == "single" ? 'selected' : '' }}>single</option>
                                            <option  {{ $templateCategory->selection_type == "multiple" ? 'selected' : '' }}>multiple</option>
                                            <option  {{ $templateCategory->selection_type == "emoji" ? 'selected' : '' }}>emoji</option>

                                        </select>
                                        @if ($errors->has('selection_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('selection_type') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
