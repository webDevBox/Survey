@extends('layouts.company')

@section('styles')
    {{--  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/surveylist.css') }}"> --}}
    <link href="{{ asset('theme/assets/css/custom.css')}}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > surveys</li>
@endsection
@section('content')
{{-- <div class="content-page"> --}}

    <div class="content">
        <div class="container-fluid">
           <div class="row">
             
                <div class="col-md-12">
                  @if(session()->has('success'))
                    <div class="alert alert-success shower">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()->pull('success') }}
                    </div>
                  @endif
                    <div class="card-header">
                        <h4 class="card-title">Survey List <a href="{{ route('companySurvey') }}"><button type="button" class="btn btn-success waves-light waves-effect pull-right mr-3"><i class="fa fa-plus mr-1"></i> Add Survey</button></a></h4>
                    </div>
                    <div class="card-box">
                                    <table id="songsListTable" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Deployed</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                               
                                    @foreach ($surveys as $survey)
                                        <tr>
                                            <td>{{ $survey->name }}</td>
                                            @if($survey->devices->isEmpty())
                                            <td>No</td> 
                                            @else
                                            <td>Yes</td> 
                                            @endif

                                            <td>
                                              <div class="button r pull-left mr-2" id="button-1" >
                                                <input type="checkbox" class="checkbox" id="{{$survey->id}}" onclick="updateSurveyStatus(this)" {{ ($survey->status)?'checked':'' }}>
                                                <div class="knobs"></div>
                                                <div class="layer"></div>
                                              </div>
                                              <div class="clearfix"></div>
                                            </td>
                                            
                                            <td style="width: 95px;">
                                              <span data-toggle="modal" data-target="#myModal_{{$survey->id}}"><a class="btn btn-sm btn-icon waves-effect waves-light btn-success btn123" id="btn_{{$survey->id}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Survey"><i  id="eye_{{$survey->id}}"  class="fa fa-eye btn123"></i></a></span>
                                                <a href="{{ route('editSurvey', $survey->id) }}" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Survey"><i class="fa fa-edit"></i></a>
                                              </td>
                                        </tr>
                                                                                         {{-- Modal for Delete  --}}
                 <div id="myModal_{{$survey->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title text-center" id="myModalLabel">{{$survey->name}}</h4>
                                <h4 class="modal-title text-center" id="crated_at">{{date('d-m-Y', strtotime($survey->created_at))}}</h4>
                                {{-- <h4 class="modal-title text-center" id="crated_at">{{Timezone::convertFromUTC($survey->created_at, $timezone, $format)}}</h4> --}}
                              </div>
                            <div class="modal-body" style="background-image: url({{ URL::asset("theme/assets/images/bg-1.png") }}) }})">

                              <ul class="nav nav-tabs tabs-bordered nav-justified">
                                <li class="nav-item">
                                    <a href="#questions-{{$survey->id}}" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="fas fa-question mr-2"></i> Questions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#devices-{{$survey->id}}" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="fa fa-tablet mr-2"></i>Devices
                                    </a>
                                </li>                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="questions-{{$survey->id}}">
                                  <div class=" d-flex justify-content-center">
                                    <div class="  p-3 bg-white" style=" width:100%;">
                                      <div id="slides_{{$survey->id}}">
                                     
                                       @foreach ($survey->questions as $question)
                                       <div class="toggle_{{$survey->id}} toggle activetoggle">
                                        <div class="app">
                                          {{-- <h3 class="text-center" >Questions </h3> --}}
                                          <h4 class="text-left" >{{$question->question}} </h4>
                                   
                                          @if($question->type=="emoji") 
                                          <div class="container">
                                          @foreach ($question->options as $option)
                                         
                                          <div class="item">                                                     
                                            <label for="{{$option->id}}">
                                            <input class="radio" type="radio"  value="{{$option->value}}" disabled>
                                            <span class="far fa-3x"  style="color:{{$option->colour}}">{!! $option->value !!}</span>
                                          </label>
                                          </div>
                                        
                                          @endforeach
                                        </div>
                                          @elseif($question->type=="single")  
                                          @foreach ($question->options as $option)
                                             <div style="display: flex">                                                                  
                                             <input type="radio" name="radiobutton"   class="optionSelection mt-1"  value="{{$option->id}}" disabled>
                                             <label class="ml-2"  for="{{$option->id}}">{{$option->label}}</label>           
                                             </div>                                                   
                                             @endforeach  
                                             @elseif($question->type=="multiple") 
                                             @foreach ($question->options as $option)
                                             <div style="display: flex">  
                                            <input type="checkbox" class="mt-1"  name="checkboxes" value="{{$option->id}}" disabled>
                                             <label class="ml-2" for="{{$option->id}}">{{$option->label}}</label><br>   
                                              </div>                                                   
                                              @endforeach
                                          @endif                                                                                                                                                                                                                           
                                      </div>
                                    </div>
                                    @endforeach
                                                                                                                                                     
                                     <div class="pt-4 d-none">
                                      <div class="pull-left"><button id="previous_{{$survey->id}}" type="button" class="btn-circle btn btnprevious  btn-success waves-light waves-effect"> <i id="previousIcon_{{$survey->id}}"  class="fa fa-arrow-left"></i></button></div>
                                      <div class="pull-right"><button id="next_{{$survey->id}}" type="button" class="btn-circle btn btnnext btn-success waves-light waves-effect "> <i id="nextIcon_{{$survey->id}}" class="fa fa-arrow-right"></i></button></div>
                                    </div>
                                               </div>                                  
                                              </div>
                                    {{-- <div class="d-flex align-items-center ml-3"><button id="next" type="button" class="btn-circle btn  btn-success waves-light waves-effect "> <i class="fa fa-arrow-right"></i></button></div> --}}
                                </div> 
                                  </div>
                                <div class="tab-pane" id="devices-{{$survey->id}}">
                                  <div class=" d-flex justify-content-center">
                                    <div class=" p-3 bg-white text-left" style="width:100%;">
                                      {{-- <h3 class="text-center" >Devices </h3> --}}
                                        <div class="row bg-success p-2">
                                          <div class="col-md-6 text-white">Device</div>
                                          <div class="col-md-6 text-white">Location</div>
                                        </div>
                                        <div style="height:40vh !important;  overflow-y: auto; overflow-x:hidden;">
                                          @foreach ($survey->devices as $device )
                                          <div class="row mt-2">
                                          <div class="col-md-6">{{$device->name}}</div>
                                          <div class="col-md-6">{{$device->location->name}}</div>
                                        </div>    
                                        @endforeach                                                                     
                                      </div>  {{-- scroll --}}
                                    </div>
                                 </div>
                                </div>
                            </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <x-pagination paginatedObj="{!! json_encode($surveys) !!}"  />
                                <div class="col-md-6 text-right">
                                    <div class="pagination-links pull-right mr-3">  {{$surveys->links() }}</div>
                                </div>
                                <div class="clearfix"></div>   
                            </div>
                    </div>
                </div>
            </div>
        </div>
    
