<div class="row" id="surveys">
{{ dd($responses) }}
	@forelse($responses->feedback as $feedback)
		<div class="col-12">
		    <div class="card-box">
		        <div class="row">
		            <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
		                <h5 class="m-t-0"><a href="" class="text-dark">Response #{{ makeResponseNumber($feedback->generated_feedback_id) }}</a></h5>
		            </div>

		            <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 ">
		                <p class="text-dark mt-2">{{ parse_by_format($feedback->created_at, "M d, Y g:i A") }}</p>
		            </div>

		             <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 ">

		                <a href="{{ route('company.survey.feedback.detail', $feedback->id) }}"> <i class="fas fa-info-circle fa-3x text-primary"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail"></i></a>
		            </div>
		        </div>
		    </div>
		</div>

	@empty
		<div class="alert bg-white text-center p-4 border" role="alert">
		  	<img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
		</div>
	@endforelse
</div>
<div class="row">
	<div class="col-12 text-center mt-4">
		<input type="hidden" value="0" id="currentPage">
		<input type="hidden" value="{{ $responses->totalPages }}" id="totalPages">
	    <button type="button" class="btn btn-lg btn-primary waves-light waves-effect" id="btnLoadMore">Load More</button>
	</div>
</div>