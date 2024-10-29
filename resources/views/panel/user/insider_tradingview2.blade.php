@extends('panel._layouts.panel', ['ACTIVE_LIST' => 'insider_tradingview2'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}" >
    <style type="text/css">
        .trading-page-content {
            min-height: calc(100vh - 65px);
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .setting-icon {
            width: 35px;
            height: 35px;
            border-radius: 5px 0 0 5px;
            position: absolute;
            right: 0;
            top: 250px;
            z-index: 5;
        }
        .popover-image {
            width: 140px;
            height: auto;
            display: flex;
            margin-left: auto;
            margin-right: auto;
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
        <img src="{{asset('images/settings.gif')}}" class="setting-icon" data-placement="left">
        <div class="example-popover" style="display: none;">
            <p>For the best quality,<br/> please select 720p.</p>
            <img src="{{asset('images/example.png')}}" class="popover-image">
        </div>
        <!-- <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://vimeo.com/event/736271/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>
        <div style="padding:56.25% 0 0 0;position:relative; margin-top: 30px;"><iframe src="https://vimeo.com/event/736275/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div> -->

        

        <div style="height:690px; width:990px; overflow: hidden;">
            <iframe width="990px"    src="https://www.youtube.com/embed/Dh9AUBN_qyU?theme=dark&autoplay=1&autohide=0&cc_load_policy=1&modestbranding=1&fs=0&showinfo=0&rel=0&iv_load_policy=3&mute=0" style="height:690px;  background:#000000; bottom: 60px; position: relative;" sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin allow-top-navigation"></iframe>
        </div>

        <div style="height:690px; width:990px; overflow: hidden;">
            <iframe width="990px"    src="https://www.youtube.com/embed/sq5U1Mzk6Xo?theme=dark&autoplay=1&autohide=0&cc_load_policy=1&modestbranding=1&fs=0&showinfo=0&rel=0&iv_load_policy=3&mute=0" style="height:690px;  background:#000000; bottom: 60px; position: relative;" sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin allow-top-navigation"></iframe>
        </div>
    </div>
</div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
    $(function () {
        $('[data-toggle="popover"]').popover()
      $('.setting-icon').popover({
        container: 'body',
        content: $('.example-popover').html(),
        html: true,
        placement: 'left',
        trigger: 'hover'
      })
    })
</script>
@endsection
