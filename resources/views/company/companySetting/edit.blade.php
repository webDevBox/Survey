@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Setting </li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success shower">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->pull('success') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Edit Company Setting</h4>
                    </div>
                    <div class="card-box">
                            <form id="company_form" action="{{ route('update-companySettings', $companySetting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-row">
                                    {{-- <div class="form-group col-md-6">
                                        <label for="bg_color" class="col-form-label">Background Color<span class="text-danger">*</span></label>
                                        <input  type="color" name="bg_color" class="form-control {{ $errors->has('bg_color') ? ' is-invalid' : '' }}" value="{{ $companySetting->bg_color }}" id="">
                                        @if ($errors->has('bg_color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bg_color') }}</strong>
                                        </span>
                                    @endif         
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        <label for="btn_submit_color" class="col-form-label">Outlet Name Color<span class="text-danger">*</span></label>
                                        <input  type="color" name="btn_submit_color" class="form-control {{ $errors->has('btn_submit_color') ? ' is-invalid' : '' }}" value="{{ $companySetting->btn_submit_color }}" id="">
                                        @if ($errors->has('btn_submit_color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('btn_submit_color') }}</strong>
                                        </span>
                                    @endif         
                                    </div>

                                    {{-- <div class="form-group col-md-6">
                                        <label for="btn_cancel_color" class="col-form-label">Cancel Button Color<span class="text-danger">*</span></label>
                                        <input  type="color" name="btn_cancel_color" class="form-control {{ $errors->has('btn_cancel_color') ? ' is-invalid' : '' }}" value="{{ $companySetting->btn_cancel_color }}" id="">
                                        @if ($errors->has('btn_cancel_color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('btn_cancel_color') }}</strong>
                                        </span>
                                    @endif         
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        <label for="qr_code_title" class="col-form-label">Qr Code Title<span class="text-danger">*</span></label>
                                        <input  type="text" name="qr_code_title" class="form-control {{ $errors->has('qr_code_title') ? ' is-invalid' : '' }}" value="{{ $companySetting->qr_title }}" id="" maxlength="100">
                                        @if ($errors->has('qr_code_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('qr_code_title') }}</strong>
                                        </span>
                                    @endif         
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="timezone" class="col-form-label">Timezone<span class="text-danger">*</span></label>
                                        {!! $timezone_select !!}      
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="backgroun_image" class="col-form-label">Upload Background Image</label>
                                        
                                        <input type="hidden" name="removeFile" value="false" id="removeFile">
                                        <input type="file" name="backgroun_image" class="dropify {{ $errors->has('backgroun_image') ? 'is-invalid' : '' }}" data-default-file="{{ asset('images/company/'.$companySetting->bg_image) }}" id="backgroun_image">
                                        @if ($errors->has('backgroun_image'))
                                            <div class="invalid-feedback" style="display: block !important;" role="alert">
                                                <strong>{{ $errors->first('backgroun_image') }}</strong>
                                            </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

        // Used events
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            $('#removeFile').val('true');
        });
    });
</script>

<script>

$("#company_form").submit(function(e){
    
    if(document.getElementById("backgroun_image").files.length > 0 ){
        var remove = $('#removeFile').val('false');
    }
});
</script>

@endsection
