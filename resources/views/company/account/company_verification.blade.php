<!-- App favicon -->
<link rel="shortcut icon" href={{ asset('theme/assets/images/survey-fav.png') }}>


<!-- App css -->
<link href={{ asset('theme/assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
<link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
<link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
<link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://www.technicalkeeda.com/js/javascripts/plugin/jquery.validate.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script>
function validatePassword() {
    if($('#password').val() != $('#password-confirm').val() ){
            $('.msg_password_mismatch').fadeIn(2000);
            return false;
            e.preventDefault();
            
        }
        $( "#frmForgot" ).submit();



        var validator = $("#frmForgot").validate({
            rules: {
                password: "required",
                confirmpassword: {
                    equalTo: "#password-confirm"
                }
            },
            messages: {
                password: " Enter Password",
                confirmpassword: " Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            alert('Sucess');
        }

       
    }


</script>

<div class="container-fluid">
  <div class="col-lg-5" style="padding-top: 10%; margin:0 auto;  border-radius: 5px;">
    <div class="card-box p-5">
      <div class="text-center pb-3">
          <img src="https://tms.cybexo.net/theme/assets/images/cybexo_logo.png" height="69">
      </div>
      @if($expired)
        <div class="text-danger text-center font-18">
          <p>Your Activation link has been expired! please contact with Service Provider!</p>
        </div>
      @else
        <p class="text-center  ">Please enter the password to activate your account</p>

        @if(session()->has('message'))
          <div class="alert alert-success" id="myElem">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->pull('message') }}
          </div>
        @endif
          @if(session()->has('error'))
            <div class="alert alert-danger" id="myElem" >
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session()->pull('error') }}
            </div>
        @endif
          <form  action="{{ route('set-password') }}" onSubmit="return validatePassword();" method="post" id="frmForgot">
            @csrf
            <div class="form-group row"  >
              <div class="col-12">
                <p>{{@$message}}</P>
                <input type="hidden" value="{{ request()->get('token') }}" name="token" />
                <div class="alert alert-danger msg_password_mismatch  " id="myElem2">
                    <button type="button" class="close" data-dismiss="alert" onclick="myFunction()" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                          Password and Confirm password is not matched.
                </div>
                <div class="input-group" >                 
                  <input  type="password" class="form-control @error('email') is-invalid @enderror" value="" id="password" placeholder="Enter Password"  name="password" autocomplete="new-password"   minlength="6" required=""   >
                   @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{$errors->first('password')}}</strong>
                      </span>
                  @enderror
                   
                    <i  type="button" id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()" style="background: #ccc; border-top-right-radius: 5px; border-bottom-right-radius: 5px;" ></i>
                </div>
                <br>
                <div class="input-group">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Enter confirm Password" required autocomplete="new-password" value=""  >
                  @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmations') }}</strong>
                    </span>
                  @enderror
                  <i  type="button" id="confirm-pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword1()" style="background: #ccc; border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></i>    
                </div>
                <br>                      
                <div>
                  <button type="submit"   name="btnsubmit" class="btn btn-primary btn-block  " >
                      Active Account
                  </button>
                </div>
              </div>
            </div>
          </form>
      @endif    
    </div>  
  </div>
</div>


<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>

<script>            
        function myFunction() {
    var x = document.getElementById("myElem2");
    if (x.style.display === "none") {
      x.style.display = "block";
       } else {
          x.style.display = "none";
        }
      }

function viewPassword()
{
  var passwordInput = document.getElementById('password');
  var passStatus = document.getElementById('pass-status');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
  }
}


function viewPassword1()
{
  var passwordInput = document.getElementById('password-confirm');
  var passStatus = document.getElementById('confirm-pass-status');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
  }

}
  $(document).ready(function(){      
        setTimeout(function() 
          { $("#myElem2").hide(); 
          }, 0000);
          }) 
</script>

<style>
   .fa-eye, .fa-eye-slash{
        border: 1px solid #ccc;
    padding: 9px 13px;
    background-color: rgb(255, 255, 255);
  }
 </style> 