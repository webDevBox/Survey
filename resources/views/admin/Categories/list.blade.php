@extends('layouts.admin')

@section('styles')
    {{--  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Categories</li>
@endsection
@section('content')
{{-- <div class="content-page"> --}}

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h4 class="card-title">Category Filters</h4>
                    </div>
                    <div class="card-box">
                        <form action="{{ route('categoriesFilter') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="row ">
                                <div class="form-group col-md-3 ">
                                    <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{isset($filter)?$filter->name:''}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <select name="status" class="form-control">
                                        <option value="" selected="selected">Select Status</option>
                                        <option value="0" {{isset($filter)?($filter->status == '0')?'selected':'':''}}>InActive</option>
                                        <option value="1" {{isset($filter)?($filter->status == '1')?'selected':'':''}}>Active</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a class="btn btn-light ml-2" href="{{ route('categoriesClearFilter') }}">Clear</a>
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
                        <h4 class="card-title">Category List</h4>
                    </div>
                    <div class="card-box">
                            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <table id="songsListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($category->status == 0)
                                                    In-active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td style="width: 180px;">{{ $category->created_at }}</td>
                                            <td style="width: 120px;">{{ $category->updated_at }}</td>

                                            <td style="width: 95px;">
                                                <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning "><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-3">
                                @if (isset($filter))
                                    {{$categories->appends(['request' => $filter])->links()}}
                                @else
                                    {{$categories->links()}}
                                @endif
                            </div>
                        </div>
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
                { "orderable": false, "targets": [5] },
                ],
                "bPaginate": false,
                "bFilter": false,
            });
        } );
    </script>
@endsection
