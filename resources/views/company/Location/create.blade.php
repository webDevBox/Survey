@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Create Outlets</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Outlets</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Outlet</h4>

                            <form action="{{ route('locationStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                   
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Location" @if(session()->has('request')) value="{{ session()->pull('request') }}" @endif required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                        <select id="" name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                            <option value="" disabled selected>-- Select type --</option>
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
                                        <label for="Description" class="col-form-label">Description</label>
                                        <input  type="text" name="Description" class="form-control {{ $errors->has('Description') ? ' is-invalid' : '' }}" id="" placeholder="Enter Description" @if(session()->has('Description')) value="{{ session()->pull('Description') }}" @endif>
                                        @if ($errors->has('Description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('Description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="tags" class="col-form-label">Tags </label>
                                        <input  type="text" name="tags" class="form-control {{ $errors->has('tags') ? ' is-invalid' : '' }}" id="" placeholder="Enter Tags" @if(session()->has('tags')) value="{{ session()->pull('tags') }}" @endif>
                                        @if ($errors->has('tags'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tags') }}</strong>
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
