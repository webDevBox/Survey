@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('theme/plugins/switchery/switchery.min.css') }}" />
<!-- Date Picker -->
<link href="{{ asset('theme/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<link href="{{ asset('theme/assets/css/custom.css')}}" rel="stylesheet">
@endsection
@section('content')

@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('adminDashboard') }}"> Dashboard </a> > Reports</li>
@endsection
<!-- Start Page content -->
<div class="content">
    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success shower">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger shower">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div><h3>Reports ( {{ count($companies) }} )</h3></div>
            </div>
            <div class="col-md-6">
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
        </div>
        <!-- Call List surveys component -->
        {{-- <x-list-companies companies="{!! json_encode($companies) !!}"  /> --}}
        {{-- <div class="row">
            <div id="post_data"></div>
          </div> --}}
          <div class="row">
            @forelse($companies as $company)
            <div class="col-12">
              <div class="card-box">
                <div class="row">
                  <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 ">
                      <div class="company-card ">
                        <img src=" {{asset('images/'.$company->logo)}}" alt="logo" class="company-logo rounded-circle thumb-sm mt-1">
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
              <div class="col-12 alert bg-white text-center p-4 border" role="alert">
                <img src="{{ URL::asset('assets/images/app/no-data.png') }}" height="50" alt="" class=""> <p>No Data Found!</p> 
              </div>
            @endforelse
            <div class="col-12">
                <span class="pull-right"> {{ $companies->links() }} </span>
            </div>
          </div>
    </div> <!-- content -->
</div>

<!-- Signup modal content -->
<div id="resetpswd-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class=" text-center m-b-30">
                    Reset Password
                </h2>

                <form class="form-horizontal" action="{{ route('reset_company_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="companyId" value="" id="companyId">
                    <div class="form-group">
                        <div class="col-12">
                            <label for="password">Password:</label>
                            <div class="input-group">
	                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" data-toggle="password" required>
	                            <div class="input-group-append">
	                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
	                            </div>
                                @if ($errors->has('password'))
                                    
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="password_confirmation">Confirm Password:</label>
                            <div class="input-group">
                              	<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-toggle="password" required>
                              	<div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group account-btn text-center m-t-10">
                        <div class="col-12">
                            <button class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- company status update -->
<div id="comStatus-modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class=" text-center m-b-30">
                   <i class="fas fa-exclamation-triangle text-danger"></i>
                </h2>

                <form class="form-horizontal" action="{{ route('update_company_status') }}" id="comStatusForm" method="POST">
                    @csrf
                    <input type="hidden" name="companyId" value="" id="companyID">
                    <input type="hidden" name="status" value="0" id="status">
                    <div class="form-group">
                        
                            <span class="text-muted" for="reason">Please describe the reason to disable the account</span>
                            
                                <textarea class="col-md-12" rows="4"  name="reason" id="reason"></textarea>
                            
                       
                    </div>
                    <div class="form-group account-btn text-center m-t-10">
                        <div class="col-12">
                            <button class="cancle btn btn-light waves-effect waves-light data_dismissal" data-dismiss="modal">Cancel</button>
                            <button class="clicker btn btn-danger waves-effect waves-light" type="submit">Disable</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- / ./company status update modal -->
@endsection
@section('scripts')
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

        window.location.href = base_url+'/admin/reports?from='+from+'&to='+to;
    })
</script>

<script type="text/javascript">
    $('#resetpswd-modal').on('show.bs.modal', function (e) {
        let companyId = $(e.relatedTarget).attr('data-id');
        $('#companyId').val(companyId);
    });

    $('#resetpswd-modal').on('hide.bs.modal', function (e) {
        $('#companyId').val('');
        $("#password").removeClass("is-invalid");
    });

    let errors = "<?php echo $errors->has('password') ?>";
    if (errors) {
        $('#resetpswd-modal').modal('show');
    }
</script>

<script>
    $('.data_dismissal').click(function(){
       var comId = $('#companyID').val();
       $('#'+comId).prop('checked', true);
    });
</script>

<script type="text/javascript">
    function updateCompanyStatus(e) {
        let companyId = $(e).attr('id');
        $('#companyID').val(companyId);
        $('#reason').val('');

        if (!$(e).prop('checked')) {
            $('#comStatus-modal').on('hide.bs.modal', function (e) {
                $('#companyID').val('');
            });

            $('#comStatus-modal').modal('show');
        }else{
            $('.switch_toggle').prop('disabled', true);
            $('#status').val('1');
            $('#comStatusForm').submit();
        }
    }
</script>

