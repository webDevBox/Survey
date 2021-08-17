<div class="row" id="surveys">
	{{--dd($responseObj->surveys)--}}
	@forelse($responseObj->surveys->surveys as $survey)
		@if(!empty($survey->latest_feedback))
			<div class="col-12">
			    <div class="card-box">
			        <div class="row">
			            <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
			                <h5 class="m-t-0"><a href="" class="text-dark">{{ $survey->name }}</a></h5>
			                <p class="text-primary">Devices: {{ (isValid($survey->device))?count($survey->device):0 }}</p>
			            </div>

			            <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 ">
			                <h5 class="m-t-0">Last Response</h5>
			                <p class="text-dark">{{$survey->latest_feedback[0]->latest_feedback_at}}</p>
			            </div>

			             <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 mt-2">
			             	@if($responseObj->type != 'admin')
			             		<a href="{{route($responseObj->type.'.survey.feedbacks.by-location', [$survey->id, $responseObj->surveys->locationId ])}}" class="btn btn-sm btn-primary" > <i class="far fa-comment-dots"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Feedbacks"></i></a>
			             	@endif

			                <a href="{{ route($responseObj->type.'.reports.survey.by_location', [$responseObj->surveys->locationId, $survey->id]) }}" class="btn btn-sm btn-warning"> <i class="fas fa-chart-line"  data-toggle="tooltip" data-placement="top" title="" data-original-title="View Report"></i></a>

			                <a href="{{ route($responseObj->type.'.export.by-location', [$survey->id, $responseObj->surveys->locationId]) }}" class="btn btn-sm btn-danger"> <i class="far fa-file-excel"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Excel Report"></i></a>
			                 
			                <!-- <a href="#"> <i class="fas fa-cog fa-3x text-primary pull-right"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Report"></i></a> -->
			            </div>
			        </div>
			    </div>
			</div>
		@endif
	@empty
	<div class="col-12">
		<div class="alert bg-white text-center p-4 border" role="alert">
		  	<img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
		</div>
	</div>
	@endforelse
</div>