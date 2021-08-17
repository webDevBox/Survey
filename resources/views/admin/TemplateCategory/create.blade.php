@extends('layouts.admin')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Create Category</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Template Categories</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Template Category</h4>

                            <form action="{{ route('templateCategoryStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                   
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Category" value="{{old('name')}}">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="selection_type" class="col-form-label">Selection Type <span class="text-danger">*</span></label>
                                        <select id="" name="selection_type" class="form-control {{ $errors->has('selection_type') ? ' is-invalid' : '' }}" >
                                            <option value="" disabled selected>-- Select type --</option>
                                            <option>single</option>
                                            <option>multiple</option>
                                            <option>emoji</option>

                                        </select>
                                        @if ($errors->has('selection_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('selection_type') }}</strong>
                                        </span>
                                    @endif
                                    </div>   
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>                   
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
