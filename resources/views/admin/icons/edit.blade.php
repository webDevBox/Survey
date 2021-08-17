@extends('layouts.admin')

@section('styles')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > <a href="{{ route('templateoptionsList') }}"> Template Options </a> > Edit</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Template Options</h4>
                    </div>
                    <div class="card-box">
                            <form action="{{ route('templateoptionsUpdate', $icon->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $icon->name }}" id="" placeholder="Enter Icon Name">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="label" class="col-form-label">Label<span class="text-danger">*</span></label>
                                        <input  type="text" name="label" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}" value="{{ $icon->label }}" id="" placeholder="Enter Label">
                                        @if ($errors->has('label'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="templateName" class="col-form-label">Template Options <span class="text-danger">*</span></label>
                                        <select id="" name="templateName" class="form-control {{ $errors->has('templateName') ? ' is-invalid' : '' }}"  >
                                            <option value="" disabled >-- Select type --</option>
                                            @foreach ($templates as $template)
                                           @if($template->id == $icon->template_id)
                                           <option value="{{$template->id}}" selected>{{$template->name}}
                                           </option>
                                           @else
                                           <option value="{{$template->id}}">{{$template->name}}
                                           </option>
                                           @endif
                                        @endforeach
                                        </select>
                                        @if ($errors->has('templateName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('templateName') }}</strong>
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
