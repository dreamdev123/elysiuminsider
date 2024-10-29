@extends('_layouts.clean')

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection

@section('content')

    <div class="container-fluid vh-100" data-backgound="register" style="display: none">
        <a href="{{ route('marketing::index') }}" class="close-icon cursor-pointer"><i class="fas fa-times"></i></a>
        <div class="row minvh-100">
            <div class="col-lg-5 p-0 register-bg-container">
                <div class="register-bg"></div>
            </div>
            <div class="col-lg-7 align-self-center text-center m-auto pt-5 pb-5">
                <img src="{{ asset('images/InsiderLogoB.svg') }}" class="mb-5 pt-5"
                     style="width: 200px;">
                <h3 class="mb-3">Reset password</h3>

                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                        @if(Session::has('passwordReseted'))
                            <div class="alert alert-success">Your password has been successfully reset.</div>
                            <p class="description-paragraph mb-5">You can now <a href="{{ route('auth::login') }}"
                                                                                 class="text-link">Log in</a> to your
                                account.</p>
                        @else
                            <form data-form="login" action="{{route('auth::password-reset', ['token' => $token])}}"
                                  method="post">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif

                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 pr-sm-2 mb-2">
                                        <div class="form-group position-relative text-left">
                                            <label class="label-title">New Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="password" placeholder="Create a password"
                                                   data-password="register"
                                                   style="padding-right: 45px;" tabindex="2" value="">
                                            <!-- <div class="password-eye" data-password="password-eye">
                                                <i class="fas fa-eye cursor-pointer"
                                                   data-password="password-eye-show"></i>
                                                <i class="fas fa-eye-slash cursor-pointer"
                                                   data-password="password-eye-hide" style="display: none"></i>
                                            </div> -->
                                            <label id="password-error" class="has-error" for="password"
                                                   style="display: none"></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 pl-sm-2 mb-2">
                                        <div class="form-group text-left">
                                            <label class="label-title">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="password-confirmation" placeholder="Confirm password"
                                                   data-password="confirm"
                                                   style="padding-right: 45px;" tabindex="3" value="">
                                            <label id="password-confirmation-error" class="has-error"
                                                   for="password_confirmation" style="display: none"></label>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <button class="btn btn-success btn-block btn-lg button-submit"
                                                data-button="submit" tabindex="4"><i class="fas fa-unlock-alt mr-2"></i>
                                            Reset Password
                                        </button>
                                    </div>

                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
    <script type="text/javascript">
        const login = {
            init: function () {
                this.variables();
                this.addEventListeners();
                this.firstInputFocus();
                this.showRegisterPage();
            },
            variables: function () {
                this.form = $('[data-form="login"]');

                this.backgroundRegister = $('[data-backgound="register"]');
                this.scrollToError = '';
                this.submitButton = $('[data-button="submit"]');
            },
            addEventListeners: function () {

                this.form.on('submit', function (event) {
                    return true;
                }.bind(this));
                $(document).on('keypress', function (e) {
                    if ((e.which === 13)) {
                        this.form.submit();
                    }
                }.bind(this));
            },
            scrollToElement: function (element) {
                $('body, html').animate({
                    scrollTop: element.offset().top - 50
                }, 500);
            },
            firstInputFocus: function () {

            },


            showRegisterPage: function () {
                setTimeout(function () {
                    this.backgroundRegister.fadeIn(300);
                }.bind(this), 200)
            },
            addLoader: function () {
                this.submitButton.addClass('loader');
            },
            removeLoader: function () {
                this.submitButton.removeClass('loader');
            }
        };

        $(document).ready(function () {
            login.init();
        });
    </script>
@endsection
