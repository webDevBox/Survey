@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > <a href="{{ route('LocationList') }}">Outlets</a> > Edit</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Outlets</h4>
                        @if(session()->has('success'))
                        <div class="alert alert-success shower">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->pull('success') }}
                        </div>
                    @endif
                    </div>
                    <div class="card-box">
                            <form action="{{ route('locationUpdate', $location->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $location->name }}" id="" placeholder="Enter Location">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status" class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select id="" name="status" class="form-control" >
                                            <option value="" disabled selected>-- Select type --</option>
                                            <option value="1" {{ $location->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $location->status == 0 ? 'selected' : '' }}>InActive</option>
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
                                        <input  type="text" name="Description" class="form-control {{ $errors->has('Description') ? ' is-invalid' : '' }}" value="{{ $location->Description }}" id="" placeholder="Enter Description">
                                        @if ($errors->has('Description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('Description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tags" class="col-form-label">tags</label>
                                        <input  type="text" name="tags" class="form-control {{ $errors->has('tags') ? ' is-invalid' : '' }}" value="{{ $location->tags }}" id="" placeholder="Enter tags">
                                        @if ($errors->has('tags'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tags') }}</strong>
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
