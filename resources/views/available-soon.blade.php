@extends('_layouts.marketing', ['ACTIVE_TAB' => 'index'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))


@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/style_new.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style type="text/css">
        .bannerSection {
            position: relative;
            display: none !important;
        }

        .headerSection nav.navbar.navbar-default {
            border-bottom: solid 2px #a0a0a000 !important;
        }
    </style>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection

@section('PAGE_START')
<script type="text/javascript">
    
    $('.headerSection').show();
</script>
@endsection

@section('PAGE_END')
@endsection


@section('content')

    <div class="row innerPagesWrapper">
        <div class="container">
            <div class="row innerPageHead" style="min-height:200px; justify-content: center;align-self: center;">
                AVAILABLE SOON!
            </div>
        </div>
    </div>

        <footer style="padding-top: 80px;">
        <div class="container" style="padding: 0px !important;">
            <div class="row mb-5">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-hk-company-info">
                    <div class="footer-hk-logo">
                        <img src="{{asset('images/footer-hk-logo.png')}}">
                    </div>
                    <div class="company-info">
                        <p style="margin-top: 0px;">Elysium Capital Limited | Registered Address CS</p>
                        <p style="margin-top: 5px;">No.5, 17/F, Bonham Trade Centre, 50 Bonham Strand, Sheung Wan,</p>
                        <p style="margin-top: 5px;">Hong Kong. Registration Number: 2865940</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-sweden-company-info" style="display: flex; align-items: center;">
                    <div class="footer-sweden-logo">
                        <img src="{{asset('images/footer-sweden-logo.png')}}">
                    </div>
                    <div class="company-info">
                        <p style="margin-top: 0px;">Elysium Capital Limited | Research | Administration | Representative HQ</p>
                        <p style="margin-top: 5px;">Turning Torso, Lilla Varvsgatan 14, 211 15 Malmö, Sweden</p>
                        <p style="margin-top: 5px;">T: Enquiries +44 7723 503770 | support@elysiumcapital.io</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <ul class="footer-menu">
                        <li><a href="{{ route('marketing::legal::gdpr') }}">DATA PRIVACY POLICY [GDPR]</a></li>
                        <li><a href="{{ route('marketing::legal::terms-of-supply') }}">TERMS OF SERVICE</a></li>
                        <li><a href="{{ route('marketing::legal::terms-of-use') }}">TERMS OF USE</a></li>
                        <li><a href="{{ route('marketing::contact-us') }}">CONTACT</a></li>
                    </ul>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <p class="footer-copyright">Copyright © 2020 ELYSIUM CAPITAL LIMITED. All rights reserved.</p>
                </div>
            </div>
        </div>
        <div class="footer-disclaimer">
            <div class="container">
                <div class="row">
                    <p style="margin-top: 0px">DISCLAIMER</p>
                    <p style="margin-top: 20px;">See also our disclaimer above on our website. We are a Fintech access provider and signal provider. We develop trade signals per quantitative analysis. We grant access to the data on trading portfolio operations allowing other participants to auto-copy signals automatically on their own trading accounts via a 3rd party independent prime brokerage, not being Elysium Capital Limited or any of our subsidiaries. All signal participation should be made using risk capital that is not crucially required. There may be a considerable risk of losses on the currency spot market and all signals provided by Elysium Capital Limited and de facto the 3rd
                    party prime brokerage and Liquidity Provider are at risk of capital loss. You should consider carefully whether such participation is appropriate to you, taking into account your financial {{asset('images/')}}s. We advise everyone to seek independent advice regarding issues concerning participation on the currency spot market. No information on this website should be understood to constitute financial advice from Elysium Capital Limited. It is published for information and marketing purposes. Elysium Capital Limited does not accept clients from the U.S, Iran, Syria, North Korea, Yemen and Cuba. Elysium Capital Limited may reject any applicant from any jurisdiction at their sole discretion without the requirement to explain the reason why. Elysium Capital Limited's signal 'portfolio's' (operated and executed by 3rd party managed accounts via "copy trader"/MAM) are operated by a 3rd party prime brokerage and Liquidity Provider registered at the Financial Supervisory Authority. Our services are not intended for distribution, commercialisation, to, or use by any person in any country and jurisdiction where such distribution or use would be contrary to local law or regulation.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="modal fade" id="team-2190" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border: none;">
            <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h3 class="member-name oswald uppercase dark mb-3">AVAILABLE SOON...</h3>
          </div>
          <div class="modal-footer" style="border: none;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

@endsection
