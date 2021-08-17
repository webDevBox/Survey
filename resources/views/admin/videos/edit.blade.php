@extends('layouts.admin')

@section('styles')

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Video</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('updateVideo', $video->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="status" class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="" selected="selected">Select Status</option>
                                            <option value="0" {{($video->status == '0')?'selected':''}}>InActive</option>
                                            <option value="1" {{($video->status == '1')?'selected':''}}>Active</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="allow_comments" class="col-form-label">Allow Comments<span class="text-danger">*</span></label>
                                        <select name="allow_comments" class="form-control">
                                            <option value="" selected="selected">Select Allow Comments</option>
                                            <option value="0" {{($video->allow_comments == '0')?'selected':''}}>No</option>
                                            <option value="1" {{($video->allow_comments == '1')?'selected':''}}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="privacy" class="col-form-label">Privacy<span class="text-danger">*</span></label>
                                        <select name="privacy" class="form-control">
                                            <option value="" selected="selected">Select Privacy</option>
                                            <option value="0" {{($video->privacy == '0')?'selected':''}}>No</option>
                                            <option value="1" {{($video->privacy == '1')?'selected':''}}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="allow_duet_and_read" class="col-form-label">Allow Duet and Read<span class="text-danger">*</span></label>
                                        <select name="allow_duet_and_read" class="form-control">
                                            <option value="" selected="selected">Select Allow Duet and Read</option>
                                            <option value="0" {{($video->allow_duet_and_read == '0')?'selected':''}}>No</option>
                                            <option value="1" {{($video->allow_duet_and_read == '1')?'selected':''}}>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-light" href="{{ route('updateCancelVideo') }}">Cancel</a>
                            </form>
                            
                            
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
            });
        } );
    </script>
    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#myModal')
        });
    </script>
@endsection
