@extends('layouts.company')

@section('styles')
<link href="{{ asset('theme/assets/css/custom.css')}}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Outlets</li>
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
                            {{ session()->pull('success') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Outlets List <a href="{{ route('locationCreate') }}"><button type="button" class="btn btn-success waves-light waves-effect pull-right mr-3"><i class="fa fa-plus mr-1"></i>Add Outlet</button></a></h4>
                    </div>
                    <div class="card-box">
                                    <table id="datatable" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th style="width: 95px;">Action</th>
                                </tr>
                                </thead>

                                <tbody>                             
                                    {{-- @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ $location->name }}</td>
                                            <td>
                                                <div class="button r pull-left mr-2" id="button-1" >
                                                  <input type="checkbox" class="checkbox" id="{{$location->id}}" onclick="updateCompanyStatus(this)" {{ ($location->status)?'checked':'' }}>
                                                  <div class="knobs"></div>
                                                  <div class="layer"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </td>
                                      

                                            <td style="width: 95px;">
                                                <a href="{{ route('locationEdit', $location->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Outlet"><i class="fa fa-edit"></i></a>
                                                <span data-toggle="modal" data-target="#myModal_{{$location->id}}"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete Outlet"><i class="far fa-trash-alt"></i></a></span>

                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{-- <div class="row">
                                <x-pagination paginatedObj="{!! json_encode($locations) !!}"  />
                                <div class="col-md-6 text-right">
                                    <div class="pagination-links pull-right mr-3">  {{$locations->links() }}</div>
                                </div>
                                <div class="clearfix"></div>   
                            </div> --}}

                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title text-center" id="myModalLabel"><i class="far fa-trash-alt"></i> Delete</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to Delete ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">No</button>
                                        <a href="" class="final_del" > <button type="button" class="btn btn-danger waves-effect waves-light">Yes</button></a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function updateCompanyStatus(e) {
            let confirmText  = 'Do you really want to change the status?';
            let outletId = $(e).attr('id');
            if (confirm(confirmText)) {
                let status = 0;
                if ($(e).prop('checked')) {
                    status = 1;
                }

                let base_url = window.location.origin;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    data: {status: status},
                    url:base_url+'/company/location/active-inactive/'+outletId+'',
                    success:function(data){
                        let response =data;
                        console.log(response)
                        
                    }
                });
            }
            else{
                if ($(e).prop('checked')) {
                    $('#'+outletId).prop('checked', false);
                }
                else{
                    $('#'+outletId).prop('checked', true);
                }
                
            }
        }
    </script>

<script>
    $(function () {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: "{{ route('LocationList') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'status', status: 'status'},
            {data: 'action', action: 'action', 'orderable': false},
        ]
    });
});
</script>

<script>
    function myFunction(id) {
        var list = document.getElementsByClassName("final_del")[0];
        list.href='remove/'+id;
    }
</script>

@endsection
