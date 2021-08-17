@extends('layouts.admin')
@section('content')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > <a href="{{ route('admin.reports') }}">Reports</a> > Locations </li>
@endsection
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-3">
                <h4>Locations</h4>
                <input type="hidden" id="company_id" value="{{$response['companyId']}}">
                <select class="form-control select2 question-dropdown" id="locations">
                    @forelse($response['locations'] as $location)
                        <option value="{{$location->id}}">{{$location->name}}</option>
                    @empty
                        <option value="">Please select location</option>
                    @endforelse
                </select>
            </div>
        </div>
        <x-list-survey response="{!! json_encode($response) !!}"  />
    </div> <!-- content -->
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    let base_url = window.location.origin;
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
    $("#locations").on('change', function(){
        let locationId  = this.value;
        let companyId   = $('#company_id').val();

        $("#surveys").empty();
        $.ajax({
            type:'GET',
            url:base_url+'/admin/reports/by-location/'+companyId+'/'+locationId+'',
            success:function(response){
                response = JSON.parse(response);
                let newElement = '';
                if (response.surveys.length > 0) {
                    $.each(response.surveys, function(index, survey){
                        if (survey.latest_feedback.length != 0) {
                            newElement += `<div class="col-12">
                                                <div class="card-box">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                                                            <h5 class="m-t-0"><a href="" class="text-dark">`+survey.name+`</a></h5>
                                                            <p class="text-primary">Devices: `+Object.keys(survey.device).length+`</p>
                                                        </div>

                                                        <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 ">
                                                            <h5 class="m-t-0">Last Response</h5>
                                                            <p class="text-dark">`+survey.latest_feedback[0].latest_feedback_at+`</p>
                                                        </div>

                                                         <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 mt-2">
                                                            <a href="`+base_url+"/admin/reports/by-location/"+locationId+"/survey/"+survey.id+`" class="btn btn-sm btn-warning"> <i class="fas fa-chart-line"  data-toggle="tooltip" data-placement="top" title="" data-original-title="View Report"></i></a>

                                                            <a href="`+base_url+"/admin/reports/export/"+survey.id+`/location/`+response.locationId+`" class="btn btn-sm btn-danger"> <i class="far fa-file-excel"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Excel Report"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`
                        }
                    });
                }else{
                    newElement = `<div class="col-12">
                                    <div class="alert bg-white text-center p-4 border" role="alert">
                                        <img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
                                    </div>
                                </div>`;
                }

                $("#surveys").append(newElement);
            }
        });
    });
</script>
@endsection
