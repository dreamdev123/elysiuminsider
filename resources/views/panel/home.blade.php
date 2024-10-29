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
            font-size: 36px;
            margin-top: 50px;
            padding-bottom: 20px;
        }
        .introduction_title {
            font-family: 'DIN Pro Condensed Bold' !important;
            color: #00aeaa;
            font-size: 30px;
            margin-top: 30px;
        }
        .introduction_content {
            font-family: 'DIN Pro Condensed Regular' !important;
            font-size: 20px;
            color: #FFFFFF;
            text-align: justify;
        }
        .introduction_footer {
            font-family: 'DIN Pro Condensed Regular' !important;
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
        <div class="col-lg-10 offset-lg-1 available_content" style="min-height:500px; justify-content: center; align-self: center; margin-top: 50px;">
            <h2 class="introduction_top_title">EVERYBODY CAN CAPITALISE ON THE FINANCIAL RENAISSANCE 2.0</h2>
            <h3 class="introduction_title">WE MAKE CRYPTO TRADING-INVESTING AS EASY AS 1 2 3</h3>
            <p class="introduction_content">Quantitative market analysis designed to give you an edge.</p>
            <h3 class="introduction_title">KNOW WHAT TO DO</h3>
            <p class="introduction_content">Elysium Insider provides independent and actionable research and analytics to our global subscribers to improve their investment and trading decisions.</p>
            <h3 class="introduction_title">WE KEEP IT SIMPLE</h3>
            <p class="introduction_content">Our vision is to be the most trusted, affordable global independent research and analysis provider for the independent participant by keeping things simple. Period.</p>
            <h3 class="introduction_title">BUY - SELL - HODL</h3>
            <p class="introduction_content">We will keep you instantly updated whenever needed regarding entries and exits. We keep it short and simple. You do not need financial or technical experience.</p>
            <h3 class="introduction_title">GET EXCLUSIVE ACCESS TO ACTIONABLE RESEARCH & ANALYSIS OPINIONS</h3>
            <p class="introduction_content" style="margin-bottom: 0;">- Live Feed QUANT EA indicators, Premium reports and publications.</p>
            <p class="introduction_content" style="margin-bottom: 0;">- Updated risk analysis data with actionable insights.</p>
            <p class="introduction_content" style="margin-bottom: 0;">- Long term shifts in Bitcoin, Ethereum and large caps price analysis.</p>
            <p class="introduction_content" style="margin-bottom: 0;">- Easy to follow in live stream video, webinars and written form.</p>
            <p class="introduction_footer" style="margin-top: 80px;">DISCLAIMER: WE GENERATE INFORMATION AND OPINIONS - NOT FINANCIAL ADVICE</p>
            <p class="introduction_footer">ELYSIUM INSIDER DOES NOT MAKE ANY EXPRESS OR IMPLIED WARRANTIES, REPRESENTATIONS OR ENDORSEMENTS WHATSOEVER WITH REGARD TO THE REPORTS/INDICATORS. IN PARTICULAR, YOU AGREE THAT ELYSIUM INSIDER ASSUMES NO WARRANTY FOR THE CORRECTNESS, ACCURACY AND COMPLETENESS OF THE REPORTS/INDICATORS.</p>
            <p class="introduction_footer">YOU ARE SOLELY RESPONSIBLE FOR YOUR OWN INVESTMENT DECISIONS. WE ARE NEITHER LIABLE NOR RESPONSIBLE FOR ANY INJURY, LOSSES OR DAMAGES ARISING IN CONNECTION WITH ANY INVESTMENT DECISION TAKEN OR MADE BY YOU BASED ON INFORMATION WE PROVIDE. NOTHING CONTAINED IN THE REPORT/INDICATORS SHALL CONSTITUTE ANY TYPE OF INVESTMENT ADVICE OR RECOMMENDATION (I.E., RECOMMENDATIONS AS TO WHETHER OR NOT TO “BUY”, “SELL”, “HOLD”, OR TO ENTER OR NOT TO ENTER INTO ANY OTHER TRANSACTION INVOLVING ANY CRYPTO ASSETS). ALL INFORMATION PROVIDED BY ELYSIUM INSIDER IS IMPERSONAL AND NOT TAILORED TO YOUR NEEDS.</p>
            <p class="introduction_footer">BY USING THIS REPORT/BLOG, YOU ACKNOWLEDGE THESE DISCLAIMERS.</p>
        </div>
    </div>
</div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
</script>
@endsection

