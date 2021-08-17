@extends('layouts.company')
@section('styles')
<style>
    
    
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      
    }
    
    /* Change background color of buttons on hover */
    /* .tab button:hover {
      background-color: #02c0ce;
      color:#fff;
    } */
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #0acf97;
      color:#fff;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

    .dot {
  height: 20px;
  width: 20px;
  border-radius: 50%;
  display: inline-block;
  cursor: pointer;
  margin:0 2px;

}

.emoji-btn-blue {
  background-color: #007bff;
}
.emoji-btn-green {
  background-color: #28a745;
}

.emoji-btn-red {
  background-color: #dc3545;
}

.emoji-btn-yellow {
  background-color: #ffc107;
}

.emoji-btn-grey {
  background-color: #6c757d;
}


    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('companyDashboard') }}">Dashboard</a> > Create Survey</li>
@endsection
@section('content')

<div class="content">
    <input type="hidden" id="check-survey" value="" name="check-survey"/>
    <div class="container-fluid">
        <!-- Basic Form Wizard -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h4 class="card-title">New Survey</h4>
                </div>
                <div class="card-box">
                    <div class="tab">
                        <button class="tablinks active" id="defaultopen" onclick="openCity(event, 'London')">Create your survey</button>
                        <button class="tablinks toggle-disabled"  id="choseTemplate1" onclick="openCity(event, 'Paris')" disabled>Choose Template</button>
                        <button class="tablinks toggle-disabled" id="chosequestion" onclick="openCity(event, 'Tokyo')" disabled>Add Question</button>
                        <button class="tablinks toggle-disabled" id="Deploybutton" onclick="openCity(event, 'Deploy')" disabled>Deploy</button>
                    </div>

                    <div id="London" class="tabcontent p-4">
                        <form type="submit" id="AddSurvey">
                            <div class="form-group clearfix">
                                <label class="control-label " for="userName">Your Survey Name <span class="text-danger">*</span></label>
                                <div class="">
                                    <input class="form-control required" id="SurveyName" name="SurveyName" type="text" maxlength="100">
                                </div>
                                
                                    <strong class="text-danger print-error-msg"></strong>
                            </div>

                            <div class="d-flex bd-highlight mt-5">
                                <div class=" bd-highlight">
                                    <div><label class="control-label mt-4" for="userName">Survey Languages </label></div>
                                    <button type="button" id="language" value="English" class="btn btn-success waves-light waves-effect">en - English</button>
                                </div>
                                <div class="ml-auto  bd-highlight">
                                    <button class="tablinks btn btn-success waves-light waves-effect mt-5" id="surveyNext">Next</button>
                                </div>
                              </div>
                        </form>
                    </div>

                    <div id="Paris" class="tabcontent p-4">
                        @foreach ($templates as $category)
                        <form id="choseTemplate">
                            <h4>{{$category->name}}</h4>
                            <div class="form-group ml-3">
                                @foreach ($category->template as $gettemplate)                
                                <input type="radio" id="template_{{$gettemplate->id}}" class="optionSelection"  name="templateName" value="male" onclick="getTemplateOptions({{$gettemplate->id}})">
                                <label class="col-md-2" for="male">{{$gettemplate->name}}</label>
                                <img src="{{asset('images/'.$gettemplate->imageUrl)}}" alt="" class="img-fluid ml-5 p-3 border">
                                <br/><br/>
                                @endforeach
                            </div>
                        </form>
                        @endforeach
                    </div>

                    <div id="Tokyo" class="tabcontent p-4">
                        <form id="addQuestion">
                            <div class="form-group">

                                <label class="control-label " for="question">Question Title<span class="text-danger">*</span></label>
                                <div class="">
                                    <input class="form-control required" id="question" name="question" type="text" maxlength="500">
                                </div>
                                <strong class="text-danger print-question-error-msg"></strong>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Icon</th>
                                        <th>Colour</td>
                                        <th>Label</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="insertoptions">
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button id="add_another_button" value="add_another_value" class="tablinks btn btn-success waves-light waves-effect mt-3">Add Another Question</button>
                                <button id="deploy_survey_button" value="deploy_value"   class="tablinks btn btn-success waves-light waves-effect mt-3" >Continue to Deploy</button>
                            </div>                        
                        </form>
                    </div>

                    <div id="Deploy" class="tabcontent p-4">
                       <h3 id="survaynameonDevicesGrid"></h3>
                       <h4>Your Devices</h4>
                       <p>Select your device or devices on which you wish to remotely deploy your survey. Your survey will be automatically launched on your selected device if Surveyapp by VOC Metrics is running. You can also assign the language you wish your survey to be displayed in.</p>
                        <form  class="DeploySuveyOnDevices">
                            
                            <div class="form-group">                    
                                <div class="form-group clearfix">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>DEVICE</th>
                                            <th>LOCATION</th>                                       
                                            <th>DEPLOY?</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($devices as $device)
                                        <tr>
                                            <td><i class="fa fa-wifi mr-2"></i> {{$device->name}}</td>
                                            <td>{{$device->location->name}}</td>
                                        
                                        <input type="hidden" name="device_id" value="{{$device->id}}" />
                                            <td><input type="checkbox" name="isActivesurvey" class="isDeviceSelected"  checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                            <button class="tablinks btn btn-success waves-light waves-effect mt-5 pull-right" id="sa-close" >Finish</button>
                            <div class="clearfix">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openCity(evt, cityName) {

        var x = evt.target;      
        var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  document.getElementById("defaultopen").click();

    //Add Survey
    $('#AddSurvey').on('submit',function(event){
        event.preventDefault();
        let name = $('#SurveyName').val();
        let language =  $('#language').val();
        var survey_id = $('#check-survey').val();

        $.ajax({

          url: '{{ url("company/survey/store") }}',
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            name:name,
            language:language,
            survey_id:survey_id,
        
          },
          success:function(response){
           
                if(!response.errors)
                {
                    // $(".print-error-msg").find("ul").html('');
                    // $(".print-error-msg").css('display','none');

                    $(".print-error-msg").html('');
                    $('#survaynameonDevicesGrid').empty();
                    $('.surveyId_forDeploy').empty();


             $('#check-survey').val(response.result.id);
            $( ".insertoptions" ).append( "<input id='surveyid_fordeployment' type='hidden' name='surveyid' value="+response.result.id+">" );
            $( ".DeploySuveyOnDevices" ).append( "<input type='hidden' name='surveyid' value="+response.result.id+">" );
            $( "#survaynameonDevicesGrid" ).append("<h3>"+response.result.name+"</h3>"); 
             
              openCity(event, 'Paris');
            $('#choseTemplate1').prop("disabled", false);  
            var element = document.getElementById("choseTemplate1");
                element.classList.add("active");                     
                }
                else
                {
                    console.log(response.errors);
                    // $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").html('');
                    printErrorMsg(response.errors);
                }                     
          },
          error: function(response) { 
                    console.log(response);
          },
                  
                   });
        });

    function getTemplateOptions(id)
    {
    $.ajax({

                    url: '{{ url("company/survey/template/option/list") }}',
                    type:"POST",
                    data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                    },
                    success:function(response){
                    
                           console.log(response);
                         $('.insertoptions').empty();
                         document.getElementById('question').value = ''
                         var survey_id = $('#check-survey').val();

                         $( ".insertoptions" ).append( "<input id='surveyid_fordeployment' type='hidden' name='surveyid' value="+survey_id+">" );
                         $( ".insertoptions" ).append( "<input id='selection_type' type='hidden' name='selection_type' value="+response.selection_type+">" );

                        for (i = 0; i < response.templateOptions.length; i++) {

                        $( ".insertoptions" ).append("<tr><td><i id='smiley-color-change' value="+response.templateOptions[i].name+" class='far fa-3x text-danger_"+response.templateOptions[i].id+"'>"+response.templateOptions[i].name+"</i></td><td><div class='btn-grid'> <span id='btn_"+response.templateOptions[i].id+"_#007bff' class='dot emoji-btn-blue btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#28a745' class='dot emoji-btn-green btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#dc3545' class='dot emoji-btn-red btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#ffc107' class='dot emoji-btn-yellow btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#6c757d' class='dot emoji-btn-grey btncoulours'></span></div></td><td><input class='form-control' type='text' name='label' value="+response.templateOptions[i].label+" '' required maxlength='30'></td></tr>" );
                      
                        $( ".insertoptions" ).append( "<input type='hidden' id='hiddenOption_"+response.templateOptions[i].id+"' name='icon' value="+response.templateOptions[i].id+"> ");
                            }               
                        let Tokyo = 'Tokyo';                    
                        openCity(event,Tokyo ); 
                        $('#chosequestion').prop("disabled", false);                       
                           var element = document.getElementById("chosequestion");
                               element.classList.add("active");                      
                    },   
                    });
  }

        function printErrorMsg (msg) {
            $(".print-error-msg").append(msg);
        }

    $('#addQuestion').on('submit',function(event){
        event.preventDefault();
        
         var ser = $('#addQuestion').serializeArray();
        formData= JSON.stringify(ser);  

        $.ajax({

          url: '{{ url("company/survey/question/store") }}',
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            formData:formData,
          },
          success:function(response){
                  
            if(!response.errors)
                {  
                    $(".print-question-error-msg").html('');
                     $('#Deploybutton').prop("disabled", false); 
                    
                     $( document ).ready(function() {
                         if($(document.activeElement).val()=="add_another_value")
                         {
                            openCity(event, 'Paris');
                            var element = document.getElementById("choseTemplate1");
                               element.classList.add("active"); 
                               $('#chosequestion').prop("disabled", true);     
                         }
                         else
                         {
                            openCity(event, 'Deploy');
                            var element = document.getElementById("Deploybutton");
                               element.classList.add("active"); 
                         }
                       });                      

          }
          else
          {
            $(".print-question-error-msg").html('');
            $(".print-question-error-msg").append(response.errors);
          }                     
          },
          error: function(response) { 
           console.log(response);  
    }, 
         });
        });

        $('.DeploySuveyOnDevices').on('submit',function(event){
         event.preventDefault();
      
         var ser = $('.DeploySuveyOnDevices').serializeArray();
          console.log(ser);
         formData = JSON.stringify(ser);    
        $.ajax({

          url: '{{ url("company/survey/devices/deploy") }}',
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            formData:formData,
          },
          success:function(response){
              console.log(response);
          },
          error: function(response) { 
              console.log(response);
    }, 
         });
        });

      </script>

<script>

var option_id;
$(document).on("click",".btncoulours", function (event) {    
    var colour_id = event.target.id;
    option_id = colour_id.split('_');
    $(".text-danger_"+option_id[1]).css("cssText", "color:"+option_id[2]+" !important;");
    var x = document.getElementById("hiddenOption_"+option_id[1]);
     x.value = option_id[1]+"_"+option_id[2];
     console.log(x);
 });

 </script>
@endsection
