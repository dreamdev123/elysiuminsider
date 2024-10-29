@extends('_layouts.clean')

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
<link rel="stylesheet" type="text/css" href="{{url('plugin/select2/css/select2.css')}}">
<link  href="{{url('plugin/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .img-flag
    {
        width: 32px;
    }

    .select2
    {
        height: 50px;
    }

    .select2-container
    {
        display: flex;
        align-items: center;
        width: 100% !important;
        height: 50px;
    }

    .select2-container span {
      font-size: 13px; }

    /*.select2-container span img {
      margin-left: 4px; }*/

    .selection {
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
    }
</style>
<style type="text/css">

    .headerSection nav.navbar.navbar-default {
        border-bottom: solid 2px #a0a0a000 !important;
    }
    .bg-login-image {
        background-color: #dcddde;
        z-index: 2; 
        /*position: relative;*/
    }
    .register-title {
        font-family: 'DIN Pro Condensed Bold', sans-serif;
        font-size: 35px; 
        color: #d22630;
    }
    .register-subtitle {
        font-family: 'DIN Pro Condensed Bold', sans-serif; 
        font-size: 12px; 
        color: #41464d;
    }
    .register-desc {
        text-align: justify;
        font-family: 'Raleway Light', sans-serif;
        font-size: 12px; 
        color: #41464d;
    }
    .form-right-padding {
        padding-right: 40px;
    }

    .form-left-padding {
        padding-left: 40px;
    }

    @media (max-width: 992px) {
        .form-right-padding {
            padding-right: 15px;
        }

        .form-left-padding {
            padding-left: 15px;
        }
    }

    .info-title {
        font-family: 'DIN Pro Condensed Medium', sans-serif; 
        font-size: 18px; 
        color: #41464d;
        text-transform: uppercase;
    }

    .info-subtitle {
        font-family: 'DIN Pro Condensed Regular', sans-serif; 
        font-size: 16px; 
        color: #41464d;
        text-transform: uppercase;
        font-weight: 400;
    }
    .label-style {
        font-family: 'DIN Pro Condensed Regular';
        font-size: 16px;
        color: #41464d;
    }
    .input-form {
        width: 100%;
        height: 33px;
        font-family: 'Raleway Regular', sans-serif;
        font-size: 12px;
        color: #a6a8ab;
    }
    label.has-error {
        padding: 13px 16px 11px;
        font-size: 14px;
        color: #D22630;
        background: #ffecec;
        border: 1px solid #D22630;
        border-top: none;
        margin: 0;
        border-radius: 0 0 .25rem .25rem;
        width: 100%;
        text-align: left;
        font-family: 'calibri';
    }
    label.valid {
        padding: 13px 16px 11px;
        font-size: 14px;
        color: #5ea06d;
        background: #e4f7e5;
        border: 1px solid #5ea06d;
        border-top: none;
        margin: 0;
        border-radius: 0 0 .25rem .25rem;
        width: 100%;
        text-align: left;
        font-family: 'calibri';
    }
    .button-submit {
        width: 100%;
    }
    .footer-disclaimer {
        padding-top: 80px; 
        padding-bottom: 80px;
    }

    .footer-disclaimer .disclaimer-title {
        font-family: 'DIN Pro Condensed Bold', sans-serif;
        font-size: 10pt;
        color: #41464d;
        text-align: justify;
    }


    .footer-disclaimer .disclaimer-desc {
        font-family: 'Raleway Light', sans-serif;
        font-size: 10pt;
        color: #41464d;
        text-align: justify;
    }

    @media (max-width: 1350px) {
        .footer-disclaimer p {
            padding-left: 30px;
            padding-right: 30px;
        }
    }
    .webkit_style {
        background: url("../images/select-arrows.svg") no-repeat;
        background-position: 98% 50%;
        background-size: 12px;
    }
    .select-bg {
        background: #fff;
        width: 100%;
        border-radius: 0.25rem;
    }
    .select-bg select {
        width: 100%;
        -webkit-appearance: menulist-button;
    }
    .payment-choose-title {
        font-family: 'DIN Pro Condensed Bold', sans-serif;
        font-size: 35px;
        color: #d22630;
    }
    .payment-btn {
        font-family: 'DIN Pro Condensed Bold', sans-serif; 
        color: #FFFFFF !important;
        background-color: #a6a8ab !important;
        border: none !important;
        border-radius: 0;
        text-transform: uppercase;
        width: 100%;
    }
    .payment-btn:hover {
        background-color: #41464d !important;
    }

    .btn-payment-selected {
        background-color: #41464d !important;
    }
    .payment-value {
        font-family: 'DIN Pro Condensed Bold', sans-serif !important;
        font-size: 35px;
        color: #41464d;
    }
    .pay-now-btn {
        font-family: 'DIN Pro Condensed Bold', sans-serif; 
        color: #FFFFFF !important;
        background-color: #d22630 !important;
        border: none !important;
        border-radius: 0;
        text-transform: uppercase;
        width: 100%;
    }

    .description-section1 {
        border-left: 2px solid #a6a8ab;
        border-right: 1px solid #a6a8ab;
        background-color: #dcddde;
    }

    .description-section2 {
        border-left: 1px solid #a6a8ab;
        border-right: 2px solid #a6a8ab;
        background-color: #dcddde;
    }
    .license-section1 {
        border-left: 2px solid #a6a8ab;
        border-right: 1px solid #a6a8ab;
    }
    .license-section2 {
        border-left: 1px solid #a6a8ab;
        border-right: 2px solid #a6a8ab;
    }
    .check-fa-icon {
        font-size: 14px;
        color: #37b34a;
    }
    .title-active {
        color: #37b34a;
        font-weight: 700;
    }
