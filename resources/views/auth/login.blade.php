@extends('_layouts.clean')

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
<style type="text/css">
    .bannerSection {
        /*position: relative;*/
        display: none !important;
    }

    .headerSection nav.navbar.navbar-default {
        border-bottom: solid 2px #a0a0a000 !important;
    }
    .user-login {
        font-family: 'DIN Pro Condensed Bold', sans-serif;
        font-size: 20px; 
        color: #41464d;
    }
    .user-desc {
        font-family: 'DIN Pro Condensed Regular', sans-serif; 
        font-size: 20px; 
        color: #41464d;
    }
    .create-account {
        font-family: 'DIN Pro Condensed Bold', sans-serif; 
        font-size: 35px; 
        color: #00aeaa !important;
    }
    .input-login {
        font-family: 'Raleway Regular', sans-serif;
        font-size: 12px; 
        color: #a6a8ab !important;
    }
    .forgot-password {
        color: #777 !important;
    }
</style>
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')
<div class="bg-login-image">
    <div class="container vh-100" data-backgound="register-bg">
        
        <div class="row minvh-100">
            
            <div class="col-lg-12 align-self-center text-center m-auto pb-5" style="padding-top: 100px;">
                <!-- <img src="{{ asset('images/elysivm-white-logo.png') }}" class="mb-5 pt-5"
                     style="width: 200px; filter: invert(4);"> -->
                <h3 class="mb-0 user-login">USER LOGIN</h3>
                <h3 class="mb-0 user-desc">Login to your user account for better experience</h3>
                <p class="description-paragraph mb-5">
                    <a href="{{ route('auth::register') }}" class="text-link create-account">Create an account</a>
                </p>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                        @if(Session::has('passwordChanded'))
                            <div class="alert alert-success">You password has been changed. Log in to your account.</div>
                        @endif

                        <form data-form="login" action="{{route('auth::login')}}" method="post">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group text-left">
                                        <input type="text" name="username" class="form-control input-login" id="username"
                                               placeholder="Username" tabindex="1" value="{{old('username')}}">
                                        <label id="username-error" class="has-error" for="username"
                                               style="display: none"></label>
                                    </div>
                                    <div class="form-group position-relative text-left">
                                        <input type="password" name="password" class="form-control input-login" id="password"
                                               placeholder="Password" data-password="register"
                                                tabindex="2" value="">
                                        <!-- <div class="password-eye" data-password="password-eye">
                                            <i class="fas fa-eye cursor-pointer" data-password="password-eye-show"></i>
                                            <i class="fas fa-eye-slash cursor-pointer" data-password="password-eye-hide"
                                               style="display: none"></i>
                                        </div> -->
                                        <label id="password-error" class="has-error" for="password"
                                               style="display: none"></label>
                                    </div>
                                    <div class="form-group text-left">
                                        <label class="checkbox-container">
                                            <input type="checkbox" name="remember" id="remember"
                                                   {{ old('remember') ? 'checked' : '' }} class="radio-button"
                                                   tabindex="3">
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">Remember me</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <button class="btn btn-success btn-block btn-lg button-submit" data-button="submit"
                                            tabindex="4"> LogIn
                                    </button>
                                </div>
                                <div class="col-12 mb-3 text-left">
                                    <a href="{{ route('auth::password-forgot') }}"
                                       class="text-left d-inline-block text-link cursor-pointer forgot-password">Forgot your password
                                        ?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div>
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
                this.passwordRegisterInput = $('[data-password="register"]');
                this.passwordRegisterEye = $('[data-password="password-eye"]');
                this.passwordRegisterEyeShow = $('[data-password="password-eye-show"]');
                this.passwordRegisterEyeHide = $('[data-password="password-eye-hide"]');
                this.form = $('[data-form="login"]');
                this.usernameInput = $('#username');
                this.usernameError = $('#username-error');
                this.passwordInput = $('#password');
                this.passwordError = $('#password-error');
                this.backgroundRegister = $('[data-backgound="register"]');
                this.scrollToError = '';
                this.submitButton = $('[data-button="submit"]');
            },
            addEventListeners: function () {
                // this.passwordRegisterEye.on('click', function () {
                //     this.togglePasswordVisibility();
                // }.bind(this));
                this.usernameInput.on('keyup', function () {
                    this.validateEmailInput();
                }.bind(this));
                this.passwordInput.on('keyup', function () {
                    this.validatePasswordInput();
                }.bind(this));
                this.form.on('submit', function (event) {
                    if (this.validateEmailInput() &&
                        this.validatePasswordInput()) {
                        return true;
                    } else {
                        event.preventDefault();
                        this.scrollToElement(this.scrollToError);
                        this.scrollToError.focus();
                    }
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
            togglePasswordVisibility: function () {
                if (this.passwordRegisterInput.attr('type') === "password") {
                    this.passwordRegisterInput.attr('type', 'text');
                    this.passwordRegisterEyeShow.hide();
                    this.passwordRegisterEyeHide.show();
                } else {
                    this.passwordRegisterInput.attr('type', 'password');
                    this.passwordRegisterEyeShow.show();
                    this.passwordRegisterEyeHide.hide();
                }
            },
            firstInputFocus: function () {
                setTimeout(function () {
                    this.usernameInput.focus();
                }.bind(this), 300);
            },
            validateEmailInput: function () {
                var validationMessage = '';
                var formControlEmail = this.usernameInput.parent('.form-group').find('.form-control');
                var value = this.usernameInput.val();

                if (value === '') {
                    validationMessage = 'The username field is required.';
                    formControlEmail.removeClass('valid');
                    formControlEmail.addClass('has-error');
                    this.usernameError.removeClass('valid');
                    this.usernameError.show();
                } else {
                    validationMessage = 'Now, that\'s a good username.\n';
                    formControlEmail.addClass('valid');
                    this.usernameError.addClass('valid');
                    this.usernameError.show();
                }

                this.usernameError.html(validationMessage);
                this.scrollToError = this.usernameInput;

                return ((/\d/.test(value)) || (/[a-zA-Z]/.test(value)) || (/^.{5,}$/.test(value)));
            },
            validatePasswordInput: function () {
                var validationMessage = '';
                var value = this.passwordInput.val();

                if ((/\d/.test(value)) && (/[a-zA-Z]/.test(value)) && (/^.{7,}$/.test(value))) {
                    validationMessage = 'Now, that\'s a secure password.\n';
                    this.errorRegisterPassword();
                } else if ((/\d/.test(value)) && (/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong><del>number</del></strong>, and be minimum of <strong>7 characters</strong>.';
                    this.validRegisterPassword();
                } else if ((/^.{7,}$/.test(value)) && (/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.validRegisterPassword();
                } else if ((/^.{7,}$/.test(value)) && (/\d/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.validRegisterPassword();
                } else if ((/^.{7,}$/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong><del>7 characters</del></strong>.';
                    this.validRegisterPassword();
                } else if ((/\d/.test(value))) {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong>7 characters</strong>.';
                    this.validRegisterPassword();
                } else if ((/[a-zA-Z]/.test(value))) {
                    validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.validRegisterPassword();
                } else if (value === '') {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.validRegisterPassword();
                } else {
                    validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>7 characters</strong>.';
                    this.validRegisterPassword();
                }

                this.passwordError.html(validationMessage);
                this.scrollToError = this.passwordInput;

                return (/\d/.test(value)) && (/[a-zA-Z]/.test(value)) && (/^.{7,}$/.test(value));
            },
            validRegisterPassword: function () {
                var formControlPassword = this.passwordInput.parent('.form-group').find('.form-control');
                formControlPassword.removeClass('valid');
                formControlPassword.addClass('has-error');
                this.passwordError.removeClass('valid');
                this.passwordError.show();
            },
            errorRegisterPassword: function () {
                var formControlPassword = this.passwordInput.parent('.form-group').find('.form-control');
                formControlPassword.addClass('valid');
                this.passwordError.addClass('valid');
                this.passwordError.show();
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
