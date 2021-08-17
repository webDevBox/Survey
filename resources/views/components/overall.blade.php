@section('styles')

@endsection

@forelse($overallReports as $overallReport)
    <div class="card-box">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                <p class="m-t-0 h4">{{ $overallReport['name'] }}</p>
                <input type="hidden" name="surveyId" value="{{$overallReport['id']}}" id="surveyId">
                <select class="form-control form-control-sm input-sm" onchange="questionReport(this)">
                    @forelse($overallReport['questions'] as $question)
                        <option name="{{$question['type']}}" value="{{$question['id']}}" id="{{$loop->index + 1}}">{{$question['question']}}</option>
                    @empty
                        <option value="">Please select question</option>
                    @endforelse
                </select>
                <div class="mt-3">Devices : <strong class="badge badge-secondary">{{ $overallReport['totalDevices'] }}</strong></div>
                <div class="mt-3">Overall Responses : <strong class="badge badge-success">{{ $overallReport['overallResponses'] }}</strong></div>
                <!-- <div class="mt-2">Latest Responses :</div> -->
                
               {{-- <div class="row d-flex justify-content-left">
                    <div class="col-lg-12 mt-2 mr-1"> 
                        <i class="fas fa-arrow-right text-dark ml-1"></i>
                        <span id="latestOResponses">
                            @forelse($overallReport['latestOResponses'] as $ltstOpt)
                                @switch($ltstOpt['type'])
                                    @case('emoji')
                                        <i class="far font-18" style="color: {{$ltstOpt['color']}}">{!! $ltstOpt['value'] !!}</i>
                                        @break
                                    @case('single')
                                    @case('multiple')
                                        <span style="padding:0 2px; color: {{$ltstOpt['color']}}; border:1px solid {{$ltstOpt['color']}}; white-space: pre;">{{ $ltstOpt['label'] }}</span>
                                        @break
                                @endswitch
                            @empty
                            <span>No Data Found!</span>
                            @endforelse
                        </span>
                        
                    </div>
                </div>
                --}}

            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                <div class="row mt-3">
                    <!-- <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 ">
                        <p class="m-t-0 text-uppercase">csat <span class="text-muted ml-3">NPS <sup>TM</sup></span></p>
                        <span class="h1">80.9%</span><br/>
                        <i class="fas fa-arrow-up h5 text-success"></i> <span class="h4 text-success">7</span> 
                    </div> -->
                    <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 ">
                        <p class="m-t-0 text-uppercase text-center">Question Responses</p>
                        <p class="h2 text-center" id="qResponse"><span class="badge badge-primary">{{ $overallReport['questionCount'] }}</span></p><br/>
                        <!-- <i class="fas fa-arrow-down h5 text-danger"></i> <span class="h4 text-danger">19%</span>  -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                <p class="mt-3 text-uppercase">Breakdown</p>
                <div class="row d-flex justify-content-left" id="breakdown">
                    @forelse($overallReport['breakdown'] as $brkdown)
                        <div class="ml-3">
                            @switch($brkdown['type'])
                                @case('emoji')
                                    <div class="col-xs-2">
                                        <div><i class="far fa-2x text-center" style="color: {{$brkdown['color']}}">{!! $brkdown['value'] !!}</i></div>
                                        <!-- <div class="h4">12%</div> -->
                                        <div class="font-18 text-center" style="color: {{$brkdown['color']}}">{{ $brkdown['totalResponse'] }}</div>
                                        <!-- <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Previously: 338"><i class="fas fa-arrow-up text-success "></i> <span class="text-success">3%</span></div> -->
                                    </div>
                                    @break
                                @case('single')
                                @case('multiple')
                                    <div class="mulOpt">
                                        <div class="row">
                                            <div class="col-md-9"><p class="font-weight-bold" style="color: {{$brkdown['color']}}">{{ $brkdown['label'] }}</p></div>
                                            <div class=" col-md-3 font-18 text-center" style="color: {{$brkdown['color']}}"><span class="badge badge-info">{{ $brkdown['totalResponse'] }}</span></div>
                                        </div>
                                        <!-- <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Previously: 338"><i class="fas fa-arrow-up text-success "></i> <span class="text-success">3%</span></div> -->
                                    </div>
                                    @break
                            @endswitch
                        </div>
                    @empty
                        <div class="ml-3">
                            <p>No Data Found!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
         <div class="row mt-3">
            <div class="col-lg-12">Latest Responses :</div>
                    <div class="col-lg-12 mt-2 mr-1"> 
                        <i class="fas fa-arrow-right text-dark ml-1"></i>
                        <span id="latestOResponses">
                            @forelse($overallReport['latestOResponses'] as $ltstOpt)
                                @switch($ltstOpt['type'])
                                    @case('emoji')
                                        <i class="far font-18" style="color: {{$ltstOpt['color']}}">{!! $ltstOpt['value'] !!}</i>
                                        @break
                                    @case('single')
                                    @case('multiple')
                                        <span style="padding:0 2px; color: {{$ltstOpt['color']}}; border:1px solid {{$ltstOpt['color']}}; white-space: pre;">{{ $ltstOpt['label'] }}</span>
                                        @break
                                @endswitch
                            @empty
                            <span>No Data Found!</span>
                            @endforelse
                        </span>
                        
                    </div>
                </div>
    </div>
@empty
<div class="alert bg-white text-center p-4 border" role="alert">
  <img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
</div>
@endforelse