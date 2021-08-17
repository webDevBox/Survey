@extends('layouts.admin')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Create Template Option</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Templates Options</h4>
                    </div>
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Create Template Options</h4>
                            <form action="{{ route('templateoptionsStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                   
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Enter Template Option" value="{{old('name')}}">                                  
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="label" class="col-form-label">label <span class="text-danger">*</span></label>
                                        <input  type="text" name="label" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}" id="" placeholder="Enter label" value="{{old('label')}}">                                  
                                        @if ($errors->has('label'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="templateName" class="col-form-label">Templates<span class="text-danger">*</span></label>
                                        <select id="" name="templateName" class="form-control {{ $errors->has('templateName') ? ' is-invalid' : '' }}">
                                            <option value="" disabled selected>-- Select type --</option>
                                            @foreach ($templates as $template)
                                            <option value="{{$template->id}}">{{$template->name}}
                                            </option>
                                                @endforeach
                                        </select>     
                                        @if ($errors->has('templateName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('templateName') }}</strong>
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
