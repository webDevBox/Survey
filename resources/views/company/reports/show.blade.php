@extends('layouts.company')

@section('styles')
<style type="text/css">
	.select2-container .select2-selection--single {
		background: #CACFD2;
	}

	.select2-container .select2-selection--single .select2-selection__arrow b

	{
		border-color:#222 transparent transparent transparent;
	}

	.select2-container--open .select2-selection--single .select2-selection__arrow b
	{
		border-color:#222 transparent transparent transparent !important;
	}

</style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > <a href="{{ route('company.reports') }}"> Reports </a> > Show </li>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{--dd($reportData)--}}
                        <h2>{{ $reportData['survey']->name }}</h2>
                        <h4>Overall Responses ({{$reportData['overallResponses']}})</h4>
                        <h4>{{ $reportData['fromDate'] }} - {{ $reportData['toDate'] }}</h4>
                        <!-- <h4>December 1, 2020 - December 31, 2020. <span class="text-muted">Compared to: November 1, 2020 - November 30, 2020.</span></h4> -->
                        <input type="hidden" value="{{$reportData['type']}}" id="routeType">
                        <input type="hidden" name="surveyId" value="{{$reportData['survey']->id}}" id="surveyId">
                        <select class="form-control select2 question-dropdown" id="questions">
                        	@forelse($reportData['questions'] as $question)
                        		<option value="{{$question->id}}" id="{{$loop->index + 1}}">{{$question->question}}</option>
                        	@empty
                        		<option value="">Please select question</option>
                        	@endforelse
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3>Totals</h3>
                        <h4 id="question">Survey Question: Q1. {{ (isValid($reportData['questions']))?$reportData['questions'][0]['question']:'' }} <!-- <span class="text-muted">(Type: CSAT Score).</span> --></h4>

                    </div>
                </div>

                <div class="card-box">
                    <div class="row">
                        <!-- <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 mt-5">
                            <p class="m-t-0 text-uppercase">nps</p>
                            <div class="text-center">
                                <span class="display-4">62</span> <i class="fas fa-arrow-up h3 text-success ml-3 "></i> <span class="h4 text-success">7</span> 
                            </div>
                            <hr/>
                            <p class="m-t-0 text-uppercase">Csat score</p>
                            <div class="text-center">
                                <span class="display-4">85%</span> <i class="fas fa-arrow-up h3 text-success ml-3 "></i> <span class="h4 text-success">3</span> 
                            </div>
                        </div> -->

                        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 mt-5">
                            <p class="m-t-0 text-uppercase">Total % Breakdown</p>
							<div id="piechart_3d"></div>
                        </div>

                        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 mt-5">
                            <p class="m-t-0 text-uppercase">TOTAL RESPONSES</p>
                            <div class="text-center">
                                <span class="display-4" id="qResponse">{{ $reportData['questionCount'] }}</span> <!-- <i class="fas fa-arrow-down h3 text-danger ml-3 "></i> <span class="h4 text-danger">53%</span>  -->
                            </div>
                            <hr/>
                            <div class="row d-flex justify-content-center" id="breakdown">
                                @forelse($reportData['breakdown'] as $brkdown)
                                    <div class="col-xs-2 {{ (!$loop->first)?'ml-4':'' }}">
                                        @switch($brkdown['type'])
                                            @case('emoji')
                                                <div><i class="far fa-2x" style="color: {{$brkdown['color']}}">{!! $brkdown['value'] !!}</i></div>
                                                @break
                                            @case('single')
                                            @case('multiple')
                                                <i class="font-weight-bold" style="color: {{$brkdown['color']}}">{{ $brkdown['label'] }}</i>
                                                @break
                                        @endswitch
                                        <div class="font-18 text-center" style="color: {{$brkdown['color']}}">{{ $brkdown['totalResponse'] }}</div>
                                        <!-- <div><i class="fas fa-arrow-up text-success "></i> <span class="text-success">3%</span></div> -->
                                    </div>
                                @empty
                                    <p>No Data Found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/gchart.js') }}"></script>
<script src="{{ asset('assets/js/qbReport.js') }}"></script>
<!-- Google Charts js -->
<!-- <script src="assets/js/gchart.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    let pieChartData = {!! json_encode($reportData['pieChartData']) !!};
    drawChart(pieChartData);
</script>
@endsection