{{-- </div> --}}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [3] },
                ],
                "bPaginate": false,
                "bFilter": true,
                "aaSorting": [],
                "info":false,
            });
        } );
    </script>

<script>     

$(document).on("click",".btn123", function (event) { 
    var id = event.target.id;
    id = id.split('_');
  $('#loading').slideUp();
$('#slides_'+id).fadeIn('slow');
//Prevent having no "active" slide
var $el = $('.toggle_'+id[1]+'.active');
if (!$el.length) {
 $('.toggle_'+id[1]).first().addClass('active');
}
 });

$(document).on("click",".btnprevious", function (event) {  

  var id = event.target.id;
     id = id.split('_');
  var $el = $('.active').prev('.toggle_'+id[1]);
if (!$el.length) //If no previous, s$elect last
{
// $el = $('.toggle').last();;
}
else
{
$('.activetoggle.active').removeClass('active');
$el.addClass('active');
}
 });

$(document).on("click",".btnnext", function (event) { 
  
  var id = event.target.id;
     id = id.split('_');
moveNext(id[1]);
 });

function moveNext(id)
{
var $el = $('.active').next('.toggle_'+id);
if (!$el.length) //If no next, s$elect first
{
}
else
{
$('.activetoggle.active').removeClass('active');
$el.addClass('active');
}
}

</script>

<script type="text/javascript">
    function updateSurveyStatus(e) {
        let confirmText  = 'Do you really want to change the status?';
        let surveyId = $(e).attr('id');
        if (confirm(confirmText)) {
            let status = 0;
            if ($(e).prop('checked')) {
                status = 1;
            }

            let base_url = window.location.origin;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                data: {status: status},
                url:base_url+'/company/survey/active-inactive/'+surveyId+'',
                success:function(data){
                    let response =data;
                    console.log(response)
                    
                }
            });
        }
        else{
                if ($(e).prop('checked')) {
                  $('#'+surveyId).prop('checked', false);
                }
                else{
                  $('#'+surveyId).prop('checked', true);
                }
                
            }
    }
</script>
@endsection
