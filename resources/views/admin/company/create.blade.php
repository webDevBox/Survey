@extends('layouts.admin')

@section('styles')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Create Company</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Companies</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Company</h4>
                            <form action="{{ route('store_company') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">                     
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Company Name" value="{{old('name')}}">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input  type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="" placeholder="Enter Email" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
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
