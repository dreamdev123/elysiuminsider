@extends('panel._layouts.panel', ['ACTIVE_LIST' => 'insider_home'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}">
    <style type="text/css">
        .trading-page-content {
            min-height: calc(100vh - 65px);
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .introduction_top_title {
            font-family: 'DIN Pro Condensed Bold' !important;
            color: #FFFFFF;
            font-size: 40px;
            margin-top: 50px;
            padding-bottom: 50px;
        }
        .introduction_title {
            font-family: 'DIN Pro Condensed Bold' !important;
            color: #00aeaa;
            font-size: 30px;
            margin-top: 30px;
        }
        .introduction_content {
            font-family: 'Raleway Regular' !important;
            font-size: 20px;
            color: #FFFFFF;
            text-align: justify;
        }
        .introduction_footer {
            font-family: 'Raleway Regular' !important;
            font-size: 14px;
            color: #FFFFFF;
            text-transform: uppercase;
            text-align: justify;
        }
    </style>
@endsection


@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')
<div class="bg-login-image">
    <div class="container trading-page-content" data-backgound="register-bg">
        <div class="col-lg-12 available_content" style="min-height:500px; justify-content: center; align-self: center; margin-top: 50px;">
            <h2 class="introduction_top_title text-center">DAILY PRICE CHARTS</h2>
            <div class="row">
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="BTC" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="ETH" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="ADA" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="LINK" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="AAVE" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="LTC" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="XRP" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
                <div class="col-lg-6">
                    <script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script> <div class="livecoinwatch-widget-1 mx-auto" lcw-coin="UNI" lcw-base="USD" lcw-secondary="BTC" lcw-period="d" lcw-color-tx="#ffffff" lcw-color-pr="#8ed1fc" lcw-color-bg="#171b26" lcw-border-w="1" ></div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
</script>
@endsection

