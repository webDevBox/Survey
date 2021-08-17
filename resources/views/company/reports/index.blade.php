@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Reports </li>
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h4 class="card-title">Reports Overall</h4>
                </div>
                <div class="card-box">
                        <table class="table table-bordered table-striped dt-responsive data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Survey Name</th>
                                    <th>Total Devices</th>
                                    <th>Last Feedback At</th>
                                    <th width="200px" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div> <!-- content -->
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ route('company.reports') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'total_devices', name: 'total_devices'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        table.$('tr').tooltip( {
            placement : '',
            html : true
        }); 
    });
</script>
@endsection
