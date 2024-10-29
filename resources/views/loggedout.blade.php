@extends('_layouts.clean')

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')
    <div class="container vh-100" data-backgound="loggedout-page" style="display: none">
        <img src="{{ asset('images/elysivm-white-logo.png') }}" class="logo-let-up-corner"
             style="width: 200px; filter: invert(4);">
        <div class="row minvh-100">
            <div class="col-lg-8 offset-lg-2 align-self-center text-center m-auto pt-5 pb-5" style="padding-top: 150px">
                <h3 class="mb-4">Successfully logged out from panel !</h3>
                <div class="d-inline-block mt-4">
                    <a href="{{ route('auth::login') }}">
                        <div class="icon-circle m-3">
                            <i class="fas fa-sign-out-alt icon-in-circle"></i>
                        </div>
                    </a>
                </div>
                <hr class="mb-5">
                <p class="description-paragraph m-0">Your account is secure - we hope to see you soon !</p>
                <p class="description-paragraph m-0">Return to the <a
                        href="{{ route('marketing::index') }}">homepage</a> or <a href="{{ route('auth::login') }}">log
                        in</a> again.</p>
            </div>
        </div>
    </div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
    <script type="text/javascript">
        const loggedout = {
            init: function () {
                this.variables();
                this.addEventListeners();
                this.showLoggedOutPage();
            },
            variables: function () {
                this.loggedOutPage = $('[data-backgound="loggedout-page"]');
            },
            addEventListeners: function () {
            },
            showLoggedOutPage: function () {
                setTimeout(function () {
                    this.loggedOutPage.fadeIn(300);
                }.bind(this), 200)
            }
        };

        $(document).ready(function () {
            loggedout.init();
        });
    </script>
@endsection
