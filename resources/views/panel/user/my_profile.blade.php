@extends('panel._layouts.panel', ['ACTIVE_TAB' => 'personal_information'], ['ACTIVE_LIST' => 'profile'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))


@section('PAGE_LEVEL_STYLES')
    <link href="{{asset('plugin/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <style type="text/css">
        .input_font {
            font-family: "DIN Pro Condensed Regular", sans-serif;
            font-size: 16px;
        }
    </style>

@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection
@section('sidemenu_top')

@endsection
@section('content')
    <div class="side-content-menu-up container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="personalInfoCol">
                    <div class="infoTitle mb-5">PERSONAL INFO</div>
                    <form action="{{ route('user::userinfo_update') }}" method="post" data-form="personal-information">
                        @csrf
                        {{--Given Name--}}
                        <div class="form-group">
                            <label for="last_name">Given Name</label>
                            <input type="text" class="form-control input_font" id="last_name" name="last_name" value="{{old('last_name',$user->last_name)}}"/>
                        </div>
                        {{--Surname--}}
                        <div class="form-group">
                            <label for="first_name">Surname</label>
                            <input type="text" class="form-control input_font" id="first_name" name="first_name" value="{{old('first_name',$user->first_name)}}" />
                        </div>
                        {{--Gender--}}
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <div class="radio-list">
                                <label class="radio-container">
                                    <input type="radio" name="gender" value="M"
                                           data-title="Male"
                                           {{$user->gender == "M"?"checked":""}}/>
                                    <span class="checkbox-circle"></span>
                                    <span class="checkbox-name">Male</span>
                                </label>
                                <label class="radio-container">
                                    <input type="radio" name="gender" value="F"
                                           data-title="Female"
                                           {{$user->gender == "F"?"checked":""}}/>
                                    <span class="checkbox-circle"></span>
                                    <span class="checkbox-name">Female</span>
                                </label>
                            </div>
                            <!-- <input type="text" class="form-control" id="gender" name="gender"/> -->
                        </div>
                        {{--Street  Name--}}
                        <div class="form-group">
                            <label for="street_name">Street  Name</label>
                            <input type="text" class="form-control input_font" id="street_name" name="street_name" value="{{old('street_name',$user->street_name)}}"/>
                        </div>
                        {{--House Number--}}
                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input type="text" class="form-control input_font" id="house_number" name="house_number" value="{{old('house_number',$user->house_number)}}"/>
                        </div>
                        {{--City--}}
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control input_font" id="city" name="city" value="{{old('city',$user->city)}}"/>
                        </div>
                        {{--Post Code--}}
                        <div class="form-group">
                            <label for="postal_code">Post Code</label>
                            <input type="text" class="form-control input_font" id="postal_code" name="postal_code" value="{{old('postal_code',$user->postal_code)}}"/>
                        </div>
                        {{--Country--}}
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control input_font" id="country" name="country">
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}" @if ($country['id'] == $user->country) selected @endif >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--Mobile Number--}}
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" class="form-control input_font" id="mobile_number" name="mobile_number" value="{{old('mobile_number',$user->mobile_number)}}"/>
                        </div>
                        {{--E-mail Address--}}
                        <div class="form-group">
                            <label for="email_address">E-mail Address</label>
                            <input type="text" class="form-control input_font" id="email_address" name="email" value="{{old('email',$user->email)}}" disabled/>
                        </div>
                        <input type="hidden" value="personalinfo" name="update_type"/>
                        {{--Update--}}
                        <div class="form-group updateBtnBox mt-5">
                            <button class="btn button-submit" data-button="submit" tabindex="10">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="accountInfoCol">
                    <div class="infoTitle mb-5">ACCOUNT INFO</div>
                    <form action="{{ route('user::userinfo_update') }}" method="post" data-form="accountform">
                        @csrf
                        {{--Client ID--}}
                        <div class="form-group">
                            <label for="customer_id">Customer ID</label>
                            <input type="text" class="form-control input_font" id="customer_id" name="customer_id" value="{{old('customer_id',$user->customer_id)}}" disabled />
                        </div>
                        {{--Username--}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control input_font" id="username" name="username" value="{{old('username',$user->username)}}" disabled />
                        </div>

                        <div class="infoTitle mt-5 mb-5">PASSWORD</div>
                        {{--Current Password--}}
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"/>
                             <label id="current_password-error" class="has-error" for="current_password" style="display: none">This field is required</label>
                        </div>
                        {{--New Password--}}
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                            <label id="password-error" class="has-error" for="password" style="display: none">This field is required</label>
                        </div>
                        {{--Re-type Password--}}
                        <div class="form-group">
                            <label for="password_confirmation">Re-type Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"/>
                            <label id="password_confirmation-error" class="has-error" for="password_confirmation" style="display: none">This field has to be equal to New Password</label>
                        </div>
                        <input type="hidden" value="accountinfo" name="update_type"/>

                        {{--Update--}}
                        <div class="form-group updateBtnBox mt-5">
                            <button class="btn button-submit" data-button="account-submit" tabindex="10">Update</button>
                        </div>
                    </form>

                    <div class="infoTitle mt-5 mb-5">Company Info</div>
                    <form action="{{ route('user::userinfo_update') }}" method="post" data-form="companyform">
                        @csrf
                        
                        <input type="hidden" value="companyinfo" name="update_type"/>
                        
                        {{--Company Name--}}
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control input_font" id="company_name" name="company_name" value="{{old('company_name', $user->company_name)}}"/>
                        </div>
                        {{--Company Registration NR--}}
                        <div class="form-group">
                            <label for="company_registration_nr">Company Registration NR</label>
                            <input type="text" class="form-control input_font" id="company_registration_nr" name="company_registration_nr" value="{{old('company_registration_nr', $user->company_registration_nr)}}"/>
                        </div>
                        {{--Company Address--}}
                        <div class="form-group">
                            <label for="company_address">Company Address</label>
                            <input type="text" class="form-control input_font" id="company_address" name="company_address" value="{{old('company_address', $user->company_address)}}"/>
                        </div>
                        {{--Confirm You are UBO-Director--}}
                        <div class="form-group">
                            <div class="radio-list">
                                <label class="radio-container">
                                    <input type="checkbox" name="company_ubo_director"
                                           data-title="Confirm You are UBO-Director"
                                           {{$user->company_ubo_director == "1"?"checked":""}}/>
                                    <span class="checkbox-circle"></span>
                                    <span class="checkbox-name">Confirm You are UBO-Director</span>
                                </label>
                            </div>
                            <!-- <input type="text" class="form-control" id="gender" name="gender"/> -->
                        </div>

                        {{--Update--}}
                        <div class="form-group updateBtnBox mt-5">
                            <button class="btn button-submit" data-button="company-submit" tabindex="10">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="legalInfoCol">
                    <div class="infoTitle mb-5">LEGAL INFO</div>
                    <form action="{{ route('user::userinfo_update') }}" method="post" data-form="legalform">
                        @csrf
                        {{--Passport Number--}}
                        <div class="form-group">
                            <label for="passport_id">Passport Number</label>
                            <input type="text" class="form-control input_font" id="passport_id" name="passport_id" value="{{old('passport_id',$user->passport_id)}}"/>
                        </div>
                        {{--Date of Passport Issuance--}}
                        <div class="form-group">
                            <label for="date_of_passport_issuance">Date of Passport Issuance</label>
                            <input type="text" class="form-control input_font" id="date_of_passport_issuance" name="date_of_passport_issuance" readonly tabindex="4" value="{{old('date_of_passport_issuance',$user->date_of_passport_issuance)}}"/>
                        </div>
                        {{--Passport Expiration Date--}}
                        <div class="form-group">
                            <label for="date_of_passport_expiration">Passport Expiration Date</label>
                            <input type="text" class="form-control input_font" id="date_of_passport_expiration" name="date_of_passport_expiration" readonly tabindex="4" value="{{old('date_of_passport_expiration',$user->date_of_passport_expiration)}}"/>
                        </div>
                        {{--Date of Birth--}}
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="text" class="form-control input_font" id="date_of_birth" name="date_of_birth" readonly="" tabindex="4" value="{{old('date_of_birth',$user->date_of_birth)}}"/>
                        </div>
                        {{--Place of Birth--}}
                        <div class="form-group">
                            <label for="country_of_birth">Place of Birth</label>
                            <select class="form-control input_font" id="country_of_birth" name="country_of_birth">
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}" @if ($country['id'] == $user->country_of_birth) selected @endif >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--Country of Passport Issuance--}}
                        <div class="form-group">
                            <label for="country_of_passport_issuance">Country of Passport Issuance</label>
                            <select class="form-control input_font" id="country_of_passport_issuance" name="country_of_passport_issuance">
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}" @if ($country['id'] == $user->country_of_passport_issuance) selected @endif >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--Nationality--}}
                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <select class="form-control input_font" id="nationality" name="nationality">
                                @foreach($countries as $country)
                                <option value="{{$country['id']}}" @if ($country['id'] == $user->nationality) selected @endif >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value="legalinfo" name="update_type"/>
                        {{--Update--}}
                        <div class="form-group updateBtnBox mt-5">
                            <button class="btn button-submit" data-button="legal-submit" tabindex="10">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
    <script src="{{ url('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        const register = {
            init: function () {
                this.variables();
                this.firstInputFocus();
                this.addEventListeners();
                this.validateForms();
                this.datePicker();
            },
            variables: function () {
                this.form = $('[data-form="personal-information"]');
                this.accountform = $('[data-form="accountform"]');
                this.submitButton = $('[data-button="submit"]');
                this.updatebutton = $('[data-button="account-submit"]');
                this.dateBirthInput = $('#date_of_birth');
                this.date_of_passport_expiration = $('#date_of_passport_expiration');
                this.date_of_passport_issuance = $('#date_of_passport_issuance');
                this.legalform = $('[data-form="legalform"]');
                this.legalbutton = $('[data-button="legal-submit"]');
            },
            addEventListeners: function () {
                this.form.on('submit', function (event) {
                    // event.preventDefault();
                    this.validateForms();
                }.bind(this));

                this.accountform.on('submit',function(event){
                    this.validateForms();
                }.bind(this))

                this.legalform.on('submit',function(event){
                    this.validateForms();
                }.bind(this))
                
                this.submitButton.on('click', function () {
                    this.form.submit();
                }.bind(this));

                this.updatebutton.on('click',function(){
                    this.accountform.submit();
                }.bind(this))

                this.legalbutton.on('click',function(event){
                    this.legalform.submit();
                }.bind(this))

                $(document).on('keypress', function (e) {
                    if (e.which === 13) {
                        this.form.submit();
                    }
                }.bind(this));


            },
            firstInputFocus: function () {
                $('#first_name').focus();
            },
            adderror:function(element,errtext){
                $(element).closest('.form-group').find('label').addClass('error-text');
                $(element).closest('.form-group').find('label').removeClass('valid-text');
                $(element).closest('.form-group').find('input').addClass("has-error");
                $(element).closest('.form-group').find('input').removeClass('valid');
                $(element).closest('.form-group').find('label').show();
            },
            hideerror:function(element){
                $(element).closest('.form-group').find('label').removeClass('error-text');
                $(element).closest('.form-group').find('label').addClass('valid-text');
                $(element).closest('.form-group').find('input').removeClass("has-error");
                $(element).closest('.form-group').find('input').addClass('valid');
                $(element).closest('.form-group').find('label').hide();
            },
            validateForms: function () {
                this.form.validate({
                    errorClass: "has-error",
                    validClass: 'valid',
                    onkeyup: function (element) {
                        $(element).valid();
                    },
                    rules: {
                        first_name: {
                            required: true,
                            minlength: 3,
                            maxlength: 50
                        },
                        last_name: {
                            required: true,
                            minlength: 3,
                            maxlength: 50
                        },
                        mobile_number: {
                            required: true,
                            phone_number: true,
                            minlength: 7,
                            maxlength: 17
                        },
                        country: {
                            required: true
                        },
                        state: {
                            required: true,
                            minlength: 2,
                            maxlength: 64
                        },
                        street_name: {
                            required: true,
                            minlength: 2,
                            maxlength: 100
                        },
                        house_number: {
                            required: true,
                            minlength: 1,
                            maxlength: 100
                        },
                        city: {
                            required: true,
                            minlength: 2,
                            maxlength: 60
                        },
                        postal_code: {
                            required: true,
                            number: true,
                            minlength: 2,
                            maxlength: 10
                        },
                        email:{
                            required:true,
                            email:true
                        }


                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').addClass('error-text');
                        $(element).closest('.form-group').find('label').removeClass('valid-text');
                        $(element).closest('.form-group').find('input').addClass(errorClass);
                        $(element).closest('.form-group').find('input').removeClass(validClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').removeClass('error-text');
                        $(element).closest('.form-group').find('label').addClass('valid-text');
                        $(element).closest('.form-group').find('input').removeClass(errorClass);
                        $(element).closest('.form-group').find('input').addClass(validClass);
                    }

                });

                this.legalform.validate({
                    errorClass: "has-error",
                    validClass: 'valid',
                    onkeyup: function (element) {
                        $(element).valid();
                    },
                    rules: {
                        passport_id: {
                            required: true,
                            number:true,
                            minlength: 3,
                            maxlength: 50
                        },
                        date_of_passport_issuance: {
                            required: true,
                            issuance_date: true
                        },
                        date_of_passport_expiration: {
                            required: true,
                            expiration_date: true
                        },
                        date_of_birth: {
                            required: true,
                            birthday_date: true
                        }

                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').addClass('error-text');
                        $(element).closest('.form-group').find('label').removeClass('valid-text');
                        $(element).closest('.form-group').find('input').addClass(errorClass);
                        $(element).closest('.form-group').find('input').removeClass(validClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').removeClass('error-text');
                        $(element).closest('.form-group').find('label').addClass('valid-text');
                        $(element).closest('.form-group').find('input').removeClass(errorClass);
                        $(element).closest('.form-group').find('input').addClass(validClass);
                    }

                });

                this.accountform.validate({
                    errorClass: "has-error",
                    validClass: 'valid',
                    onkeyup: function (element) {
                        $(element).valid();
                    },
                    rules: {
                        customer_id: {
                            required: true,
                            minlength: 3,
                            maxlength: 50
                        },
                        username: {
                            required: true,
                            minlength: 3,
                            maxlength: 50
                        }
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').addClass('error-text');
                        $(element).closest('.form-group').find('label').removeClass('valid-text');
                        $(element).closest('.form-group').find('input').addClass(errorClass);
                        $(element).closest('.form-group').find('input').removeClass(validClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).closest('.form-group').find('label').removeClass('error-text');
                        $(element).closest('.form-group').find('label').addClass('valid-text');
                        $(element).closest('.form-group').find('input').removeClass(errorClass);
                        $(element).closest('.form-group').find('input').addClass(validClass);
                    }
                });

                let self = this;
                this.accountform.on('submit',function(event){
                    self.hideerror($('#password')[1]);
                    self.hideerror($('#password_confirmation')[1]);
                    self.hideerror($('#current_password')[1]);

                    if(!$('#current_password').val())
                    {
                        $('#current_password').focus();
                        self.adderror($('#current_password')[0],'This field is required');
                        return false;
                    }
                    else if($('#current_password').val() && !$('#password').val())
                    {
                        $('#password').focus();
                        self.adderror($('#password')[0],"This field is required");
                        return false;
                    }
                    else if($('#password').val() && $('#password').val() != $('#password_confirmation').val())
                    {
                        $('#password_confirmation').focus();
                        self.adderror($('#password_confirmation')[0],"This field has to be equal to Re Type Password");
                        return false;
                    }
                    else if(!$('#current_password').val() && $('#password').val())
                    {
                        $('#current_password').focus();
                        self.adderror($('#current_password')[0],'This field is required');
                        return false;
                    }
                    else if($('#current_password').val() && !$('#password').val())
                    {
                        $('#password').focus();
                        self.adderror($('#password')[0],"This field is required");
                        return false;
                    }
                    else if(!this.accountform.valid())
                    {
                        return false;
                    }

                }.bind(this))

                jQuery.validator.addMethod("phone_number", function (value, element) {
                    return this.optional(element) || /^[+]+[0-9 ]*$/.test(value);
                }, "Input valid phone number i.e. +48 123 456 789 or +48&nbsp;58&nbsp;123&nbsp;45&nbsp;67. Remember to use prefix.");

                jQuery.validator.addMethod("birthday_date", function (value, element) {
                    return this.optional(element) || /^([0-9][0-9][0-9][0-9])-(0[0-9]|1[0-2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$/.test(value);
                }, "Please enter your birthday as MM/DD/YYYY.");

                jQuery.validator.addMethod("expiration_date", function (value, element) {
                    return this.optional(element) || /^([0-9][0-9][0-9][0-9])-(0[0-9]|1[0-2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$/.test(value);
                }, "Please enter your passport's expiration date as MM/DD/YYYY.");

                jQuery.validator.addMethod("issuance_date", function (value, element) {
                    return this.optional(element) || /^([0-9][0-9][0-9][0-9])-(0[0-9]|1[0-2])-(0[0-9]|1[0-9]|2[0-9]|3[0-1])$/.test(value);
                }, "Please enter your passport's issuance date as MM/DD/YYYY.");

            },
            datePicker: function () {
                this.dateBirthInput.datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    endDate: '-18y',
                    format: 'yyyy-mm-dd',
                    showOnFocus: true
                }).on('hide', function () {
                    $('#birth_date').valid();
                    if (!this.firstHide) {
                        if (!$(this).is(":focus")) {
                            this.firstHide = true;
                            // this will inadvertently call show (we're trying to hide!)
                            this.focus();
                        }
                    } else {
                        this.firstHide = false;
                    }
                }).on('show', function () {
                    if (this.firstHide) {
                        // careful, we have an infinite loop!
                        $(this).datepicker('hide');
                    }
                });

                this.date_of_passport_issuance.datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    startDate: '-40y',
                    endDate: '-0y',
                    format: 'yyyy-mm-dd',
                    showOnFocus: true
                }).on('hide', function () {
                    $('#date_of_passport_issuance').valid();
                    if (!this.firstHide) {
                        if (!$(this).is(":focus")) {
                            this.firstHide = true;
                            // this will inadvertently call show (we're trying to hide!)
                            this.focus();
                        }
                    } else {
                        this.firstHide = false;
                    }
                }).on('show', function () {
                    if (this.firstHide) {
                        // careful, we have an infinite loop!
                        $(this).datepicker('hide');
                    }
                });

                this.date_of_passport_expiration.datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    startDate: '+1d',
                    endDate: '+40y',
                    format: 'yyyy-mm-dd',
                    showOnFocus: true
                }).on('hide', function () {
                    $('#date_of_passport_expiration').valid();
                    if (!this.firstHide) {
                        if (!$(this).is(":focus")) {
                            this.firstHide = true;
                            // this will inadvertently call show (we're trying to hide!)
                            this.focus();
                        }
                    } else {
                        this.firstHide = false;
                    }
                }).on('show', function () {
                    if (this.firstHide) {
                        // careful, we have an infinite loop!
                        $(this).datepicker('hide');
                    }
                })
            },
            addLoader: function () {
                this.submitButton.addClass('loader');
            },
            removeLoader: function () {
                this.submitButton.removeClass('loader');
            }
        };

        $('form').submit(function(){

          var url = $(this).attr('action');
          $.ajax({
            url:url,
            method:"POST",
            data:$(this).serialize(),
            success:function(res){
                console.log(res)
                if (res.success) {
                    toastr['success']("You have updated successfully");
                } else {
                    for(item in res.message)
                    {
                        toastr['error'](res.message[item][0]);
                    }
                }
            },
            error:function(err){
                toastr['error'](err.responseJSON.error);
            }
          })

          return false;
        })

        $(document).ready(function () {
            register.init();
        });
    </script>
@endsection
