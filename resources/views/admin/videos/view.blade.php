@extends('layouts.admin')

@section('styles')

@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Video Details</h4>
                    </div>
                    <div class="card-box">
                        {{--  <p class="text-muted font-14 m-b-30">
                            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                        </p>  --}}
                        <div class="card-box">
                            <div class="form-row">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Username</th>
                                        <td>{{$video->user->username}}</td>
                                    <tr>
                                    <tr>
                                        <th>Video Song</th>
                                        <td>{{ isset($video->song_id)? $video->song->name : '' }}</td>
                                    <tr>
                                    <tr>
                                        <th>Video Thumbnail</th>
                                        <td><img src="{{ asset('storage/app/'.$video->video_thumbnail) }}"  height="50" width="50"></td>
                                    <tr>
                                    <tr>
                                        <th>Video</th>
                                        <td>
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('storage/app/'.$video->video_url) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </td>
                                    <tr>
                                    <tr>
                                        <th>Video Description</th>
                                        <td>{{ $video->description }}</td>
                                    <tr>
                                    <tr>
                                        <th>Video Status</th>
                                        <td>
                                            {{ ($video->status == '0')?'In-Active':'Active' }}
                                        </td>
                                    <tr>
                                    <tr>
                                        <th>Video privacy</th>
                                        <td>
                                            {{ ($video->privacy == '0')?'No':'Yes' }}
                                        </td>
                                    <tr>
                                    <tr>
                                        <th>Video allow comments</th>
                                        <td>
                                            {{ ($video->allow_comments == '0')?'No':'Yes' }}

                                        </td>
                                    <tr>
                                    <tr>
                                        <th>Video allow duet and read</th>
                                        <td>
                                            {{ ($video->allow_duet_and_read == '0')?'No':'Yes' }}
                                        </td>
                                    <tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td>{{ $video->created_at }}</td>
                                    <tr>
                                    <tr>
                                        <th>Updated at</th>
                                        <td>{{ $video->updated_at }}</td>
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
