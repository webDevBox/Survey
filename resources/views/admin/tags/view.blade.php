@extends('layouts.admin')

@section('styles')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">User Details</h4>
                    </div>
                    <div class="card-box">
                        {{--  <p class="text-muted font-14 m-b-30">
                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                        </p>  --}}
                        <div class="card-box">
                            {{-- <h4 class="m-t-0 header-title">Add new Song</h4> --}}

                            <div class="form-row">
                                {{-- <label for="" class="col-form-label">Profile Image</label><br> --}}
                                <div>
                                    @if (isset($user->profile_image))
                                        <img src="{{ asset('storage/app/'.$user->profile_image) }}" class="rounded-circle"  width="128" height="128">
                                    @else
                                        <img src="{{ URL::asset("theme/assets/images/avatar.jpg") }}" width="128" height="128">
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                <label for="" class="col-form-label">Name: {{ $user->name }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">username: {{ $user->username }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">Email: {{ $user->email }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">Phone: {{ $user->phone }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">Date of Birth: {{ $user->date_of_birth }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">Created at: {{ $user->created_at }}</label>
                            </div>
                            <div class="form-row">
                                <label for="" class="col-form-label">Update at: {{ $user->update_at }}</label>
                            </div> --}}
                            
                            <div class="form-row">
                                <table class="table table-bordered table-striped">

                                    <tr>
                                        <th>Name</th>
                                        <td>{{$user->name}}</td>
                                    <tr>
                                    <tr>
                                        <th>UserName</th>
                                        <td>{{$user->username}}</td>
                                    <tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$user->email}}</td>
                                    <tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $user->phone }}</td>
                                    <tr>
                                    <tr>
                                        <th>Date of birth</th>
                                        <td>{{ $user->date_of_birth }}</td>
                                    <tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($user->status == 0)
                                                    In-active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                        <tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td>{{ $user->created_at }}</td>
                                    <tr>
                                    <tr>
                                        <th>Updated at</th>
                                        <td>{{ $user->updated_at }}</td>
                                    <tr>
                                    
                
                                </table>
                            </div>
                            <div class="form-row">
                                {{-- <a href="#" class="btn btn-sm btn-icon waves-effect waves-light btn-light">Back</a> --}}
                                <button onclick="goBack()" class="btn btn-sm btn-icon waves-effect waves-light btn-light">Back</button>
                            </div>
                            {{-- <form action="{{ route('songsStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="song name" class="col-form-label">Song Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="" placeholder="Name" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Select Category<span class="text-danger">*</span></label>
                                        <select id="" name="category" class="form-control" required>
                                            <option value="" selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="album name" class="col-form-label">Album Name<span class="text-danger">*</span></label>
                                        <input type="text" name="album_name" class="form-control {{ $errors->has('album_name') ? ' is-invalid' : '' }}" id="" placeholder="Album Name" required>
                                        @if ($errors->has('album_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('album_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category" class="col-form-label">Is Favroite<span class="text-danger">*</span></label>
                                        <select id="" name="favroite" class="form-control" required>
                                            <option value="" selected>Select Favroite</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <p class="col-form-label">Upload Thumbnail(JPG, JPEG, PNG 100*100)<span class="text-danger">*</span></p>
                                        <input type="file" name="thumbnail" required class="form-control"></label></span>
                                        @if ($errors->has('thumbnail'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('thumbnail') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <p class="col-form-label">Upload Song(mp3)<span class="text-danger">*</span></p>
                                        <input type="file" name="song" required class="form-control" ></label></span>
                                        @if ($errors->has('song'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('song') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form> --}}
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
