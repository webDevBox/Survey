@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > <a href="{{ route('deviceList') }}">Devices</a> > Edit</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Device</h4>
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
                            <form action="{{ route('deviceUpdate', $device->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $device->name }}" id="" placeholder="Enter Device Name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="location_name" class="col-form-label">Location <span class="text-danger">*</span></label>
                                        <select id="" name="location_name" class="form-control"  >
                                            <option value="" disabled selected>-- Select type --</option>
                                            @foreach ($locations as $location)
                                           @if($device->location_id == $location->id)
                                           <option value="{{$location->id}}" selected>{{$location->name}}

                                           @else
                                           <option value="{{$location->id}}">{{$location->name}}
                                           @endif
                                        @endforeach
                                        </select>
                                        @if ($errors->has('location_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location_name') }}</strong>
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