<script>
    // Password View
    $(function () {
    $('[data-toggle="password"]').each(function () {
    var input = $(this);
    var eye_btn = $(this).parent().find('.input-group-text');
        eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
        eye_btn.on('click', function () {
        if (eye_btn.hasClass('input-password-hide')) {
            eye_btn.removeClass('input-password-hide').addClass('input-password-show');
            eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
            input.attr('type', 'text');
        } else {
        eye_btn.removeClass('input-password-show').addClass('input-password-hide');
        eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
        input.attr('type', 'password');
            }
        });
    });
    });
</script>
{{-- <script>
    $(document).ready(function(){
     load_data('');
     function load_data(id="")
     {
      $.ajax({
       url:"{{ route('admin.reports.loadMore') }}",
       method:"GET",
       data:{id:id},
       success:function(data)
       {
            var output = '';
            var last_id = '';
            for(i in data)
                {
                    output +=
                '<div class="col-12">'
                        '<div class="card-box">'
                        '<div class="row">'
                                '<div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 ">'
                                    '<div class="company-card ">'
                                        '<img src=" '+data[i].logo+'" alt="logo" class="company-logo rounded-circle thumb-sm mt-1">'
                                        '<div class="company-detail mb-0 pt-1">'
                                            '<h4 class="mb-1 text-primary">'+ data[i].name +'</h4>'
                                            '<div class="list-inline-item mr-4">'
                                                '<p class="mb-0 text-muted"><i class="mdi mdi-email-outline mr-1"></i> '+ data[i].email??'-' +'</p>'
                                            '</div>'
                                            '<div class="list-inline-item">'
                                                '<p class="mb-0 text-muted"><i class="mdi mdi-cellphone-android mr-1"></i> '+ data[i].contact_person_phone??'-' +'</p>'
                                            '</div>'
                                        '</div>'
                                    '</div>'
                                '</div>'
                                '<div class=" col-sm-5  col-sm-5 col-xs-12 mt-2">'
                                        '<div class="pull-right">'
                                            '<button type="button" class="btn btn-danger btn-sm btn-rounded waves-light waves-effect " data-toggle="modal" data-target="#resetpswd-modal" data-id="'+data[i]id+'">Reset Password</button>'
                                            '<a href="'+ route("admin.reports.by_location"+ data[i].id) +'" class="btn btn-primary btn-sm btn-rounded waves-light waves-effect">View Detail</a>'
                                        '</div>'
                                        '<div class="button r pull-right mr-2" id="button-1" >'
                                            '<input type="checkbox" class="checkbox switch_toggle" id="'+data[i].id+'" onclick="updateCompanyStatus(this)" '+ (data[i].status)?'checked':'' +'>'
                                            '<div class="knobs"></div>'
                                            '<div class="layer"></div>'
                                        '</div>'
                                        '<div class="clearfix"></div>'
                                    '</div>'
                                '</div>'
                                '<hr/>'
                                '<div class="row">'
                                    '<div class="col-md-12 d-flex justify-content-left">'
                                        '<div class="col-md-3">'
                                        '<p class="mb-0 text-muted">Total Survey</p>'
                                        '<p class="text-primary font-18"><i class="dripicons-archive"></i> '+ (isValid(data[i].surveys))?count(data[i]surveys):0 +'</p>'
                                    '</div>'
                                    '<div class="col-md-3">'
                                        '<p class="mb-0 text-muted">Total Devices</p>'
                                        '<p class="text-primary font-18"><i class="dripicons-device-tablet"></i> '+ (isValid(data[i].devices))?count(data[i].devices):0 +'</p>'
                                    '</div>'
                                    '<div class="col-md-3">'
                                        '<p class="mb-0 text-muted">Total Outlets</p>'
                                        '<p class="text-primary font-18"><i class="dripicons-location"></i> '+ (isValid(data[i].locations))?count(data[i].locations):0 +'</p>'
                                    '</div>'
                                    '<div class="col-md-3">'
                                        '<p class="mb-0 text-muted">Total Feedbacks</p>'
                                        '<p class="text-primary font-18">'+ (isValid(data[i].feedbacks))?count(data[i].feedbacks):0 +'</p>'
                                    '</div>'
                                '</div>'
                            '</div>'
                        '</div>'
                    '</div>';
                    last_id = data[i].id;
                }
                $output += 
                    '<div id="load_more">'
                        '<button type="button" name="load_more_button" class="btn btn-primary form-control" data-id="'+ last_id+'" id="load_more_button">Load More</button>'
                    '</div>';
            $('#load_more_button').remove();
            $('#post_data').append(output);
        }
      });
     }
    
     $(document).on('click', '#load_more_button', function(){
      var id = $(this).data('id');
      $('#load_more_button').html('<b>Loading...</b>');
      load_data(id);
     });
    
    });
    </script> --}}
<script>
    $('.clicker').click(function(){
        $('.clicker').attr('style','display:none;');
        $('.cancle').attr('style','display:none;');
    });
</script>
@endsection