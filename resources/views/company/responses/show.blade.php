@extends('layouts.company')

@section('styles')

@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > <a href="{{ route('company.reports') }}"> Reports </a> > <a href="javascript:history.back()">Feedbacks</a> > Details </li>
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                    <a href="javascript:history.back()"><i class="fa fa-arrow-left text-primary font-18"></i></a>
                    <p class="m-t-0 h4">Response #{{ makeResponseNumber($feedback->id) }}</p>
                   
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <i class="fa fa-info-circle font-18 text-muted mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Title.."></i>
                            <span class="badge border border-warning pl-2 p-0 font-13 font-weight-light mr-3 text-warning">NPS <span class="badge badge-warning p-1 font-13 font-weight-light"style="vertical-align: middle !important;" >8.02</span> </span>
                            <span class="badge border border-success pl-2 p-0 font-13 font-weight-light text-success">CES <span class="badge badge-success p-1 font-13 font-weight-light" style="vertical-align: middle !important;">8.02</span> </span>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-2 text-muted">Survey</div>
                        <div class="col-sm-10">{{ optional($feedback->survey)->name }}</div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-2 text-muted">Date & Time</div>
                        <div class="col-sm-10">{{ parse_by_format($feedback->created_at, "M d, Y H:i A") }}</div>
                    </div>

                    <!-- <div class="row mt-2">
                        <div class="col-sm-2 text-muted">Duration</div>
                        <div class="col-sm-10">01:42:32</div>
                    </div> -->

                    
                    <div class="mt-5 font-18">Response:</div>
                    <style>
                        .ia {opacity:0.5;}
                    </style>
                    @php
                        $feedbackDetails = $feedback->feedbackDetails;
                    @endphp
                    @foreach($feedback->survey->questions as $question)
                        <div class="row  mt-2 pt-2 border-top">
                            <div class="col-lg-12">
                            <div class="font-16 text-primary">{{ $question->question }}</div>
                            <div class="mt-2">
                                @php
                                    $selectedOptions = selectedOptions($question->options, $feedbackDetails);
                                @endphp
                                @foreach($selectedOptions as $option)
                                    @switch($question->type)
                                        @case('emoji')
                                            @if($option['selected'])
                                                <i class="far fa-2x" style="color: {{$option['colour']}}">{!! $option['value']!!}</i>
                                            @else
                                                <i class="far fa-2x ia" style="color: {{$option['colour']}}"><strike>{!! $option['value']!!}</strike></i>
                                            @endif
                                            @break
                                        @case('single')
                                        @case('multiple')
                                            @if($option['selected'])
                                                <i class="far fa-2x" style="color: {{$option['colour']}}">{{ $option['label'] }}</i>
                                            @else
                                                <i class="far fa-2x ia" style="color: {{$option['colour']}}"><strike>{{ $option['label'] }}</strike></i>
                                            @endif
                                            @break
                                    @endswitch
                                @endforeach
                            </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row  mt-2 pt-2 border-top">
                        <div class="col-lg-12">
                            <div class="font-16 text-primary">Full Name</div>
                            <div>{{ $feedback->customer->name ?? '--'}}</div>
                        </div>
                    </div>
                    <div class="row  mt-2 pt-2 border-top">
                        <div class="col-lg-12">
                            <div class="font-16 text-primary">Email</div>
                            <div>{{ $feedback->customer->email ?? '--'}}</div>
                        </div>
                    </div>
                    <div class="row  mt-2 pt-2 border-top">
                        <div class="col-lg-12">
                            <div class="font-16 text-primary">Phone</div>
                            <div>{{ $feedback->customer->phone ?? '--'}}</div>
                        </div>
                    </div>

                </div>

              
            <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 pl-5">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="pull-right"> <span class="badge badge-light border  pl-3 pr-3 pt-2 pb-2"><i class="icon-globe font-16 mr-1"></i> <span class="font-16 font-weight-light">ONLINE</span></span></div>
                    </div>
                </div>

                <!-- <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="pull-right font-16"> <a href="#">Add Note</a> | <a href="#">Add Task</a> </div>
                    </div>
                </div> -->

                <!-- <div class="row">
                    <div class="col-md-12 mt-5">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#tasks" data-toggle="tab" aria-expanded="false" class="nav-link active show">Tasks</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#notes" data-toggle="tab" aria-expanded="true" class="nav-link">Notes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#activity" data-toggle="tab" aria-expanded="false" class="nav-link">Activity</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tasks">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right"><button type="button" class="btn btn-primary waves-light waves-effect">Add Task</button></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pt-2 pb-2 border-bottom">Task 123</div>
                                            <div class="pt-2 pb-2 border-bottom">Task xyz asdf</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="notes">
                                   <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right"><button type="button" class="btn btn-primary waves-light waves-effect">Add Notes</button></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pt-2 pb-2 border-bottom">Notes asdf 1</div>
                                            <div class="pt-2 pb-2 border-bottom">Notes text will goes here</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="activity">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pt-2 pb-2 border-bottom">Notes asdf 1</div>
                                            <div class="pt-2 pb-2 border-bottom">Notes text will goes here</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div> <!-- content -->

</div>
@endsection

@section('scripts')

@endsection
