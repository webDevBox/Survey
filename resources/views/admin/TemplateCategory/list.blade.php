@extends('layouts.admin')

@section('styles')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Categories</li>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">        
            </div>
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
                        <h4 class="card-title">Template Category List <a href="{{ route('templateCategoryCreate') }}"><button type="button" class="btn btn-success waves-light waves-effect pull-right mr-3"><i class="fa fa-plus mr-1"></i> Add Category</button></a></h4>
                    </div>
                    <div class="card-box">                           
                                    <table id="datatable" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Selection Type</th>
                                    <th style="width: 95px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($templateCategories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->selection_type }}</td>
                                            <td style="width: 95px;">
                                                <a href="{{ route('templateCategoryEdit', $category->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>
                                                <span data-toggle="modal" data-target="#myModal_{{$category->id}}"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a></span>
                                            </td>
                                        </tr> --}}
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                            {{-- <div class="row">
                                <x-pagination paginatedObj="{!! json_encode($templateCategories) !!}"  />
                                <div class="col-md-6 text-right">
                                    <div class="pagination-links pull-right mr-3">  {{$templateCategories->links() }}</div>
                                </div>
                                <div class="clearfix"></div>   
                            </div> --}}
                            {{-- Modal for Delete  --}}
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
                            {{-- <a href="{{ route('templateCategoryRemove', $category->id) }}" class="final_del" > <button type="button" class="btn btn-danger waves-effect waves-light">Yes</button></a> --}}
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
<script>
    $(function () {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: "{{ route('templateCategoryList') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'selection', selection: 'selection'},
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
