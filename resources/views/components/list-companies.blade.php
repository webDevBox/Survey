<div class="row">
  @forelse($companies as $company)
  <div class="col-12">
    <div class="card-box">
      <div class="row">
        <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 ">
            <div class="company-card ">
              <img src=" {{$company->logo}}" alt="logo" class="company-logo rounded-circle thumb-sm mt-1">
              <div class="company-detail mb-0 pt-1">
                  <h4 class="mb-1 text-primary">{{ $company->name }}</h4>

                  <div class="list-inline-item mr-4">
                    <p class="mb-0 text-muted"><i class="mdi mdi-email-outline mr-1"></i> {{ $company->email??'-' }}</p>
                  </div>

                  <div class="list-inline-item">
                    <p class="mb-0 text-muted"><i class="mdi mdi-cellphone-android mr-1"></i> {{ $company->contact_person_phone??'-' }}</p>
                  </div>
              </div>
            </div>
          </div>

          <div class=" col-sm-5  col-sm-5 col-xs-12 mt-2">
                <div class="pull-right">
                  <button type="button" class="btn btn-danger btn-sm btn-rounded waves-light waves-effect " data-toggle="modal" data-target="#resetpswd-modal" data-id="{{$company->id}}">Reset Password</button>
                <a href="{{ route('admin.reports.by_location', $company->id) }}" class="btn btn-primary btn-sm btn-rounded waves-light waves-effect">View Detail</a>
              </div>
            
                <div class="button r pull-right mr-2" id="button-1" >
                  <input type="checkbox" class="checkbox switch_toggle" id="{{$company->id}}" onclick="updateCompanyStatus(this)" {{ ($company->status)?'checked':'' }}>
                  <div class="knobs"></div>
                  <div class="layer"></div>
                </div>
                <div class="clearfix"></div>
         </div>
      </div>
      <hr/>
      <div class="row">
        <div class="col-md-12 d-flex justify-content-left">
          <div class="col-md-3">
            <p class="mb-0 text-muted">Total Survey</p>
            <p class="text-primary font-18"><i class="dripicons-archive"></i> {{ (isValid($company->surveys))?count($company->surveys):0 }}</p>
          </div>
          <div class="col-md-3">
            <p class="mb-0 text-muted">Total Devices</p>
            <p class="text-primary font-18"><i class="dripicons-device-tablet"></i> {{ (isValid($company->devices))?count($company->devices):0 }}</p>
          </div>
          <div class="col-md-3">
            <p class="mb-0 text-muted">Total Outlets</p>
            <p class="text-primary font-18"><i class="dripicons-location"></i> {{ (isValid($company->locations))?count($company->locations):0 }}</p>
          </div>
          <div class="col-md-3">
            <p class="mb-0 text-muted">Total Feedbacks</p>
            <p class="text-primary font-18">{{ (isValid($company->feedbacks))?count($company->feedbacks):0 }}</p>
          </div>
        </div>                
      </div>
    </div>
  </div>
  @empty
    <div class="alert bg-white text-center p-4 border" role="alert">
      <img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
    </div>
  @endforelse
  <div class="col-12 text-center">
    <button type="button" class="btn btn-lg btn-primary waves-light waves-effect"><i class="mdi mdi-refresh"></i> Load More</button>
  </div>
</div>