@extends('layouts.admin')

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > <a href="{{ route('templateList') }}"> Templates </a> > Edit</li>
@endsection

@section('content')
{{-- <div class="content-page"> --}}
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Template</h4>
                    </div>
                    <div class="card-box">
                            <form action="{{ route('templateUpdate', $template->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input  type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $template->name }}" id="" placeholder="Enter Template Name">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif         
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="categoryName" class="col-form-label">Template Category <span class="text-danger">*</span></label>
                                        <select id="" name="categoryName" class="form-control {{ $errors->has('categoryName') ? ' is-invalid' : '' }}" >
                                            <option value="" disabled >-- Select type --</option>
                                            @foreach ($templateCategories as $templateCategory)
                                           @if($templateCategory->id == $template->template_category_id)
                                           <option value="{{$templateCategory->id}}" selected>{{$templateCategory->name}}
                                           </option>
                                           @else
                                           <option value="{{$templateCategory->id}}">{{$templateCategory->name}}
                                           </option>
                                           @endif
                                        @endforeach
                                        </select>

                                        @if ($errors->has('categoryName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('categoryName') }}</strong>
                                        </span>
                                    @endif 
                                    </div>
                                    <div class="form-group col-md-12">
                                        <p class="col-form-label">Upload Template Image<span class="text-danger">*</span></p>
                                        
                                        <input type="file" name="image" class="dropify" data-default-file="/images/{{ $template->imageUrl }}">
                                        @if ($errors->has('image')) <p style="color:red;">{{ $errors->first('image') }}</p> @endif
                                        

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
        var drEvent = $('.dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.filename + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
    });
</script>
@endsection
