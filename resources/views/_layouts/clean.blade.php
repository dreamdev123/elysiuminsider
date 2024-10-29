<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Elysium Insider</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ElysiumFavicon.png') }}">

    <!-- Bootstrap -->

    <link href="{{ asset('css/bootstrap_4.1.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/meanmenu.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/dashboard_fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all_5.10.20.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{asset('js/jquery.meanmenu.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- BEGIN PAGE LEVEL STYLES -->
@yield('PAGE_LEVEL_STYLES')
<!-- END PAGE LEVEL STYLES -->
</head>
<body>
<!-- BEGIN PAGE START SECTION -->
@yield('PAGE_START')
<!-- END PAGE START SECTION -->

@include('_includes.clean_header')
@yield('content')


<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="{{ asset('js/bootstrap_4.1.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('PAGE_LEVEL_SCRIPTS')
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE END SECTION -->
@yield('PAGE_END')
<!-- END PAGE END SECTION -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162285463-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-162285463-1');
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.meanmenu-div .menamenu-nav').meanmenu({
            meanScreenWidth: '992'
        });
    });
</script>
<script type="text/javascript">        
    $('.headerSection').show();
</script>
</body>
</html>
