@extends('layouts.admin')

@section('styles')

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Song Filters</h4>
                    </div>
                    <div class="card-box">
                        <form action="{{ route('songsFilter') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="row ">
                                <div class="form-group col-md-3 ">
                                    <input type="text" name="songname" class="form-control" placeholder="Song name" value="{{isset($filter)?$filter->songname:''}}">
                                </div>
                                <div class="form-group col-md-3" id="myModal">
                                    <select name="category_id" class="form-control" id="mySelect2">
                                        <option value="" selected="selected">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{isset($filter)?($filter->category_id == $category->id)?'selected':'':''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 ">
                                    <input type="text" name="albumname" class="form-control" placeholder="Album name" value="{{isset($filter)?$filter->albumname:''}}">
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
                                    <a class="btn btn-light ml-2" href="{{ route('songsClearFilter') }}">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Songs List</h4>
                    </div>
                    <div class="card-box">
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <table id="songsListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Song Name</th>
                                    <th>Category</th>
                                    <th>Album Name</th>
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
                                    @foreach ($songs as $song)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $song->name }}</td>
                                            <td>{{ $song->category->name }}</td>
                                            <td>{{ $song->album_name }}</td>
                                            <td>
                                                @if ($song->status == 0)
                                                    In-active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/app/'.$song->thumbnail_url) }}"  height="50" width="50">
                                            </td>
                                            <td>
                                                <audio controls>
                                                    <source src="{{ asset('storage/app/'.$song->song_url) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </td>
                                            <td style="width: 5%;">
                                                <a href="{{ route('songsEdit', $song->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-3">
                                @if (isset($filter))
                                    {{$songs->appends(['request' => $filter])->links()}}
                                @else
                                    {{$songs->links()}}
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
                { "orderable": false, "targets": [5,6,7] },
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
