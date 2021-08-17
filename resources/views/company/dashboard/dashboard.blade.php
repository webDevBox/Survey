@extends('layouts.company')

@section('styles')
<!-- Date Picker -->
<link href="{{ asset('theme/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<style>
    .badge {
        border-radius: 0.25rem !important;
    }
</style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard </li>
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-row-reverse">
                <!-- Date Picker -->
                 <div class="form-group ml-2">
                    <div class="btn-group">
                        <button type="button" id="btnFilter" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" id="reportrange" class="form-control"/>
                </div>
               
            </div>
        </div>
        <!-- Call overall Report Component -->
        <x-overall overallReports="{!! json_encode($overallReports) !!}"  />
    </div> <!-- content -->
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/qbReportDashboard.js') }}"></script>
<!-- Date Picker -->
<script src="{{ asset('theme/plugins/moment/moment.js')}}"></script>
<script src="{{ asset('theme/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('assets/js/datepickerConf.js') }}"></script>

<script type="text/javascript">
    $('#btnFilter').on('click', function(){
        let base_url = window.location.origin;
        let dateArr = $('#reportrange').val().split(' - ');

        let from = dateArr[0];
        let to   = dateArr[1];

        window.location.href = base_url+'/company/dashboard?from='+from+'&to='+to;
    })
</script>

<script type="text/javascript">
    $('.mulOpt').parent().parent().removeClass('row d-flex');
    $('.mulOpt').parent().removeClass('ml-3');
</script>
@endsection
