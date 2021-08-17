@extends('layouts.admin')

@section('styles')
    {{--  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}
@endsection

@section('content')
{{-- <div class="content-page"> --}}
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Tags Filter</h4>
                    </div>

                    <div class="card-box">
                        
                        <form action="{{ route('TagsFilter') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="row ">
                                <div class="form-group col-md-3 ">
                                    <input type="text" name="username" class="form-control" placeholder="Tag Name" value="{{isset($filter)?$filter->username:''}}">
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
                                    <a class="btn btn-light ml-2" href="{{ route('TagsClearFilter') }}">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title">Tags List</h4>
                    </div>

                    <div class="card-box table-responsive">
                            <table id="songsListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Tag name</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>
                                                @if ($tag->status == 0)
                                                    In-active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>
                                                {{ $tag->created_at }}
                                            </td>
                                            <td style="width: 95px;">
                                                {{-- <a href="{{ route('userView', $user->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-primary"><i class="fa fa-eye"></i></a> --}}
                                                <a href="{{ route('TagsEdit', $tag->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning "><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-3">
                                @if (isset($filter))
                                    {{$tags->appends(['request' => $filter])->links()}}
                                @else
                                    {{$tags->links()}}
                                @endif
                            </div>
                        {{--  </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [4] },
                ],
                "bPaginate": false,
                "bFilter": false,
            });
        } );
    </script>
    <script>
        //date picker at ticket listing in filters at created.
        //==============================================
        jQuery('#datepicker').datepicker({
            format: "mm/dd/yyyy",
            clearBtn: true,
        //  multidate: true,
            multidateSeparator: ","
        });
        //=============================================
    </script>
@endsection