</style>
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection


@section('content')
<div class="w-100" style="background-color: #dcddde;">
    <div class="container" data-backgound="message">
        <div class="row minvh-100">
            <div class="col-lg-10 offset-lg-1 align-self-center m-auto mt-5 pb-5" style="padding-top: 150px">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @else

                    <h3 class="mb-5" style="color: #00aea9; font-weight: 800; font-family: 'DIN Pro Condensed Medium', sans-serif; text-transform: uppercase;">Contact Us</h3>
                    <form data-form="message" action="{{route('marketing::contact-us-send')}}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @csrf
                        <h3 class="info-title text-left">PLEASE FILL OUT ALL FIELDS BEFORE SENDING</h3>
                        <div class="row mb-3">
                    
                            <div class="col-sm-6 form-right-padding mb-2">
                                <div class="form-group text-left">
                                    <label class="label-style">GIVEN NAME</label>
                                    <input type="text" name="first_name" class="form-control input-form" id="firstName" placeholder="GIVEN NAME" value="{{old('first_name')}}" tabindex="1">
                                    <label id="first-name-error" class="has-error" for="first_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                            <div class="col-sm-6 form-left-padding mb-2">
                                <div class="form-group position-relative text-left">
                                    <label class="label-style">SURNAME</label>
                                    <input type="text" name="last_name" class="form-control input-form" id="lastName" placeholder="SURNAME" value="{{old('last_name')}}" tabindex="2">
                                    <label id="last-name-error" class="has-error" for="last_name"
                                           style="display: none"></label>
                                </div>
                            </div>
                            <div class="col-sm-6 form-right-padding mb-2">
                                <div class="form-group text-left">
                                    <label for="country" class="label-style">Country</label>
                                    <div class="select-bg">
                                        <select class="input-form " id="country" name="country" style="padding: 0 16px;">
                                            @foreach($countries as $country)
                                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-left-padding mb-2">
                                <div class="form-group text-left">
                                    <label for="gender" class="label-style">Gender</label>
                                    <div class="d-flex">
                                        <label class="checkbox-container">
                                            <input type="radio" name="gender" id="gender-male" class="radio-button" value="Male" checked>
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">Male</span>
                                        </label>
                                        <label class="checkbox-container ml-3">
                                            <input type="radio" name="gender" id="gender-female" class="radio-button" value="Female" >
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-right-padding mb-2">
                                <div class="form-group text-left">
                                    <label class="label-style">PHONE NUMBER</label>
                                    <input type="text" name="phone" class="form-control input-form" id="phone" placeholder="+123456789" value="{{old('phone')}}" tabindex="3">
                                    <label id="first-name-error" class="has-error" for="phone"
                                           style="display: none"></label>
                                </div>
                            </div>
                            <div class="col-sm-6 form-left-padding mb-2">
                                <div class="form-group position-relative text-left">
                                    <label class="label-style">EMAIL ADDRESS</label>
                                    <input type="email" name="email" class="form-control input-form" id="email" placeholder="EMAIL ADDRESS" value="{{old('email')}}" tabindex="4">
                                    <label id="email-error" class="has-error" for="email"
                                           style="display: none"></label>
                                </div>
                            </div>

                            <div class="col-sm-6 form-right-padding mb-2">
                                <div class="form-group text-left">
                                    <label for="interested" class="label-style">I AM INTERESTED IN:</label>
                                    <div class="d-flex">
                                        <label class="checkbox-container">
                                            <input type="radio" name="interested" id="interested-opportunity"
                                                    class="radio-button" value="OPPORTUNITY" checked>
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">OPPORTUNITY</span>
                                        </label>
                                        <label class="checkbox-container ml-3">
                                            <input type="radio" name="interested" id="interested-product"
                                                    class="radio-button" value="PRODUCT" >
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">PRODUCT</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 form-left-padding mb-2">
                                <div class="form-group text-left">
                                    <label for="foundBy" class="label-style">I FOUND ELYSIUM BY:</label>
                                    <div class="d-flex">
                                        <label class="checkbox-container">
                                            <input type="radio" name="foundBy" id="foundBy-friend"
                                                    class="radio-button" value="FRIEND" checked>
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">FRIEND</span>
                                        </label>
                                        <label class="checkbox-container ml-3">
                                            <input type="radio" name="foundBy" id="foundBy-email"
                                                    class="radio-button" value="EMAIL" >
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">EMAIL</span>
                                        </label>
                                        <label class="checkbox-container ml-3">
                                            <input type="radio" name="foundBy" id="foundBy-webinar"
                                                    class="radio-button" value="WEBINAR" >
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">WEBINAR</span>
                                        </label>
                                        <label class="checkbox-container ml-3">
                                            <input type="radio" name="foundBy" id="foundBy-google"
                                                    class="radio-button" value="GOOGLE" >
                                            <span class="checkmark mr-1 align-middle"></span>
                                            <span class="mb-1">GOOGLE</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="info-title text-left">Your Message</h3>
                        <div class="row mb-4">
                            <div class="col-sm-6 form-right-padding">
                                <textarea name="message" class="form-control" id="message"
                                                  placeholder="Your Message" rows="5"
                                                  tabindex="6">{{old('message')}}</textarea>
                                    <label id="message-error" class="has-error" for="message"
                                               style="display: none"></label>
                            </div>
                            <div class="col-sm-6 form-left-padding mt-auto">
                                <button type="submit" class="btn btn-success btn-block btn-lg button-submit"
                                    data-button="submit" tabindex="7">Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('PAGE_LEVEL_SCRIPTS')
    <script src="{{ url('/js/jquery.validate.min.js') }}"></script>
    <script src="{{url('plugin/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        function format(state) {
            if (!state.id) { return state.text; }
            var $state = $(
             '<span>'+ state.text + '<img src="https://www.countryflags.io/' + $(state.element).attr('data-code') + '/flat/64.png" class="img-flag" /> ' + $(state.element).attr('data-code') +  '</span>'
            );
            
            return $state;
        }

        if ($('#phonePrefix').size() > 0) {
            $("#phonePrefix").select2({
                placeholder: '',
                templateResult: format,
                templateSelection: format,
                width: 'auto', 
                escapeMarkup: function(m) {
                    return m;
                }
            });
        }
        const register = {
            init: function () {
                this.variables();
                this.addEventListeners();
                this.firstNameInputFocus();
                this.showPage();
            },
            variables: function () {
                this.form = $('[data-form="message"]');
                this.page = $('[data-backgound="message"]');
                this.scrollToError = '';
                this.firstNameInput = $('#firstName');
                this.firstNameError = $('#first-name-error');
                this.lastNameInput = $('#lastName');
                this.lastNameError = $('#last-name-error');
                this.emailInput = $('#email');
                this.emailError = $('#email-error');
                this.phoneInput = $('#phone');
                this.phoneError = $('#phone-error');
                this.messageInput = $('#message');
                this.messageError = $('#message-error');
                this.submitButton = $('[data-button="submit"]');
            },
            addEventListeners: function () {
                this.firstNameInput.on('keyup', function () {
                    this.validateFirstNameInput();
                }.bind(this));
                this.lastNameInput.on('keyup', function () {
                    this.validateLastNameInput();
                }.bind(this));
                this.phoneInput.on('keyup', function () {
                    this.validatePhoneInput();
                }.bind(this));
                this.emailInput.on('keyup', function () {
                    this.validateEmailInput();
                }.bind(this));
                this.messageInput.on('keyup', function () {
                    this.validateMessageInput();
                }.bind(this));
                this.form.on('submit', function (event) {
                    if (this.validateFirstNameInput()
                        && this.validateLastNameInput()
                        && this.validateEmailInput()
                        && this.validateMessageInput()) {
                        return true;
                    }
                    event.preventDefault();
                    this.scrollToElement(this.scrollToError);
                    this.scrollToError.focus();
                }.bind(this));
                $(document).on('keypress', function (e) {
                    if (e.which === 13) {
                        this.form.submit();
                    }
                }.bind(this));
            },
            scrollToElement: function (element) {
                $('body, html').animate({
                    scrollTop: element.offset().top - 50
                }, 500);
            },
            firstNameInputFocus: function () {
                setTimeout(function () {
                    this.firstNameInput.focus();
                }.bind(this), 300);
            },
            validateFirstNameInput: function () {
                var validationMessage = '';
                var formControl = this.firstNameInput.parent('.form-group').find('.form-control');
                var labelTitle = this.firstNameInput.parent('.form-group').find('.label-title');
                var value = this.firstNameInput.val();

                if ((/^[a-zA-Z ]{2,50}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good name.\n';
                    formControl.addClass('valid');
                    labelTitle.addClass('valid-text');
                    this.firstNameError.addClass('valid');
                    this.firstNameError.show();
                } else if (value === '') {
                    validationMessage = 'The name field is required.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.firstNameError.removeClass('valid');
                    this.firstNameError.show();
                } else {
                    validationMessage = 'The name must contain only letter and be minimum of 2 characters.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.firstNameError.removeClass('valid');
                    this.firstNameError.show();
                }

                this.firstNameError.html(validationMessage);
                this.scrollToError = this.firstNameInput;

                return ((/^[a-zA-Z ]{2,50}$/.test(value)));
            },
            validateLastNameInput: function () {
                var validationMessage = '';
                var formControl = this.lastNameInput.parent('.form-group').find('.form-control');
                var labelTitle = this.lastNameInput.parent('.form-group').find('.label-title');
                var value = this.lastNameInput.val();

                if ((/^[a-zA-Z -]{2,50}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good last name.\n';
                    formControl.addClass('valid');
                    labelTitle.addClass('valid-text');
                    this.lastNameError.addClass('valid');
                    this.lastNameError.show();
                } else if (value === '') {
                    validationMessage = 'The last name field is required.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.lastNameError.removeClass('valid');
                    this.lastNameError.show();
                } else {
                    validationMessage = 'The last name must contain only letter and be minimum of 2 characters.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.lastNameError.removeClass('valid');
                    this.lastNameError.show();
                }

                this.lastNameError.html(validationMessage);
                this.scrollToError = this.lastNameInput;

                return ((/^[a-zA-Z -]{2,50}$/.test(value)));
            },
            validateEmailInput: function () {
                var validationMessage = '';
                var formControl = this.emailInput.parent('.form-group').find('.form-control');
                var labelTitle = this.emailInput.parent('.form-group').find('.label-title');
                var value = this.emailInput.val();

                if ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value))) {
                    validationMessage = 'Now, that\'s a good email.\n';
                    formControl.addClass('valid');
                    labelTitle.addClass('valid-text');
                    this.emailError.addClass('valid');
                    this.emailError.show();
                } else if (value === '') {
                    validationMessage = 'The email field is required.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.emailError.removeClass('valid');
                    this.emailError.show();
                } else {
                    validationMessage = 'This email is not valid.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.emailError.removeClass('valid');
                    this.emailError.show();
                }

                this.emailError.html(validationMessage);
                this.scrollToError = this.emailInput;

                return ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)));
            },
            validatePhoneInput: function () {
                var validationMessage = '';
                var formControl = this.phoneInput.closest('.form-group').find('.form-control');
                var labelTitle = this.phoneInput.closest('.form-group').find('.label-title');
                var value = this.phoneInput.val();

                if ((/^[0-9 -]{3,20}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good phone number.\n';
                    formControl.addClass('valid');
                    labelTitle.addClass('valid-text');
                    this.phoneError.addClass('valid');
                    this.phoneError.show();
                } else if (value === '') {
                    validationMessage = 'The phone number field is required.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.removeClass('has-error');
                    labelTitle.removeClass('error-text');
                    this.phoneError.removeClass('valid');
                    this.phoneError.hide();
                } else {
                    validationMessage = 'The phone number must contain only digits and be minimum of 3 characters.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.phoneError.removeClass('valid');
                    this.phoneError.show();
                }

                this.phoneError.html(validationMessage);
                this.scrollToError = this.phoneInput;

                return ((/^[0-9 -]{3,20}$/.test(value)));
            },
            validateMessageInput: function () {
                var validationMessage = '';
                var formControl = this.messageInput.parent('.form-group').find('.form-control');
                var labelTitle = this.messageInput.parent('.form-group').find('.label-title');
                var value = this.messageInput.val();

                if ((/^[a-zA-Z 0-9!@#\$%\^\&*\)\(+=._-]{8,250}$/.test(value))) {
                    validationMessage = 'Now, that\'s a good message.\n';
                    formControl.addClass('valid');
                    labelTitle.addClass('valid-text');
                    this.messageError.addClass('valid');
                    this.messageError.show();
                } else if (value === '') {
                    validationMessage = 'The message field is required.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.messageError.removeClass('valid');
                    this.messageError.show();
                } else {
                    validationMessage = 'The message must be at least 8 characters.';
                    formControl.removeClass('valid');
                    labelTitle.removeClass('valid-text');
                    formControl.addClass('has-error');
                    labelTitle.addClass('error-text');
                    this.messageError.removeClass('valid');
                    this.messageError.show();
                }

                this.messageError.html(validationMessage);
                this.scrollToError = this.messageInput;

                return ((/^[a-zA-Z 0-9!@#\$%\^\&*\)\(+=._-]{8,250}$/.test(value)));
            },
            showPage: function () {
                setTimeout(function () {
                    this.page.fadeIn(300);
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
            register.init();
        });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162285463-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-162285463-1');
    </script>
@endsection
