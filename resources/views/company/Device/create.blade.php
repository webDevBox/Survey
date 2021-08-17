@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Create Devices</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Devices</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Device</h4>

                            <form action="{{ route('deviceStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                   
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Device Name" @if(session()->has('request')) value="{{ session()->pull('request') }}" @endif required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="location_name" class="col-form-label">Location <span class="text-danger">*</span></label>
                                        <select id="" name="location_name" class="form-control {{ $errors->has('location_name') ? ' is-invalid' : '' }}" required>
                                            <option value="" disabled selected>-- Select type --</option>
                                            @foreach ($loctions as $location)
                                            <option value="{{$location->id}}">{{$location->name}}
                                                @endforeach
                                        </select>
                                        @if ($errors->has('location_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('location_name') }}</strong>
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
