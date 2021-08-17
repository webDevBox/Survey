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
                        <h4 class="card-title">Edit User</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('userUpdate', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Status</label>
                                        <select id="" name="status" class="form-control" required>
                                            <option value="" disabled>Select Status</option>
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password" class="col-form-label">New Password</label>
                                        <input type="text" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="" placeholder="Enter New Password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                {{-- <a class="btn btn-light" href="{{ route('userUpdateCancel') }}">Cancel</a> --}}
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
