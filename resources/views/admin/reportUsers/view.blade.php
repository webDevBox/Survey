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
                            
                            
                            
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">User video and song stats</h4>
                    </div>
                    <div class="card-box">
                        
                        <div class="card-box">
                            
                            <ul class="nav nav-pills navtab-bg nav-justified pull-in ">
                                <li class="nav-item">
                                    <a href="#favorites" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class=" mr-2"></i> Favorite
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#liked" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class=" mr-2"></i>Liked
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#shared" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class=" mr-2"></i> shared
                                    </a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="favorites">
                                    <table id="favoriteListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        
                                        <thead>
                                        <tr>
                                            <th>Sr.#</th>
                                            <th>Song name</th>
                                            <th>Status</th>
                                            <th>Preview</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($userFavoriteSongs as $fav)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $fav->name }}</td>
                                                    <td>
                                                        @if ($fav->status == 0)
                                                            In-active
                                                        @else
                                                            Active
                                                        @endif
                                                    </td>
                                                    <td style="width: 95px;">
                                                        <button type="button" id="{{ $fav->id }}" onClick="show_song_preview(this.id)" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></button>

                                                        {{-- <a href="{{ route('userView', $fav->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="liked">
                                    <table id="likedListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        
                                        <thead>
                                        <tr>
                                            <th>Sr.#</th>
                                            <th>Video description</th>
                                            <th>Status</th>
                                            <th>Preview</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($userLikedVideos as $like)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $like->description }}</td>
                                                    <td>
                                                        @if ($like->status == 0)
                                                            In-active
                                                        @else
                                                            Active
                                                        @endif
                                                    </td>
                                                    <td style="width: 95px;">
                                                        <button type="button" id="{{ $like->id }}" onClick="show_video_preview(this.id)" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="shared">
                                    <table id="shareListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        
                                        <thead>
                                        <tr>
                                            <th>Sr.#</th>
                                            <th>Video description</th>
                                            <th>Status</th>
                                            <th>Preview</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($userSharedVideos as $share)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $share->description }}</td>
                                                    <td>
                                                        @if ($share->status == 0)
                                                            In-active
                                                        @else
                                                            Active
                                                        @endif
                                                    </td>
                                                    <td style="width: 95px;">
                                                        <button type="button" id="{{ $like->id }}" onClick="show_video_preview(this.id)" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></button>
                                                        {{--  <a type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</a>  --}}
                                                        {{-- <a href="{{ route('userView', $share->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal content -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="SongPreviewModal" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="modalTitle">Song Preview</h4>
                    </div>
                    <div class="modal-body" id="ModalBody">
                        <audio controls>
                            <source src="" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    <!-- /.modal -->
@endsection

@section('scripts')
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#favoriteListTable, #likedListTable, #shareListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [3] },
                ]
            });
        } );
    </script>
    <script type="text/javascript">
        function show_song_preview(clicked_id)
        {
            if(clicked_id){
                $.ajax({
                   type:"get",
                   url:'{{ url("admin/preview_song") }}' + '/' + clicked_id,
                   success:function(response)
                   {
                        if(response)
                        {
                            var song = response['song_url'];
                            var base_url = '{{ env('MIX_APP_URL') }}';
                            var songURL = base_url+'/storage/app/'+song;
                            
                            $("#SongPreviewModal").modal("show");
                            $("#modalTitle").empty();
                            $("#modalTitle").append('Song Preview');

                            $("#ModalBody").empty();
                            $("#ModalBody").append('<audio controls style="width: 100%;"><source src="'+songURL+'" type="audio/mpeg">Your browser does not support the audio element.</audio>');
                        }
                   }
        
                });
            }
        }
      </script>
      <script type="text/javascript">
        function show_video_preview(clicked_id)
        {
            if(clicked_id){
                $.ajax({
                   type:"get",
                   url:'{{ url("admin/video/preview_video") }}' + '/' + clicked_id,
                   success:function(response)
                   {
                        if(response)
                        {
                            var video = response['video_url'];
                            var base_url = '{{ env('MIX_APP_URL') }}';
                            var videoURL = base_url+'/storage/app/'+video;
                            
                            $("#SongPreviewModal").modal("show");
                            $("#modalTitle").empty();
                            $("#modalTitle").append('Video Preview');
                            
                            $("#ModalBody").empty();
                            $("#ModalBody").append('<video width="100%"  height="auto" controls><source src="'+videoURL+'" type="video/mp4">Your browser does not support the video tag.</video>');
                        }
                   }
        
                });
            }
        }
      </script>
@endsection
