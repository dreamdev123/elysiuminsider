<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Admin Login</title>
	<link href="{{ asset('css/bootstrap_4.1.3.min.css') }}" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap_4.1.3.min.js') }}" type="text/javascript"></script>
	<style>
		.admin-login-wrapper .form-wrapper h3 {
			font-size: 24px;
			font-weight: 300;
			white-space: nowrap;
		}
		.admin-login-wrapper .english-btn {
			background-image: url('../images/Image/flags_iso/16/us.png');
			background-position: 10%;
			background-size: auto;
			background-repeat: no-repeat;
			padding-left: 34px;
			font-size: 14px;
		}
		.admin-login-wrapper .dropdown-menu {
			min-width: 5rem;
		}
		.admin-login-wrapper .dropdown-menu a {
			background-position: 10%;
			background-size: auto;
			background-repeat: no-repeat;
			padding-left: 34px;
			font-size: 14px;
		}
		.admin-login-wrapper .dropdown-menu .us-sel {
			background-image: url('../images/Image/flags_iso/16/us.png');
		}
		.admin-login-wrapper .dropdown-menu .se-sel {
			background-image: url('../images/Image/flags_iso/16/se.png');
		}
		.has-error {
			display: block;
		}
	</style>
</head>
<body>
	<div class="admin-login-wrapper bg-dark vh-100">
		<div class="logo-wrapper d-flex ml-auto mr-auto mb-4 pt-5"><img src="{{ asset('images/Image/EOSgreen.png') }}" style="width: 180px;" class="ml-auto mr-auto mt-5"></div>
		<div class="form-wrapper ml-auto mr-auto p-4 bg-white " style="max-width: 350px; height: auto;">
			<div class="select-lang-wrapper text-right">
				<div class="btn-group">
					<button type="button" class="btn dropdown-toggle rounded-pill bg-transparent border-secondary outline-0 shadow-none english-btn" data-toggle="dropdown">English</button>
					<div class="dropdown-menu">
						<a href="#" class="dropdown-item us-sel">English</a>
						<a href="#" class="dropdown-item se-sel">Swedish</a>
					</div>
				</div>
			</div>
			
			<form action="{{route('auth::admin-login')}}" method="post" name="admin-login-form">
                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
				@csrf
				<h3 class="mt-4 mb-4">Login to your account</h3>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0 username-iconbox">
								<span class="fa fa-user username-icon"></span>
							</span>
						</div>
						<input type="text" id="username" name="username" class="form-control admin-username-input rounded-0 shadow-none" autocomplete="off" placeholder="Username" id="admin_username_input" tabindex="1" value="{{old('username')}}">
					</div>
					<small id="username-error" class="form-text text-danger has-error" style="display: none">This field is required *</small>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text rounded-0 password-iconbox">
								<span class="fa fa-lock password-icon"></span>
							</span>
						</div>
						<input type="password" id="password" name="password" class="form-control admin-password-input rounded-0 shadow-none" autocomplete="off" placeholder="Password" id="admin-password-input" tabindex="2">
					</div>
					<small id="password-error" class="form-text text-danger has-error" style="display: none">This field is required *</small>
				</div>
				<div class="form-group">
					<label class="d-flex align-items-center">
						<input type="checkbox" name="" class="mr-2 pull-left rounded-0" {{ old('remember') ? 'checked' : '' }} tabindex="3"> Remember me
						<button type="submit" class="btn btn-dark pull-right ml-auto rounded-0 px-4 py-1">Login</button>
					</label>
				</div>
				<!-- <div class="admin-forgot-password d-flex">
					<a href="#" class="text-dark border-none ml-auto mb-3" style="font-size: 15px;">Forgot your password ?</a>
				</div> -->
			</form>
		</div>
	</div>
	<script type="text/javascript">
    const login = {
        init: function () {
            this.variables();
            this.addEventListeners();
            this.firstInputFocus();
            this.showRegisterPage();
        },
        variables: function () {
            this.form = $('form[name="admin-login-form"]');
            this.usernameInput = $('#username');
            this.usernameError = $('#username-error');
            this.passwordInput = $('#password');
            this.passwordError = $('#password-error');
            this.scrollToError = '';
            this.submitButton = $('[data-button="submit"]');
        },
        addEventListeners: function () {
            // this.passwordRegisterEye.on('click', function () {
            //     this.togglePasswordVisibility();
            // }.bind(this));
            this.usernameInput.on('keyup', function () {
                this.validateUsernameInput();
            }.bind(this));
            this.passwordInput.on('keyup', function () {
                this.validatePasswordInput();
            }.bind(this));
            this.form.on('submit', function (event) {
                if (this.validateUsernameInput() &&
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
        firstInputFocus: function () {
            setTimeout(function () {
                this.usernameInput.focus();
            }.bind(this), 300);
        },
        validateUsernameInput: function () {
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
                this.usernameError.hide();
            }

            this.usernameError.html(validationMessage);
            this.scrollToError = this.usernameInput;

            return ((/\d/.test(value)) || (/[a-zA-Z]/.test(value)) || (/^.{5,}$/.test(value)));
        },
        validatePasswordInput: function () {
            var validationMessage = '';
            var value = this.passwordInput.val();

            if ((/\d/.test(value)) || (/[a-zA-Z]/.test(value)) || (/^.{5,}$/.test(value))) {
                validationMessage = 'Now, that\'s a secure password.\n';
                this.errorRegisterPassword();
            } else if ((/\d/.test(value)) || (/[a-zA-Z]/.test(value))) {
                validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong><del>number</del></strong>, and be minimum of <strong>5 characters</strong>.';
                this.validRegisterPassword();
            } else if ((/^.{5,}$/.test(value)) && (/[a-zA-Z]/.test(value))) {
                validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong><del>5 characters</del></strong>.';
                this.validRegisterPassword();
            } else if ((/^.{5,}$/.test(value)) && (/\d/.test(value))) {
                validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong><del>5 characters</del></strong>.';
                this.validRegisterPassword();
            } else if ((/^.{5,}$/.test(value))) {
                validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong><del>5 characters</del></strong>.';
                this.validRegisterPassword();
            } else if ((/\d/.test(value))) {
                validationMessage = 'Password must contain a <strong>letter</strong> and a <strong><del>number</del></strong>, and be minimum of <strong>5 characters</strong>.';
                this.validRegisterPassword();
            } else if ((/[a-zA-Z]/.test(value))) {
                validationMessage = 'Password must contain a <strong><del>letter</del></strong> and a <strong>number</strong>, and be minimum of <strong>5 characters</strong>.';
                this.validRegisterPassword();
            } else if (value === '') {
                validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>5 characters</strong>.';
                this.validRegisterPassword();
            } else {
                validationMessage = 'Password must contain a <strong>letter</strong> and a <strong>number</strong>, and be minimum of <strong>5 characters</strong>.';
                this.validRegisterPassword();
            }

            this.passwordError.html(validationMessage);
            this.scrollToError = this.passwordInput;

            return (/\d/.test(value)) || (/[a-zA-Z]/.test(value)) || (/^.{5,}$/.test(value));
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
            this.passwordError.hide();
        },
        showRegisterPage: function () {
            setTimeout(function () {
                this.backgroundRegister.fadeIn(300);
            }.bind(this), 200)
        }
    };

    $(document).ready(function () {
        login.init();
    });
  </script>
</body>
</html>