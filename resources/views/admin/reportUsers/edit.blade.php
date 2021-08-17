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
                        <h4 class="card-title">Edit Report User</h4>
                    </div>
                        <div class="card-box">
                            <form action="{{ route('userReportUpdate', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <label for="category" class="col-form-label">Complaints of users</label>
                                    <div class="form-group col-md-12" style="background: red">
                                        @foreach ($usersReport as $report)
                                            <li>{{ $report->message }} by {{ $report->user->name }}</li>
                                        @endforeach
                                    </div>
                                </div>

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
                                        <label for="reason" class="col-form-label">Reason</label>
                                        <input type="text" name="reason" class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}" id="" placeholder="Enter reason">
                                        @if ($errors->has('reason'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('reason') }}</strong>
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
