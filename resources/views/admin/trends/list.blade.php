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
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Trend List</h4>
                    </div>
                    <div class="card-box table-responsive">
                        <table id="trendListTable" class="table table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        
                            <thead>
                            <tr>
                                <th>Sr.#</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($trends as $trend)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $trend->category->name }}</td>
                                        <td>
                                            @if ($trend->status == 0)
                                                In-active
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <td style="width: 95px;">
                                            
                                            <a href="{{ route('trendEdit', $trend->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning "><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="ml-3">
                            {{$trends->links()}}
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
            $('#trendListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [3] },
                ],
                "bPaginate": false,
                "bFilter": false,
            });
        } );
    </script>
@endsection
