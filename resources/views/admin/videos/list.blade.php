@extends('layouts.admin')

@section('styles')

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Video Filters</h4>
                    </div>
                    <div class="card-box">
                        <form action="{{ route('VideosFilter') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="row ">
                                <div class="form-group col-md-3 ">
                                    <input type="text" name="username" class="form-control" placeholder="User name" value="{{isset($filter)?$filter->username:''}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="" selected="selected">Select Status</option>
                                        <option value="0" {{isset($filter)?($filter->status == '0')?'selected':'':''}}>InActive</option>
                                        <option value="1" {{isset($filter)?($filter->status == '1')?'selected':'':''}}>Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a class="btn btn-light ml-2" href="{{ route('VideosClearFilter') }}">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Videos List</h4>
                    </div>
                    <div class="card-box">
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table id="songsListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Status</th>
                                    <th>Thumbnail</th>
                                    <th>Preview</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $video->user->name }}</td>
                                            <td>
                                                @if ($video->status == 0)
                                                    In-active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ ('storage/app/'.$video->video_thumbnail) }}"  height="50" width="50">
                                            </td>
                                            <td>
                                                <video width="320" height="240" controls>
                                                    <source src="{{ env('BUCKET_BASE_URL').$video->video_url }}" type="video/mp4">
                                                  Your browser does not support the video tag.
                                                </video>
                                            </td>
                                            <td style="width: 95px;">
                                                <a href="{{ route('viedoView', $video->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('editVideo', $video->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning "><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-3">
                                @if (isset($filter))
                                    {{$videos->appends(['request' => $filter])->links()}}
                                @else
                                    {{$videos->links()}}
                                @endif
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
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [3, 4, 5] },
                ],
                "bPaginate": false,
                "bFilter": false,
            });
        } );
    </script>
    <script>
        $('#mySelect2').select2({
            dropdownParent: $('#myModal')
        });
    </script>
@endsection
