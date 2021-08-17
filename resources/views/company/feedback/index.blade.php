<!doctype html>
<html lang="en">
    <head>
     <!-- App css -->
    <link href={{ asset('theme/assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />

    <!--Sweet Alert -->
    <link href={{ asset('theme/plugins/sweet-alert/sweetalert2.min.css') }} rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        
    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('theme/assets/images/survey-fav.png') }}>    <script src={{ asset('theme/assets/js/modernizr.min.js') }}></script>

    <!-- FontAwesome Kit-->
    <script src="https://kit.fontawesome.com/6926415b32.js" crossorigin="anonymous"></script>
    </head>
   
   <style>
body.enlarged
{min-height:fit-content;}

p{ text-align: center; }

#loading img {
  display: block;
  margin: 10px auto;
}

#slides {
  display: none;
}

.toggle {
  display: none;
}

.active {
  display: block;
  animation: fadein ease-in 1s;
}

@keyframes fadein {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

button:hover {
  cursor: pointer;
  background: #333;
  color: #fff;
}

.app {

  /* padding:25px 20px; */
  /* min-width: 320px; */
    
}
.container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.item {
  /* width: 70px;
  height: 70px; */
  display: flex;
  justify-content: center;
  align-items: center;
  user-select: none;
  margin: 0 2px;
}
.radio {
  display: none;
}
.radio ~ span {
  font-size: 2rem;
/*  filter: grayscale(100);*/
  cursor: pointer;
  transition: 0.15s;
}

/* .radio:checked ~ span {
  font-size: 3rem;

} */

.footer {
    border-top: 1px solid rgba(152, 166, 173, 0.2);
    bottom: 0;
    text-align: center !important;
    padding: 19px 30px 20px;
    position: absolute;
    right: 0;
    width: 100% !important;
    color: #98a6ad;
    left: 0;
}

.btn-circle {
    width: 40px;
    height: 40px;
    padding: 6px 0px;
    border-radius: 50%;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}

.center {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 400px;
}

input[type=checkbox], input[type=radio]
{
  zoom:1.3;
  
}
label
{
  font-size: 16px;
  line-height: 1.6rem;
}

@media (max-width: 768px) {
    .feedback-width {
    width:100%;
  }
}

@media (prefers-reduced-motion){[data-ckd]{animation:unset!important;transition:none!important}}[data-ckd=boing]:checked,[data-ckd=boing][aria-checked=true]{animation:a .2s cubic-bezier(.4,0,.2,1) 3}@keyframes a{0%{transform:translateY(3px) scaleY(.8)}50%{transform:translateY(-10px)}90%{opacity:.7;transform:translateY(2px) scale(1.5,.5)}}[data-ckd=boom]:checked,[data-ckd=boom][aria-checked=true]{animation:b .8s cubic-bezier(.4,0,.2,1) 1}@keyframes b{10%,20%{transform:scale3d(.8,.8,.8) rotate(-6deg)}30%,50%,70%,90%{transform:scale3d(1.2,1.2,1.2) rotate(6deg)}40%,60%,80%{transform:scale3d(1.2,1.2,1.2) rotate(-6deg)}}[data-ckd=flag]:checked,[data-ckd=flag][aria-checked=true]{animation:c .6s cubic-bezier(.4,0,.2,1) 1}@keyframes c{0%{transform-origin:right bottom;transform:rotate(-90deg);opacity:0}}[data-ckd=flip]:checked,[data-ckd=flip][aria-checked=true]{animation:d .6s cubic-bezier(.4,0,.2,1)}@keyframes d{0%{transform:translateX(100%) perspective(600px) rotateY(-180deg);opacity:0}}[data-ckd=flush]:checked,[data-ckd=flush][aria-checked=true]{animation:e .7s cubic-bezier(0,0,.2,1) 1}@keyframes e{0%{opacity:1}60%{transform:rotate(4turn) scale(0);opacity:0}}[data-ckd=ghost]:checked,[data-ckd=ghost][aria-checked=true]{animation:f .3s cubic-bezier(0,0,.2,1) 1}@keyframes f{0%{transform:scaleY(.2) translateY(100%);filter:blur(20px);opacity:0}}[data-ckd=inout]:checked,[data-ckd=inout][aria-checked=true]{animation:g .3s cubic-bezier(0,0,.2,1)}@keyframes g{30%{transform:scale(1.3)}70%{transform:scale(.3)}}[data-ckd=jelly]{transform-origin:center}[data-ckd=jelly]:checked,[data-ckd=jelly][aria-checked=true]{animation:h .8s cubic-bezier(0,0,.2,1) 1}@keyframes h{0%,11%,to{transform:none}22%{transform:skewX(-12.5deg) skewY(-12.5deg)}33%{transform:skewX(6.25deg) skewY(6.25deg)}44%{transform:skewX(-3.12deg) skewY(-3.12deg)}55%{transform:skewX(1.56deg) skewY(1.56deg)}66%{transform:skewX(-.78deg) skewY(-.78deg)}77%{transform:skewX(.39deg) skewY(.39deg)}88%{transform:skewX(-.19deg) skewY(-.19deg)}}[data-ckd=jump]:checked,[data-ckd=jump][aria-checked=true]{animation:i .35s cubic-bezier(0,0,.2,1)}@keyframes i{50%{transform:scale(.6) translateY(-10px)}}[data-ckd=metal]:checked,[data-ckd=metal][aria-checked=true]{animation:j 1s cubic-bezier(.4,0,1,1) 1}@keyframes j{0%{transform:rotate3d(1,3,0,90deg)}10%{transform:rotate3d(1,3,0,-90deg)}30%{transform:rotate3d(3,0,2,60deg)}50%{transform:rotate3d(3,0,2,-60deg)}70%{transform:rotate3d(3,0,2,30deg)}80%{transform:rotate3d(3,0,2,-30deg)}90%{transform:rotate3d(3,0,2,10deg)}}[data-ckd=omg]:checked,[data-ckd=omg][aria-checked=true]{animation:k .5s cubic-bezier(.4,0,.2,1)}@keyframes k{59%{transform:translateY(-4px)}60%{transform:translateX(-8px) translateY(12px)}70%{transform:translateY(-8px)}80%{transform:translateX(8px)}90%{transform:scale(.4)}}[data-ckd=pepe]:checked,[data-ckd=pepe][aria-checked=true]{animation:l .6s cubic-bezier(.4,0,.2,1) infinite}@keyframes l{0%,33%,66%,to{transform:rotate(4deg)}16%,50%,83%{transform:rotate(-4deg)}}[data-ckd=pulse]:checked,[data-ckd=pulse][aria-checked=true]{animation:m .8s cubic-bezier(.4,0,.2,1) infinite}@keyframes m{14%,42%{transform:scale(1.3)}28%,70%{transform:scale(1)}}[data-ckd=rewind]:checked,[data-ckd=rewind][aria-checked=true]{animation:n .2s cubic-bezier(0,0,.2,1) 1}@keyframes n{0%{transform:scale(.3) translateX(80%)}50%{transform:skewX(-30deg) scale(.8) rotate(0deg) translateX(-80%);filter:blur(.5px);box-shadow:10px 0 0 hsla(0,0%,47.1%,.2)}90%{transform:skewX(30deg) rotate(0deg)}}[data-ckd=roll]:checked,[data-ckd=roll][aria-checked=true]{animation:o .5s cubic-bezier(0,0,.2,1) 1}@keyframes o{0%{transform:rotateX(-1turn)}}[data-ckd=rollin]:checked,[data-ckd=rollin][aria-checked=true]{animation:p .7s cubic-bezier(.4,0,.2,1)}@keyframes p{0%{opacity:0;transform:translate3d(-100%,0,0) rotate(-120deg)}to{transform:none}}[data-ckd=rotate]:checked,[data-ckd=rotate][aria-checked=true]{animation:q .6s cubic-bezier(0,0,.2,1) 1}@keyframes q{0%{transform:rotate(-1turn)}}[data-ckd=rubber]:checked,[data-ckd=rubber][aria-checked=true]{animation:r .5s;animation-direction:alternate}[data-ckd=rubber]:active:not(:checked){transform:scale(.6,1.2)}[data-ckd=rubber]:active:checked{transform:scale(1.2,.6)}@keyframes r{0%{transform:scale(1)}30%{transform:scale(1.25,.75)}40%{transform:scale(.75,1.25)}50%{transform:scale(1.15,.85)}65%{transform:scale(.95,1.05)}75%{transform:scale3d(1.05,.95,1)}}[data-ckd=smokin]:checked,[data-ckd=smokin][aria-checked=true]{animation:s .5s cubic-bezier(0,0,.2,1) 1}@keyframes s{0%{opacity:0;filter:blur(10px);transform:scale(.3)}}[data-ckd=splash]:checked,[data-ckd=splash][aria-checked=true]{animation:t .8s cubic-bezier(0,0,.2,1)}@keyframes t{0%{transform:scale(.3)}20%{transform:scale(1.1)}40%{transform:scale(.9)}60%{opacity:unset;transform:scale(1.03)}80%{transform:scale(.97)}}[data-ckd=tada]{will-change:transform}[data-ckd=tada]:checked,[data-ckd=tada][aria-checked=true]{animation:u .6s 1}@keyframes u{0%{transform:scale3d(0,0,0) translateY(-100px);animation-timing-function:cubic-bezier(.6,.06,.68,.2)}60%{opacity:1;transform:scale3d(.475,.475,.475) translateY(10px);animation-timing-function:cubic-bezier(.18,.895,.32,1)}}[data-ckd=tv]:checked,[data-ckd=tv][aria-checked=true]{animation:v .3s cubic-bezier(0,0,.2,1)}@keyframes v{50%{transform:scale(.6) rotateY(100deg) skew(45deg);filter:hue-rotate(50deg) saturate(50%)}70%{transform:scale(.8) rotateY(200deg) skew(70deg);filter:hue-rotate(150deg) saturate(50%)}90%{transform:scale(1) rotateY(500deg) skew(20deg);filter:hue-rotate(2500deg) saturate(50%)}}[data-ckd=up]:checked,[data-ckd=up][aria-checked=true]{animation:w .15s cubic-bezier(.4,0,.2,1) 1;animation-fill-mode:forwards}@keyframes w{to{transform:translateY(-10px)}}[data-ckd=vibration]:checked,[data-ckd=vibration][aria-checked=true]{animation:x .1s cubic-bezier(.4,0,.2,1) infinite}@keyframes x{50%{transform:skewY(3deg) skewX(-3deg) scale(1.2)}}[data-ckd=wave]:checked,[data-ckd=wave][aria-checked=true]{animation:y .6s cubic-bezier(.4,0,.2,1) infinite}@keyframes y{50%{transform:skewY(2deg) skewX(-2deg) scale(1.16)}}[data-ckd=yo]:checked,[data-ckd=yo][aria-checked=true]{animation:z .15s cubic-bezier(.4,0,.2,1);animation-fill-mode:forwards}@keyframes z{to{transform:rotate(-45deg) translateZ(0)}}[data-ckd=zoom]:checked,[data-ckd=zoom][aria-checked=true]{animation:A .4s cubic-bezier(.4,0,.2,1)}@keyframes A{50%{transform:scale(2);filter:blur(1px)}60%{transform:scale(0);opacity:0}}


  </style>

    <body style="background-image: url({{ URL::asset("theme/assets/images/bg-1.png") }})">
        <!-- Begin page -->
        <div id="wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row center" >
                          <div class="col-md-12">

                              <div class=" d-flex justify-content-center p-4">
                                  <div class="shadow  p-4 bg-white feedback-width" style="border-radius: 20px; margin-top:10%;">
                                    <div id="slides">
                                     <div class="text-center"> <img src="/storage/app/{{$companySetting->company->logo }} " alt="" width="50"  class="rounded-circle img-fluid">
                                     </div>
                                      <p class="font-18 text-primary">{{ $locationName }}</p>
                                    </div> 
                                     
                                    <div class="hidden_fields">
                                      <input type="hidden" id="location_id" value="{{$deviceSurveys->location_id}}"/>
                                      <input type="hidden" id="device_id" value="{{$deviceSurveys->id}}"/>
                                      <input type="hidden" id="feedback_id" value=""/>
                                      <input type="hidden" id="customer_id" value=""/>                                     
                                     </div>                                                                                                                     
                                             @foreach ($deviceSurveys->latestSurvey as $survey)
                                             <input type="hidden" id="survey_id" value="{{$survey->id}}"/>
                                             @foreach ($survey->questions as $question)
                                               @if($question->type=="emoji")                                              
                                                <div class="toggle">
                                                  <div class="app">
                                                    <h3 class="text-center" >{{$question->question}}</h3>
                                                    <div class="container">
                                                      @foreach ($question->options as $option)
                                                      <div class="item">                                                     
                                                        <label for="{{$option->id}}">
                                                        <input class="radio" type="radio" name="feedback" id="{{$option->id}}" value="{{$option->value}}">
                                                        <span class="far fa-3x emoji {{$question->id}}" id="emoji_{{$question->id}}_{{$option->id}}" style="color:{{$option->colour}}">{!! $option->value !!}</span>
                                                      </label>
                                                      </div>
                                                      @endforeach          
                                                    </div>
                                                </div>
                                                <div class="pt-4">
                                                  <div class="pull-left"><button id="previous_{{$question->id}}" type="button" class="btn-circle btn previous btn-success waves-light waves-effect"> <i class="fa fa-arrow-left"></i></button></div>
                                                  <div class="pull-right"><button id="next_{{$question->id}}" type="button" class="btn-circle btn next btn-success waves-light waves-effect "> <i class="fa fa-arrow-right"></i></button></div>
                                                </div>
                                              </div>
                                              @elseif($question->type=="single")   
                                              <div class="toggle">
                                                <div class="app">
                                                  <h3 class="text-center" >{{$question->question}}</h3>
                                                  <div>
                                                    @foreach ($question->options as $option)
                                                    <div style="display: flex">                                                                  
                                                      <input type="radio" name="radiobutton"  id="emoji_{{$question->id}}_{{$option->id}}"  class="optionSelection abc emoji mt-1 {{$question->id}}"  value="{{$option->id}}" data-ckd="splash"/>
                                                      <label class="ml-2"  for="emoji_{{$question->id}}_{{$option->id}}">{{$option->label}}</label>           
                                                      </div>                                                   
                                                    @endforeach          
                                                  </div>
                                              </div>
                                              <div class="pt-4">
                                                <div class="pull-left"><button id="previous_{{$question->id}}" type="button" class="btn-circle btn previous btn-success waves-light waves-effect"> <i class="fa fa-arrow-left"></i></button></div>
                                                <div class="pull-right"><button id="next_{{$question->id}}" type="button" class="btn-circle btn next btn-success waves-light waves-effect "> <i class="fa fa-arrow-right"></i></button></div>
                                              </div>
                                            </div>  
                                            @elseif($question->type=="multiple")  
                                            <div class="toggle">
                                              <div class="app">
                                                <h3 class="text-center" >{{$question->question}}</h3>
                                                <div>
                                                  @foreach ($question->options as $option)
                                                  <div style="display: flex">  
                                                    <input type="checkbox" class="multiple_{{$question->id}} mt-1"  id="multiple_{{$question->id}}_{{$option->id}}" name="multiple_{{$question->id}}_{{$option->id}}" value="{{$option->id}}" data-ckd="splash"/>
                                                    <label class="ml-2" for="multiple_{{$question->id}}_{{$option->id}}">{{$option->label}}</label><br>   
                                                    </div>                                                   
                                                  @endforeach  
                                                  {{-- used    --}}
                                                  {{-- <button class="multipleNext btn btn-success btn-rounded" id="multiple_{{$question->id}}">Next</button>                                                              --}}
                                               
                                                  <button class="multipleNext btn btn-sm btn-success btn-rounded" id="multiple_{{$question->id}}">Next</button>                                                             
                                                </div>
                                            </div>
                                            <div class="pt-4">
                                              <div class="pull-left"><button id="previous_{{$question->id}}" type="button" class="btn-circle btn previous btn-success waves-light waves-effect"> <i class="fa fa-arrow-left"></i></button></div>
                                              <div class="pull-right"><button id="next_{{$question->id}}" type="button" class="btn-circle btn next btn-success waves-light waves-effect "> <i class="fa fa-arrow-right"></i></button></div>
                                            </div>
                                          </div>   
                                               @endif                                            
                                             @endforeach
                                             @endforeach


                                             <div class="toggle">                                            
                                                <div class="app">
                                                  <div class="row">                                                
                                                     <div class="col-md-12">
                                                          <div class="text-center mt-3"><img src="/storage/app/company/tick.gif" height="100px"  alt="" ></div>
                                                          <div class="text-center mt-4 mb-5"><h3>Your feedback submitted<br/> Thank You  </h3></div>
                                                          {{-- <div class="text-left"><button type="submit" class="btn btn-success  btn-rounded">Submit</button></div> --}}
                                                          <span class="pull-left"><button type="button" id="back" class="btn btn-success btn-sm  btn-rounded"><i class="mdi mdi-arrow-left-bold"></i> Home</button></span>
                                                          <span class="pull-right"><button id="next_{{$question->id}}" type="button" class="btn btn-success next btn-sm  btn-rounded">Submit Your Info</button></span>
                                                          <div class="clearfix"></div>
                                                        </div>
                                              </div>
                                      </div>
                                    
                                    </div>
                                             


                                            <div class="toggle">
                                              <form id="customer_info">
                                                <div class="app">
                                                 <h3 class="text-center">Your information</h3>
                                                  <div class="row">                                                
                                                     <div class="col-md-12">
                                                          <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="John Smith"></div>
                                                         <p class="text-danger text-left" id="name_field"></p>
                                                       
                                                          <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="+92 346 1234567"></div>
                                                          <p class="text-danger text-left" id="phone_field"></p>

                                                          <div class="mb-3"><input type="text" name="email" class="form-control" placeholder="john@company.com"></div>
                                                          <p class="text-danger text-left" id="email_field"></p>
                                                          
                                                          {{-- <div class="text-left"><button type="submit" class="btn btn-success  btn-rounded">Submit</button></div> --}}
                                                          <div class="text-left"><button type="submit" class="btn btn-success btn-sm  btn-rounded">Submit</button></div>

                                                        </div>
                                              </div>
                                      </div>
                                    </form>
                                   </div>

                                   {{-- <div class="pt-4">
                                    <div class="pull-left"><button id="previous" type="button" class="btn-circle btn  btn-success waves-light waves-effect"> <i class="fa fa-arrow-left"></i></button></div>
                                    <div class="pull-right"><button id="next" type="button" class="btn-circle btn  btn-success waves-light waves-effect "> <i class="fa fa-arrow-right"></i></button></div>
                                  </div> --}}
                                             </div>                                  
                                            </div>
                              </div>                             
                            </div>
                    </div> <!-- container -->
                </div> <!-- content -->

                <footer class="footer">
                  <div>We will love to get your feedback.</div>
                  <div>Powered by <a href="http://www.cybexo.com" target="_blank">Cybexo, Inc.</a></div>
                </footer>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

    <!-- jQuery  -->
    <script src={{ asset('theme/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('theme/assets/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('theme/assets/js/metisMenu.min.js') }}></script>
    <script src={{ asset('theme/assets/js/waves.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.slimscroll.js') }}></script>
    
    <!-- App js -->
    <script src={{ asset('theme/assets/js/jquery.core.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.app.js') }}></script>

        <script>           
            //Waiting for images to be loaded 
    $(window).on("load", function() {
      $('#loading').slideUp();
      $('#slides').fadeIn('slow');
      //Prevent having no "active" slide
      var $el = $('.toggle.active');
      if (!$el.length) {
        $('.toggle').first().addClass('active');
      }
    });

  $('.previous').click(function() {
    
    var $el = $('.active').prev('.toggle');
    if (!$el.length) //If no previous, s$elect last
    {
    // $el = $('.toggle').last();;
    }
    else
    {
      $('.active').removeClass('active');
    $el.addClass('active');
    }

  });

    $('.next').click(function() {

      moveNext();
    });

  function moveNext()
  {
    var $el = $('.active').next('.toggle');
    if (!$el.length) //If no next, s$elect first
    {
    // $el = $('.toggle').first();
    }
    else
    {
      $('.active').removeClass('active');
    $el.addClass('active');
    }
  }

  $('#back').click(function() {
    location.reload()
    });

   </script>
  <!--Sweet Alert -->
<script src={{ asset('theme/plugins/sweet-alert/sweetalert2.min.js') }}></script>
<script src={{ asset('theme/assets/pages/jquery.sweet-alert.init.js') }}></script>
<script src="{{ asset('assets/js/createFeedback.js') }}"></script>
<script src="{{ asset('assets/js/createCustomer.js') }}"></script>
<script src="{{ asset('assets/js/createMulipleChoiceFeedback.js') }}"></script>
</body>
</html>