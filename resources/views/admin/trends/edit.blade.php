@extends('layouts.admin')

@section('styles')
    
@endsection

@section('content')
{{-- <div class="content-page"> --}}
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                        <div class="card-header">
                            <h4 class="card-title">Edit Trends</h4>
                        </div>
                        <div class="card-box">
                            <form action="{{ route('trendUpdate', $trend->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-row" id="myModal">
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Add New Trend</label>
                                        <select name="category" id="mySelect2" class="form-control">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{ $category->id == $trend->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="" selected="selected">Select Status</option>
                                            <option value="0" {{($trend->status == '0')?'selected':''}}>InActive</option>
                                            <option value="1" {{($trend->status == '1')?'selected':''}}>Active</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-light" href="{{ route('trendAddCancel') }}">Cancel</a>
                            </form>
                        </div>
                </div>
            </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
<script>
    $('#mySelect2').select2({
        dropdownParent: $('#myModal')
    });
</script>
@endsection
