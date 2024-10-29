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
    <link href="{{ asset('css/dashboard_fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all_5.10.20.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{asset('plugin/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="{{ asset('slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('slick/slick-theme.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet">
    {{--    table ajax--}}
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"/>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    {{--    table ajax--}}
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <!-- BEGIN PAGE LEVEL STYLES -->
@yield('PAGE_LEVEL_STYLES')
<!-- END PAGE LEVEL STYLES -->
</head>
<body>
<!-- BEGIN PAGE START SECTION -->
@yield('PAGE_START')
<!-- END PAGE START SECTION -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.27/moment-timezone-with-data.js"></script>


@include('panel._includes.navbar')
<div class="row main-content m-0" data-content="content" style="display: none">
    @include('panel._includes.sidemenu')
    <div id="sideContent" class="side-content">
        @section('sidemenu_top')
            @include('panel._includes.sidemenu_top')
        @show
        @yield('content')
    </div>
</div>

@section('footer')
    @include('panel._includes.footer')
@show



<!-- Include all compiled plugins (below), or include individual files as needed -->

<script type="text/javascript" src="{{ asset('plugin/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap_4.1.3.min.js') }}"></script>
<script src="{{ asset('plugin/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>


<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('PAGE_LEVEL_SCRIPTS')
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE END SECTION -->
@yield('PAGE_END')
<!-- END PAGE END SECTION -->
</body>
</html>
<script>
    $('[data-content="content"]').fadeIn(400);

    // custom select lang
    $(".customSelect .dropdown-menu li a").click(function(){
        var selText = $(this).text();
        var img = $(this).find('img').attr('src');
        $(this).parents('.customSelect').find('.dropdown-toggle').html('<img src="' + img +'"/>' + selText + ' <span class="caret"><i class="fas fa-angle-down"></i></span>');
    });

    // custom select currency
    $(".customSelectCurrency .dropdown-menu li a").click(function(){
        var selText = $(this).html();
        $(this).parents('.customSelectCurrency').find('.dropdown-toggle').html(selText + '<span class="caret"><i class="fas fa-angle-down"></i></span>');
    });

    $(document).ready(function(){

        $('.slideBar').on('click', function () {
            $('#slideNav').toggleClass('slideNavClose');
            $('#sideContent').toggleClass('sideContentClose');
        });

        $('body').on('click', '.slideNavClose .search_sidebar_box', function () {
            $('#slideNav').removeClass('slideNavClose');
            $('#sideContent').removeClass('sideContentClose');
        });

    });

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162285463-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-162285463-1');
</script>