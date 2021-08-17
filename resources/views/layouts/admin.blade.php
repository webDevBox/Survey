<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8" />
    <title>Survey Form | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href={{ asset('theme/plugins/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/plugins/datatables/buttons.bootstrap4.min.css') }} rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href={{ asset('theme/plugins/datatables/responsive.bootstrap4.min.css') }} rel="stylesheet" type="text/css" />

    <!-- Multi Item Selection examples -->
    <link href={{ asset('theme/plugins/datatables/select.bootstrap4.min.css') }} rel="stylesheet" type="text/css" />

    <link href={{ asset('theme/plugins/select2/css/select2.min.css') }} rel="stylesheet" type="text/css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('theme/assets/images/survey-fav.png') }}>
    
    <!-- switchery -->
    <link href={{ asset('theme/plugins/switchery/switchery.min.css') }} rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href={{ asset('theme/assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />

    <script src={{ asset('theme/assets/js/modernizr.min.js') }}></script>

    <!-- FontAwesome Kit-->
    <script src="https://kit.fontawesome.com/6926415b32.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    @yield('styles')
</head>

<body>
    <div id="wrapper">
        @include('layouts.adminSidebar')

         <div class="content-page"> 
            @include('admin.dashboard.topbar')
            @yield('content')
         </div> 

        
    </div>
</body>

<!-- jQuery  -->
    <script src={{ asset('theme/assets/js/jquery.min.js') }}></script>
    <script src={{ asset('theme/assets/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('theme/assets/js/metisMenu.min.js') }}></script>
    <script src={{ asset('theme/assets/js/waves.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.slimscroll.js') }}></script>
 
    <!-- Required datatable js -->
    <script src={{ asset('theme/plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('theme/plugins/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Select2 js-->
    <script src={{ asset('theme/plugins/select2/js/select2.min.js') }} ></script>

    <script src={{ asset('theme/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}></script>
    <script src={{ asset('theme/assets/pages/jquery.form-pickers.init.js') }}></script>

    <!-- Toastr js -->
    <script src={{ asset('theme/assets/pages/jquery.toastr.js') }} type="text/javascript"></script>
      
    <!-- switchery -->
    <script src={{ asset('theme/plugins/switchery/switchery.min.js') }} ></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    
    <!-- App js -->
    <script src={{ asset('theme/assets/js/jquery.core.js') }}></script>
    <script src={{ asset('theme/assets/js/jquery.app.js') }}></script>

    <script>
        setTimeout(
        function() 
        {
            $('.shower').attr('style','display:none;');
        }, 4000);
    </script>

   @yield('scripts')

</html>
