@extends('layouts.company')

@section('styles')
<style>
    #imageUpload
{
    display: none;
}

#profileImage
{
    cursor: pointer;
}

#profile-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
}

#profile-container img {
    width: 150px;
    height: 150px;
}
    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Edit Profile </li>
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
                        <h4 class="card-title">Edit Company Profile</h4>
                    </div>
                    <div class="card-box">
                            <form action="{{ route('update-companyProfile', $company->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">                                   
                                    <div class="form-group col-md-12">
                                        <div id="profile-container">
                                            <img id="profileImage" src="{{ asset('images/'.$company->logo) }}" />
                                         </div>
                                         <input id="imageUpload" type="file" max="2048" 
                                                name="logo" placeholder="Photo" class="form-control {{ $errors->has('logo') ? ' is-invalid' : '' }}" capture>   
                                                @if ($errors->has('logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif  
                                    </div>
                                </div>
                               
                                <div class="form-row">                                  
                                    <div class="form-group col-lg-6">
                                        <label>New Password </label>
                                        <input  type="password" class="form-control @error('password') is-invalid @enderror" value="" id="password" placeholder="Enter new Password"  name="password" autocomplete="new-password">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                
                                    <div class="form-group col-lg-6">
                                        <label>New Password confirmation </label>
                                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="Enter confirm Password" autocomplete="new-password" value=""  >
                
                                        @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $company->name }}" id="">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif         
                                    </div>   
                                    <div class="form-group col-md-6">
                                        <label for="contact_person_name" class="col-form-label">Contact Person Name</label>
                                        <input  type="text" name="contact_person_name" class="form-control {{ $errors->has('contact_person_name') ? ' is-invalid' : '' }}" value="{{ $company->contact_person_name }}" id="">
                                        @if ($errors->has('contact_person_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_person_name') }}</strong>
                                        </span>
                                    @endif         
                                    </div>  
                                    <div class="form-group col-md-6">
                                        <label for="contact_person_phone" class="col-form-label">Contact Person Phone</label>
                                        <input  type="text" name="contact_person_phone" class="form-control {{ $errors->has('contact_person_phone') ? ' is-invalid' : '' }}" value="{{ $company->contact_person_phone }}" id="">
                                        @if ($errors->has('contact_person_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_person_phone') }}</strong>
                                        </span>
                                    @endif         
                                    </div>                           
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#profileImage').attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
}

$("#imageUpload").change(function(event){
    const target = event.target
    if (target.files && target.files[0]) {

      /*Maximum allowed size in bytes
        5MB Example
        Change first operand(multiplier) for your needs*/
      const maxAllowedSize = 2 * 1024 * 1024;
      if (target.files[0].size > maxAllowedSize) {
        // Here you can ask your users to load correct file
        alert('Image size should not be more then 2 MB.');
        target.value = ''
      }else{
        fasterPreview( this );
      }
    }
});


</script>
@endsection
