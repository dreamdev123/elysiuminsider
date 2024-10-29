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
                <h3 class="mb-3">Forgot password</h3>
                <p class="description-paragraph mb-5">Already signed up? <a href="{{ route('auth::login') }}"
                                                                            class="text-link">Log in</a></p>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                        @if(Session::has('resetLinkSent'))
                            <div class="alert alert-success">Reset password link has been sent to your email!</div>
                        @else
                            <form data-form="login" action="{{route('auth::password-forgot')}}" method="post">
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
                                            <input type="email" name="email" class="form-control" id="email"
                                                   placeholder="Your email address" tabindex="1"
                                                   value="{{old('email')}}">
                                            <label id="email-error" class="has-error" for="email"
                                                   style="display: none"></label>
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
                this.emailInput = $('#email');
                this.emailError = $('#email-error');
                this.backgroundRegister = $('[data-backgound="register"]');
                this.scrollToError = '';
                this.submitButton = $('[data-button="submit"]');
            },
            addEventListeners: function () {
                this.emailInput.on('keyup', function () {
                    this.validateEmailInput();
                }.bind(this));
                this.form.on('submit', function (event) {
                    if (this.validateEmailInput()) {
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
            firstInputFocus: function () {
                setTimeout(function () {
                    this.emailInput.focus();
                }.bind(this), 300);
            },
            validateEmailInput: function () {
                var validationMessage = '';
                var formControlEmail = this.emailInput.parent('.form-group').find('.form-control');
                var value = this.emailInput.val();

                if ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value))) {
                    validationMessage = 'Now, that\'s a good email.\n';
                    formControlEmail.addClass('valid');
                    this.emailError.addClass('valid');
                    this.emailError.show();
                } else if (value === '') {
                    validationMessage = 'The email field is required.';
                    formControlEmail.removeClass('valid');
                    formControlEmail.addClass('has-error');
                    this.emailError.removeClass('valid');
                    this.emailError.show();
                } else {
                    validationMessage = 'This email is not valid.';
                    formControlEmail.removeClass('valid');
                    formControlEmail.addClass('has-error');
                    this.emailError.removeClass('valid');
                    this.emailError.show();
                }

                this.emailError.html(validationMessage);
                this.scrollToError = this.emailInput;

                return ((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)));
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
