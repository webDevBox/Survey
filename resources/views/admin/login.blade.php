<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
    <title>Survey Form | Admin </title>

    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('theme/assets/images/survey-fav.png') }}>

    <!-- App css -->
    <link href={{ asset('theme/assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />

    <style>
        .alert dl, ol, ul
        {
            margin-bottom: 0;
        }
        .alert
        {
            padding-left: 0;
        }
    </style>

    </head>
    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg"></div>

        <div class="wrapper-page account-page-full">
            <div class="card mt-5">
                <div class="card-block">
                    <div class="account-box">
                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="#" class="text-success">
                                    <span>Survey Form Admin App</span>
                                </a>
                            </h2>

                            <form class="" action="{{ route('AdminLogin') }}" method="POST">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                               
                                @csrf
                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email" value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password" value="{{old('password')}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i id="pass-status" onClick="viewPassword()" class="fa fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class=" text-center">
                <p class="account-copyright text-muted">Powered by <a href="http://www.cybexo.com" target="_blank">Cybexo, Inc.</a></p>
            </div>

        </div>

    <script src={{ asset('theme/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('theme/assets/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('theme/assets/js/metisMenu.min.js') }}></script>
    <script src={{ asset('theme/assets/js/waves.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.slimscroll.js') }}></script>

    <!-- App js -->
    <script src={{ asset('theme/assets/js/jquery.core.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.app.js') }}></script>

    <script src={{ asset('theme/assets/js/modernizr.min.js') }}></script>

    </body>

    <script>
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
        </script>

</html>