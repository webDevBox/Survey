@extends('layouts.company')
@section('styles')


@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > By-Location </li>
@endsection
@section('content')

<!-- Start Page content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h4 class="card-title">Location Based Response Report </h4>
                </div>
                <div class="card-box">
                    <table class="table table-bordered table-striped dt-responsive data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Response No.</th>
                                <th>Date</th>
                                <th width="100px">Action</th>
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
            order: [ 0, "desc" ],
            ajax: "{{ route('company.survey.feedbacks.by-location', [request()->route('surveyId'), request()->route('locationId')]) }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection