@extends('layouts.admin')

@section('styles')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Companies</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success shower">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Company List <a href="{{ route('create_company') }}"><button type="button" class="btn btn-success waves-light waves-effect pull-right mr-3"><i class="fa fa-plus mr-1"></i>Add Company</button></a></h4>
                    </div>
                    <div class="card-box">
                            <table id="datatable" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Active</th>
                                    <th>Verified</th>
                                    <th style="width: 120px;">Visit Dashboard</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>                          
                                    {{-- @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
                                            <td>{{ ($company->status)?"Yes":"No" }}</td>
                                            <td>{{ (!is_null($company->email_verified_at))?"Yes":"No" }}</td>
                                            <td>
                                                <a href="{{ route('companyDashboard', $company->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" target="_blank">Login</a>
                                            </td> --}}
                                               
                                            {{-- <td style="width: 95px;">
                                                <a href="#" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Device"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a>
                                            </td> --}}
                                        {{-- </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{-- <div class="row">
                            <x-pagination paginatedObj="{!! json_encode($companies) !!}"  />
                            <div class="col-md-6 text-right">
                                <div class="pagination-links pull-right mr-3">  {{$companies->links() }}</div>
                            </div>
                            <div class="clearfix"></div>   
                        </div> --}}
                    </div>
                    </div>
                </div>              
            </div>
        </div>
    </div>

{{-- Sweet Alert for Delete --}}
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
                <h6>Text in a modal</h6>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                <hr>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('scripts')
<script>
    $(function () {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: "{{ route('company-list') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', email: 'email'},
            {data: 'status', status: 'status'},
            {data: 'verified', verified: 'verified'},
            {data: 'action', action: 'action', 'orderable': false},
        ]
    });
});
</script>
@endsection
