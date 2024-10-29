<style type="text/css">
    .coming-soon {
        position: absolute; font-size: 100px; font-weight: 900; color: #fff;
        font-family: "Oswald", Open Sans, Helvetica, sans-serif;
    }
</style>
<div class="mainBannerWrapper">
    <div class="button-group-area">
        <div>
            <img src="{{ asset('images/InsiderLandingIcon.svg') }}" width="100">
        </div>
        <div class="video-play-con-btn mt-5" >
            <button class="play-video-btn" >WATCH MOVIE</button>
        </div>
        <div class="video-play-con-btn mt-4" >
            <a href="{{ route('marketing::index') }}#home" class="scroll continue-to-website" >CONTINUE TO WEBSITE</a>
        </div>
        <div class="mt-5">
            <img src="{{ asset('images/InsiderLandingText.svg') }}" width="270">
        </div>
    </div>
    <div class="background-music-con-btn" style="position: absolute; z-index: 2; padding-top: 85vh; padding-left: 49vw; display: none;">
         <a href="#home" class="scroll">
            <div class="arrow">
              <span></span>
              <span></span>
              <span></span>
            </div>
        </a>
    </div>
    <div class="video-area-hidden" id="video-area" style="background-color: #000;">
        <!-- <h1 class="coming-soon">Coming Soon!</h1> -->
        <video id="plexusVideo" title="{{__('header.title')}}" src="{{ asset('media/Insider.m4v') }}"
           autoplay loop >
        </video>
    </div>
    
    <div class="headerSection fixed-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container" style="background-color: #141821; height: 75px;">
                <a class="navbar-brand" href="{{ route('marketing::index') }}"><img src="{{ asset('images/InsiderLogoW.svg') }}" class="img-fluid" alt="{{__('header.title')}}" title="{{__('header.title')}}" /></a>
                <div class="collapse navbar-collapse flex-grow-0 d-none d-lg-block" id="navbarNav">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" id="home-nav">
                            <a href="{{ route('marketing::index') }}@if('marketing::index'==Route::current()->getName())#home @endif" class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">HOME</a>
                        </li>
                        <li class="nav-item" id="about-nav">
                            <a href="{{ route('marketing::index') }}#about" class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">ABOUT</a>
                        </li>
                        <li class="nav-item contact-nav">
                            <a href="{{ route('marketing::contact-us') }}" class="scroll link">CONTACT</a>
                        </li>
                        <li class="nav-item contact-nav">
                            <a href="{{ route('auth::login') }}">LOGIN</a>
                        </li>
                        <li class="nav-item contact-nav">
                            <a href="{{ route('auth::register') }}">JOIN</a>
                        </li>
                    </ul>
                </div>
                <div class="meanmenu-div d-block d-lg-none">
                    <nav class="menamenu-nav">
                        <ul>
                            <li >
                                <a href="{{ route('marketing::index') }}@if('marketing::index'==Route::current()->getName())#home @endif" class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">HOME</a>
                            </li>
                            <li >
                                <a href="{{ route('marketing::index') }}#home" class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">ABOUT</a>
                            </li>
                            <li>
                                <a href="{{ route('marketing::contact-us') }}" class="scroll link">CONTACT</a>
                            </li>
                            <li>
                                <a href="{{ route('auth::login') }}">LOGIN</a>
                            </li>
                            <li>
                                <a href="{{ route('auth::register') }}">JOIN</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>
    </div>
</div>
<style type="text/css">
    .arrow span{
        display: block;
        width: 30px;
        height: 30px;
        border-bottom: 5px solid #fff;
        border-right: 5px solid #fff;
        transform: rotate(45deg);
        margin: -10px;
        animation: animate 2s infinite;
    }
    .arrow span:nth-child(2){
        animation-delay: -0.2s;
    }
    .arrow span:nth-child(3){
        animation-delay: -0.4s;
    }
    @keyframes animate {
        0%{
            opacity: 0;
            transform: rotate(45deg) translate(-20px,-20px);
        }
        50%{
            opacity: 1;
        }
        100%{
            opacity: 0;
            transform: rotate(45deg) translate(20px,20px);
        }
    }

    .play-video-btn {
        color: #fff; 
        width: 288px;
        border: none;
        background-color: #00afaa; 
        padding: 15px 20px;
        color: #fff;
        display: inline-block;
        text-align: center;
        font-size: 16px;
        line-height: 24px;
        font-family: "Oswald", Open Sans, Helvetica, sans-serif;
        text-transform: uppercase;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        /*position: absolute; top: 35vh; left: calc(50vw - 144px); z-index: 2;*/
    }

    .continue-to-website {
        color: #fff; 
        width: 288px;
        border: none;
        background-color: #00afaa; 
        padding: 15px 20px;
        color: #fff !important;
        display: inline-block;
        text-align: center;
        font-size: 16px;
        line-height: 24px;
        font-family: "Oswald", Open Sans, Helvetica, sans-serif;
        text-transform: uppercase;
        text-decoration: none !important;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        /*position: absolute; margin-top: 45vh; left: calc(50vw - 144px); z-index: 2;*/
    }

    .play-video-btn:hover, .continue-to-website:hover {
        outline: none;
    }

    .play-video-btn:focus, .continue-to-website:focus {
        outline: none;
    }

    .video-area-hidden {
        position: absolute; width: 100%; height: 100%; top: 0; left: 0; bottom: 0; right: 0; display: none; justify-content: center; align-items: center; overflow: hidden;
    }

    .video-area-show {
        position: absolute; width: 100%; height: 100%; top: 0; left: 0; bottom: 0; right: 0; display: flex; justify-content: center; align-items: center; overflow: hidden;
    }

    .button-group-area {
        position: absolute; margin-top: 22vh; text-align: center; width: 100%; z-index: 2;
    }
</style>