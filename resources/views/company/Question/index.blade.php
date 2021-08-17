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

@section('content')
    <div class="content">
        <input type="hidden" id="check-survey" value="{{$survey_id}}" name="check-survey"/>
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
                        <h4 class="card-title">Question List <a href="" data-toggle="modal" data-target="#myModal"><button type="button" class="btn btn-success waves-light waves-effect pull-right mr-3"><i class="fa fa-plus mr-1"></i>Add Question</button></a></h4>
                    </div>
                    <div class="card-box">
                                    <table id="songsListTable" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th> 
                                </tr>
                                </thead>
                                <tbody>                              
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            @if($question->deleted_at !=null) 
                                            <td id="status_{{$question->id}}">
                                               In Active
                                            </td>
                                            <td  style="width: 140px;">  
                                                <input type="checkbox" id="{{$question->id}}" name="isActivesurvey" class="isDeviceSelected"  data-plugin="switchery" data-color="#64b0f2" data-size="small"/>               
                                            </td>
                                                @else
                                                <td id="status_{{$question->id}}">
                                                    Active
                                                </td>  
                                                <td style="width: 140px;">  
                                                    <input type="checkbox" id="{{$question->id}}" name="isActivesurvey" class="isDeviceSelected" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>               
                                                </td>                                          
                                                @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <x-pagination paginatedObj="{!! json_encode($questions) !!}"  />
                                <div class="col-md-6 text-right">
                                    <div class="pagination-links pull-right mr-3">  {{$questions->links() }}</div>
                                </div>
                                <div class="clearfix"></div>   
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-center" id="myModalLabel"> Add Question</h4>
                    </div>
                    <div class="modal-body">
                        <div class="card-box">
                            <div class="tab">
                                <button class="tablinks active" id="defaultopen" onclick="openCity(event, 'Paris')">Choose Template</button>
                                <button class="tablinks toggle-disabled" id="chosequestion" onclick="openCity(event, 'Tokyo')" disabled>Add Question</button>
                            </div>
               
                            <div id="Paris" class="tabcontent p-4">
                                @foreach ($templates as $category)
                                <form id="choseTemplate">
                                    <h4>{{$category->name}}</h4>
                                    <div class="form-group ml-3">
                                        @foreach ($category->template as $gettemplate)                                      
                                        <input type="radio" id="template_{{$gettemplate->id}}" class="optionSelection"  name="templateName" value="male" onclick="getTemplateOptions({{$gettemplate->id}})">
                                        <label class="col-md-2" for="male">{{$gettemplate->name}}</label>
                                        <img src="/storage/app/{{$gettemplate->imageUrl}}" alt="" class="img-fluid ml-5 p-3 border">
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
                                        <button id="add_another_button" value="add_another_value" class="tablinks btn btn-success waves-light waves-effect mt-3">submit</button>
                                    </div>                        
                                </form>
                            </div>      
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Default Datatable
            $('#songsListTable').DataTable({
                "columnDefs": [
                { "orderable": false, "targets": [2] },
                ],
                "bPaginate": false,
                "bFilter": true,
                "aaSorting": [],
                "info":false,
            });
        } );

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

                        $( ".insertoptions" ).append("<tr><td><i id='smiley-color-change' value="+response.templateOptions[i].name+" class='far fa-3x text-danger_"+response.templateOptions[i].id+"'>"+response.templateOptions[i].name+"</i></td><td><div class='btn-grid'> <span id='btn_"+response.templateOptions[i].id+"_#007bff' class='dot emoji-btn-blue btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#28a745' class='dot emoji-btn-green btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#dc3545' class='dot emoji-btn-red btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#ffc107' class='dot emoji-btn-yellow btncoulours'></span><span id='btn_"+response.templateOptions[i].id+"_#bfbfbf' class='dot emoji-btn-grey btncoulours'></span></div></td><td><input class='form-control' type='text' name='label' value="+response.templateOptions[i].label+" '' required maxlength='30'></td></tr>" );
                      
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
                     $(document).ready(function() {
                         if($(document.activeElement).val()=="add_another_value")
                         {
                             location.reload();
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

        $(document).on('change', '.isDeviceSelected', function(event){
            var id = event.target.id;
            var value  = $('#'+id).is(':checked');
            var status_id = "status_"+id;
             
            if(value==true)
            {
                $("#"+status_id).html("Active");
            }
            else
            {
                $("#"+status_id).html("In Active");

            }

             $.ajax({
            url: '{{ url("company/survey/question/remove") }}',
            type:"POST",
            data: { 
                "_token": "{{ csrf_token() }}",
                id: id, value:value},
            success:function(response){
                console.log(response);
           },
           error: function(response) { 
            console.log(response);  
            }, 
            });
        });
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