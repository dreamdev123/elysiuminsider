<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SafeCharge Payment Result</title>
    <link href="{{ asset('css/bootstrap_4.1.3.min.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap_4.1.3.min.js') }}" type="text/javascript"></script>
    <style>
        .admin-login-wrapper .form-wrapper h3 {
            font-size: 24px;
            font-weight: 300;
            white-space: nowrap;
        }
        .admin-login-wrapper .dropdown-menu {
            min-width: 5rem;
        }
        .admin-login-wrapper .dropdown-menu a {
            background-position: 10%;
            background-size: auto;
            background-repeat: no-repeat;
            padding-left: 34px;
            font-size: 14px;
        }
        .admin-login-wrapper .dropdown-menu .us-sel {
            background-image: url('../images/Image/flags_iso/16/us.png');
        }
        .admin-login-wrapper .dropdown-menu .se-sel {
            background-image: url('../images/Image/flags_iso/16/se.png');
        }
        .has-error {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-login-wrapper bg-dark vh-100">
        <div class="logo-wrapper d-flex ml-auto mr-auto mb-4 pt-5"><img src="{{ asset('images/InsiderLogoW.svg') }}" style="width: 280px;" class="ml-auto mr-auto mt-5"></div>
        <div class="form-wrapper ml-auto mr-auto p-4 bg-white " style="max-width: 550px; height: auto;">
            <h3 class="mt-4 mb-4">Oops You have failed with SafeCharge Payment</h3>
            
            <a href="{{ route('home') }}"> <button class="btn btn-dark pull-right ml-auto rounded-0 px-4 py-1"> <i class="fa fa-arrow-circle-left"></i> Back</button></a>
        </div>
    </div>
</body>
</html>