<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Elysium Insider Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ElysiumFavicon.png') }}">

    <!-- Bootstrap -->

    <link href="{{ asset('css/bootstrap_4.1.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard_fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all_5.10.20.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{asset('plugin/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css" />

    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->
  	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  	<link href="{{ asset('css/admin-draft.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('slick/slick-theme.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet">
    {{--    table ajax--}}
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    {{--    table ajax      --}}
    <!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.27/moment-timezone-with-data.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="{{ asset('js/bootstrap_4.1.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>

    <!-- BEGIN PAGE LEVEL STYLES -->
	@yield('PAGE_LEVEL_STYLES')
<!-- END PAGE LEVEL STYLES -->
</head>

<body>
<!-- BEGIN PAGE START SECTION -->
@yield('PAGE_START')
<!-- END PAGE START SECTION -->

  <div class="capital-admin-container">
		@include('admin._include.navbar')

    <div class="wrapper">
    	@include('admin._include.sidemenu')

        
        @yield('content')


    </div>

    @include('panel._includes.footer')

  </div>

<script>
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

$('.profileNav').click(function () {
    $(this).addClass('active').siblings().removeClass('active');
    let target = $('.profilePanel[data-target="' + $(this).attr('data-target') + '"]');
    target.addClass('active').siblings().removeClass('active');
});

</script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('PAGE_LEVEL_SCRIPTS')
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE END SECTION -->
@yield('PAGE_END')
<!-- END PAGE END SECTION -->
</body>
</html>