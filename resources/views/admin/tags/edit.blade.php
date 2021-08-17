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
                        <h4 class="card-title">Edit Tag</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('TagsUpdate', $tag->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Status</label>
                                        <select id="" name="status" class="form-control" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" {{ $tag->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $tag->status == 0 ? 'selected' : '' }}>InActive</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-light" href="{{ route('TagsUpdateCancel') }}">Cancel</a>
                            </form>


                        </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')

@endsection
