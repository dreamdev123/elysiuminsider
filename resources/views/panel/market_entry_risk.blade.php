@extends('panel._layouts.panel', ['ACTIVE_LIST' => 'marketEntryRisk'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}" >
    <style type="text/css">
    .entry-risk-page-content {
        min-height: calc(100vh - 65px);
        padding-top: 50px;
        padding-bottom: 50px;
    }
    .side-content {
        background-color: #282f37;
        border-left: 2px solid #DDDDDD;
    }
    .introduction_top_title {
        font-family: 'DIN Pro Condensed Bold' !important;
        color: #FFFFFF;
        font-size: 36px;
        margin-top: 50px;
    }
    .introduction_title {
        font-family: 'DIN Pro Condensed Bold' !important;
        color: #00aeaa;
        font-size: 30px;
        margin-top: 20px;
    }
    .introduction_content {
        font-family: 'DIN Pro Condensed Regular' !important;
        font-size: 20px;
        color: #FFFFFF;
        text-align: justify;
        padding-left: 10px;
        padding-right: 30px;
    }
    .risk_top_title {
        font-family: 'DIN Pro Condensed Bold' !important;
        color: #FFFFFF;
        font-size: 28px;
        margin-top: 50px;
        padding-bottom: 20px;
    }
    .risk_context {
        font-family: 'Din Pro Condensed Regular' !important;
        font-size: 20px;
        color: #FFFFFF;
    }
    .market_logo {
        width: 30px;
        height: 30px;
        margin-right: 20px;
    }
    .green_face {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }
    .red_face {
        width: 30px;
        height: 30px;
        margin-left: 10px;
    }
    .project_section {
        align-items:
        flex-start;
        padding-top: 5px;
    }
    .price_section {
        align-items: flex-start;
        border-right: 1px solid #fff;
        border-left: 1px solid #fff;
        padding-top: 5px;
    }
    .entry_risk_section {
        justify-content: center;
        align-items: flex-start;
        padding-top: 5px;
    }
    .riskbar_section {
        width: 300px;
        min-width: 300px;
    }
    .riskbar_style {
        height: 30px;
        background: linear-gradient(90deg, #00BF10, #FFCE00, #FF3200);
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 25px;
    }
    .low_risk_title {
        color: #fff;
        font-size: 14px;
        padding-left: 10px;
    }
    .high_risk_title {
        color: #fff;
        font-size: 14px;
        padding-right: 10px;
    }
    </style>
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection

@section('content')

<div class="bg-login-image">
    <div class="container entry-risk-page-content" data-backgound="register-bg">
        <div class="row">
            <div class="col-lg-10 offset-lg-1" style="padding-left: 50px;">
                <span class="introduction_top_title">MARKET ENTRY RISK</span><span class="introduction_content" style="font-size: 25px;">(UPDATED: {{$updated}})</span>
                <h3 class="introduction_title">ENTRY LEVELS RISK ASSESSMENT 1:100 REPORT</h3>
                <div style="display: flex; align-items: center; margin-top: 40px;">
                    <img src="{{asset('images/IconCrypto/GreenFace.svg')}}" class="green_face">
                    <span class="introduction_content">0% - 50% = LOWER RISK</span>
                    <img src="{{asset('images/IconCrypto/RedFace.svg')}}" class="green_face">
                    <span class="introduction_content">50% - 100% = HIGHER RISK</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 offset-lg-1 col-md-4 col-sm-8">
                <h2 class="risk_top_title text-center">PROJECT</h2>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">
                <h2 class="risk_top_title text-center">PRICE</h2>
            </div>
            <div class="col-lg-6 col-md-6 d-none d-md-block">
                <h2 class="risk_top_title text-center">MARKET ENTRY RISK</h2>
            </div>
        </div>
        @if(isset($risks) && count($risks) > 0)
            @foreach($risks as $key => $risk)
                <div class="row">
                    <div class="col-lg-3 offset-lg-1 col-md-4 col-sm-8 d-flex project_section">
                        <img src="{{asset('images/IconCrypto')}}/{{$risk['code']}}.svg" class="market_logo">
                        <span class="risk_context" style="flex: 1;">{{$risk['name']}}</span>
                        <span class="risk_context" style="flex: 0.5;">({{$risk['code']}})</span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 text-center d-flex price_section">
                        <span class="risk_context" style="flex: 1;">$ {{$risk['price']}}</span>
                    </div>
                    <div class="col-lg-6 col-md-12 d-flex entry_risk_section">
                        <img src="{{asset('images/IconCrypto/GreenFace.svg')}}" class="green_face">
                        <div class="riskbar_section">
                            <div class="riskbar_section riskbar_style">
                                <span class="low_risk_title">LOW RISK</span>
                                <span class="high_risk_title">HIGH RISK</span>
                            </div>
                            <div style="margin-left: calc(300px - 300px * (1 - {{$risk['percent'] / 100}})); margin-top: -10px; position: relative;">
                                <div style="width: fit-content; width: -moz-fit-content; text-align: center;">
                                    <img src="{{asset('images/IconCrypto/RiskTriangle.svg')}}" style="width: 15px; height: 15px;"><br/>
                                    <p style="color: #fff; font-size: 14px; margin: 0;">{{$risk['percent']}}%</p>
                                </div>
                            </div>
                        </div>
                        <img src="{{asset('images/IconCrypto/RedFace.svg')}}" class="red_face">
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
</script>
@endsection
