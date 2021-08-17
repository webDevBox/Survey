<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- App css -->
    <link rel="shortcut icon" href={{ asset('theme/assets/images/survey-fav.png') }}>

    <link href={{ asset('theme/assets/css/bootstrap.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/metismenu.min.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('theme/assets/css/style.css') }} rel="stylesheet" type="text/css" />
</head>
<style>

@media print {
#qrcode{
    
     text-align: center;
     justify-content:center;
     align-items:center;
     top:30%;
     text-align: center;
     position: relative;
     }
    html, body{
      height:100%;
      width:100%;

      
    }
}
</style>
<body>    
    <div class=" text-center align-self-center  justify-content-center" id="qrcode">
        
        <h2 class="text-uppercase" style="margin-top: 10%">{{$qr_title}}</h2>    
                @php $path = route('question-list', $id) @endphp
                {!! QrCode::size(250)->generate($path); !!}
            
    </div>   
    <div align="center" class="mt-3">
        <button class="btn btn-primary text-center" onclick="qrcode()"><i class="fa fa-print"></i> PRINT</button>
    </div>
</body>

<script src={{ asset('theme/assets/js/jquery.min.js') }}></script>
<script src={{ asset('theme/assets/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('theme/assets/js/metisMenu.min.js') }}></script>
<script src={{ asset('theme/assets/js/waves.js') }}></script>
<script src={{ asset('theme/assets/js/jquery.slimscroll.js') }}></script>

<!-- App js -->
<script src={{ asset('theme/assets/js/jquery.core.js') }}></script>
<script src={{ asset('theme/assets/js/jquery.app.js') }}></script>

<script src={{ asset('theme/assets/js/modernizr.min.js') }}></script>

<script>
    function qrcode()
    {
        var restorepage = $('body').html();
        var printcontent = $('#qrcode').clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    </script>

</html>