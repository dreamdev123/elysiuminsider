<div class="row addressWrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 wow fadeInUp">
                <div>
                    <img src="{{ asset('images/HongKong.png') }}" class="footer-image mr-3" alt="{{ trans('index.ec') }}">
                    <p class="footer-desc">{!! trans('footer.limited') !!}</p>
                </div>
                {{--<div class="mt-4">
                    <img src="{{ asset('images/Estonia.png') }}" class="footer-image mr-3" alt="{{ trans('index.ec') }}">
                    <p class="footer-desc">{!! trans('footer.plc') !!}</p>
                </div>--}}
                <div class="mt-4 mb-1">
                    <img src="{{ asset('images/Sweden.png') }}" class="footer-image mr-3" alt="{{ trans('index.ec') }}">
                    <p class="footer-desc">{!! trans('footer.research') !!}</p>
                </div>
                <div class="mt-3">
                    <img class="footer-image mr-3" style="opacity: 0"></img>
                    <p class="footer-desc" style="border-left: none;">T:Enquiries +44 7723 503770 | support@elysiuminsider.io</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="menuFooter wow fadeInLeft">
                    <div class="row">
                        <div class="col-sm-4 text-sm-right">
                            <label>{!! trans('footer.menu') !!}</label>
                        </div>
                        <div class="col-sm-8">
                            <ul>
                                <a href="{{ route('marketing::index') }}#home"
                                   class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">
                                    <li><span>01</span> {{__('footer.home')}}</li>
                                </a>
                                <a href="{{ route('marketing::index') }}#service"
                                   class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">
                                    <li><span>02</span> {{__('footer.portfolios')}}</li>
                                </a>
                                <a href="{{ route('marketing::index') }}#beradical"
                                   class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">
                                    <li><span>03</span> {{__('footer.strategy')}}</li>
                                </a>
                                <a href="{{ route('marketing::index') }}#team"
                                   class="scroll @if('marketing::index'!=Route::current()->getName()) link @endif">
                                    <li><span>04</span> {{__('footer.team')}}</li>
                                </a>
                                <a href="javascript:;">
                                    <li><span>05</span> {{__('footer.login')}}</li>
                                </a>
                                {{--<a href="{{ route('marketing::faq') }}">
                                    <li><span>05</span> {{__('footer.faq')}}</li>
                                </a>
                                <a href="{{ route('marketing::contact-us') }}" class="scroll link">
                                    <li><span>06</span> Contact</li>
                                </a>
                                <a href="{{ route('marketing::country') }}">
                                    <li><span>07</span> {{__('footer.country')}}</li>
                                </a>
                                <a href="#">
                                    <li><span>08</span> {{__('footer.login')}}</li>
                                </a>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footerImgWrapper">
            <div class="col-sm-8">
                <ul class=" wow fadeInLeft">
                    <li><img class="fidcard" src="{{ asset('images/Ft-icon01.png') }}"/></li>
<!--                <li><img class="mastercard" src="{{ asset('images/MasterCard.png') }}"/></li>
                    <li><img class="visacard" src="{{ asset('images/VisaCard.png') }}"/></li> -->
                </ul>
            </div>
            <div class="col-sm-4  wow fadeInRight">
                <ul>
                    <li><img src="{{ asset('images/facebook.png') }}"/></li>
                    <li><img src="{{ asset('images/indeed.png') }}"/></li>
                    <li><img src="{{ asset('images/instagram.png') }}"/></li>
                    <li><img src="{{ asset('images/pintrest.png') }}"/></li>
                    <li><img src="{{ asset('images/twitter.png') }}"/></li>
                    <li><img src="{{ asset('images/whatsapp.png') }}"/></li>
                    <li><img src="{{ asset('images/googleplus.png') }}"/></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="copyWrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <p class=" wow fadeInUp">{!! __('footer.copyright', ['year' => date('Y')]) !!}</p>
            </div>
            <div class="col-sm-7">
                <ul class=" wow fadeInUp">
                    <a href="{{ route('marketing::legal::gdpr') }}">
                        <li>{{ __('footer.gdpr') }}</li>
                    </a>
<!--                     <a href="{{ route('marketing::legal::terms-of-supply') }}">
                        <li>{{ __('footer.terms-of-supply') }}</li>
                    </a> -->
                    <a href="{{ route('marketing::legal::terms-of-use') }}">
                        <li>{{ __('footer.terms-of-use') }}</li>
                    </a>
                    <a href="{{ route('marketing::contact-us') }}">
                        <li style="padding-right: 0px; border-right: 0px;">{{ __('footer.contact-us') }}</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row footerWrapper">
    <div class="container">
        <p class=" wow fadeInDown">
            {{ __('footer.displaimer') }}
        </p>
        {{--<div class="footer-language-switcher">
            @include('_includes.footer-language-switcher')
        </div>--}}
    </div>
</div>
