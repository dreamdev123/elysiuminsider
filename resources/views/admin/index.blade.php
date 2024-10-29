@extends('admin._layout.admin')


@section('PAGE_LEVEL_STYLES')
<style type="text/css">
  .ajaxFetcherWrapper {
    display: none;
    width: 80%;
    margin-top: 10px;
    z-index: 1000; 
    background: #fff;
    position: absolute;
  }

  ul.ajaxFetcher {
    border: 1px solid #d4d4d4;
    padding: 0;
    background: white;
    border-radius: 3px !important;
    list-style: none;
    min-height: 36px;
    width: 100%;
    max-height: 250px;
    position: relative;
    overflow-y: auto;
    list-style: none;
  }

  ul.ajaxFetcher li {
    padding: 7px;
    white-space: nowrap;
    color: #666;
    cursor: pointer;
    border-bottom: 1px dotted #eaeaea;
  }
  .advSearchResult {
    display: none;
    border: 1px solid #ddd;
    margin-bottom: 20px;
    background: white;
}
.resultSummary h3 {
    font-size: 18px;
    /* display: inline-block; */
    /* border-bottom: 2px solid #616161; */
    font-weight: 600;
    /* padding-bottom: 5px; */
    margin: 20px 0px;
    overflow: hidden;
}
.resultSummary h3 span {
    color: green;
    font-weight: 400;
    margin-left: 5px;
}
  .resultSummary {
    padding: 0 15px;
}
  .btn.btn-outline.red {
    border-color: #e7505a;
    color: #e7505a;
    background: 0 0;
}
button.closeAdvResults {
    float: right;
    padding: 4px 8px;
    font-size: 11px;
}
.btn-circle {
    border-radius: 25px!important;
    overflow: hidden;
}
.resultHolder {
    padding: 10px;
}
  .setHolder .resultSet {
    padding: 9px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    margin-bottom: 15px;
}
.setHolder .resultSet .headerData {
    overflow: hidden;
    margin-bottom: 8px;
    padding-bottom: 5px;
    border-bottom: 1px solid #b3b3b3;
}
.setHolder .resultSet .headerData .profilePic {
    width: 45px;
    height: 45px;
    border-radius: 50% !important;
    overflow: hidden;
    display: inline-block;
    position: relative;
    float: left;
    margin-right: 10px;
    top: 3px;
}
.setHolder .resultSet .headerData .profilePic img {
    width: 100%;
}
.setHolder .resultSet .headerData .data {
    display: inline-block;
    padding: 15px 0;
}
.setHolder .resultSet .headerData .data .username {
    font-size: 16px;
    font-weight: 600;
}
.resultSet .eachData {
    padding: 5px 0;
    border-bottom: 1px solid #eaeaea;
    /* font-size: 14px; */
}
.resultSet .eachData label {
    font-weight: 600;
    min-width: 30%;
    margin: 0;
}
.noAdvSearchResults {
    text-align: center;
    font-size: 18px;
    color: #969696;
    padding: 10px;
}
.has-error {
    color: #e7505a !important;
}
</style>
@endsection


@section('PAGE_START')
@endsection


@section('content')


      <!-- Content -->
      <div id="content" style="background-color: #e3e3e3">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <h3 class="mt-3" style="overflow: hidden;font-weight: 600; line-height: 1.3 !important;font-size: 22px !important; width: 100%;">Member Management</h3>
            </div>
          </div>
          <div class="row">
            <div class="offset-lg-3 col-lg-9 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="search-holder d-flex col-lg-9" style="border-bottom: 1px solid #6b6b6b; align-items: center; ">
                  <i class="fa fa-search" style="height: 20px; margin-right: 12px;"></i>
                  <input type="text" name="" class="w-75 bg-transparent" style="border: none; outline: 0;" placeholder="Member search...">
                </div>
                <div class="col-lg-3">
                    <button class="btn rounded-pill shadow-none text-white advSearch" style="background-color: #3598dc; border: none;"><span class="fa fa-binoculars"></span> Advanced
                    </button>
                </div>
              </div>
              <div class="ajaxFetcherWrapper">
                <ul class="ajaxFetcher">
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="offset-lg-3 col-lg-9 col-md-12 col-sm-12 col-12 pl-0 mb-4">
              <p class="mt-4 mb-2" style="font-family: 'Open Sans',sans-serif; font-size: 16px; font-weight: 500">Member ID</p>
              <input type="text" class="rounded-0 p-1 bg-white border-none member_id_filter" style="outline: none; font-size: 14px; padding: 6px 12px; border: 1px solid #c2cad8;" name="" placeholder="Enter Member ID">
            </div>
          </div>
          <div class="advSearchResult col-md-12">
              <div class="resultSummary">
                  <h3>
                      Found<span>1</span> results
                      <button class="btn btn-circle btn-outline red closeAdvResults">close</button>
                  </h3>
              </div>
              <div class="resultHolder row">
              </div>
          </div>
          <div class="memberManagementWrapper row">
              <div class="memberNav col-md-3 col-sm-3 pr-0">
                  <div class="navCard" data-user="{{ $user->id }}">
                      <div class="headerDetails">
                          <img src="{{ asset('images/Image') }}{{ $user->gender == 'F' ? '/femaleUser.jpg' : '/maleUser.jpg'}}">
                          <label class="username"><span>{{ strtoupper($user->username[0]) }}</span> {{ $user->username }}</label>
                          <h3>Elysium Capital</h3>
                      </div>
                      <div class="metaData">
                          <ul class="memberOptions list-unstyled">
                              <li class="active" data-target="profile">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  <p>Profile</p>
                              </li>
                              <!-- <li data-target="referral_list">
                               <i class="fa fa-user" aria-hidden="true"></i>
                                  <p>Referral List</p>
                              </li>
                              <li data-target="client_list">
                               <i class="fa fa-user" aria-hidden="true"></i>
                                  <p>Client List</p>
                              </li>
                              <li data-target="notes_comments">
                               <i class="fa fa-user" aria-hidden="true"></i>
                                  <p>Notes</p>
                              </li> -->
                          </ul>
                      </div>
                  </div>        
              </div>

              <div class="memberPanel col-md-9 col-sm-9 pl-0" data-unit="memberSlice" style="position: relative;">
                  <div class="slice active" data-user="2">
                      <div class="panelForm unit active" data-unit="profile" data-target="profile" style="position: relative;">
                          <div class="heading">
                              <h3>Profile</h3>
                          </div>

                          <div class="profileManagement row">
                              <div class="col-md-3 col-sm-3 profileNavWrapper">
                                  <div class="navInner">
                                      <div class="profileNav active" data-target="account">
                                          <i class="fa fa-at mr-2"></i>Account Info
                                      </div>
                                      <div class="profileNav" data-target="profile">
                                          <i class="fa fa-user mr-2"></i>Profile Info
                                      </div>
                                      <div class="profileNav" data-target="password">
                                          <i class="fa fa-lock mr-2"></i>Security Info
                                      </div>
                                      <div class="profileNav" data-target="notes_info">
                                          <i class="fa fa-sticky-note mr-2"></i>Notes
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-9 col-sm-9 profilePanelWrapper">
                                <div class="profilePanelInner">
                                  <div class="profilePanel active" data-target="account">
                                      <div class="profileSection mfkToggleWrap">
                                          <h3 class="mfkToggle">Account Info</h3>
                                          <div class="profileSectionBody toggleBody" style="display: block">
                                          <form method="POST" action="{{route('admin.members.profileUsername')}}" class="form ajaxSave" id="usernameForm{{$user->id}}">
                                            @csrf
                                            <input type="hidden" name="userId" value="{{ $user->id }}" readonly>
                                              <fieldset>
                                              
                                                <legend>Basic Info</legend>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <label>Member ID</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label>{{ $user->customer_id }}</label>
                                                    </div>
                                                </div>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <label>Username</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="{{ $user->username }}">
                                                    </div>
                                                </div>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <label>Sign Up</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label>{{ $user->created_at ?? '' }}</label>
                                                    </div>
                                                </div>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <label>Sponsor</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label>{{ $sponsor }}</label>
                                                    </div>
                                                </div>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#usernameSaveModal_{{ $user->id }}" style="min-width: 100px">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="usernameSaveModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="usernameSaveModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>This will save your information, would you like to continue?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div type="button" class="btn green ladda-button usernameSave" data-style="contract" data-dismiss="modal"><span class="ladda-label">
                                                                    Save
                                                                </span><span class="ladda-spinner"></span></div>
                                                                <button type="button" class="btn default" data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </fieldset>
                                            </form>
                                            <form method="POST" action="{{route('admin.members.profileSponsorId')}}" class="form ajaxSave" id="sponsorIdForm{{$user->id}}">
                                              @csrf
                                              <input type="hidden" name="userId" value="{{ $user->id }}" readonly>
                                              <fieldset>
                                                <legend>Change Sponsor</legend>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <label>Sponsor Customer ID</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" placeholder="Sponsor's customer id" name="sponsor_customer_id" id="sponsor_customer_id">
                                                    </div>
                                                </div>
                                                <div class="eachField row">
                                                    <div class="col-md-5">
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sponsorIdSaveModal_{{ $user->id }}" style="min-width: 100px">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="sponsorIdSaveModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="sponsorIdSaveModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>This will save your information, would you like to continue?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div type="button" class="btn green ladda-button sponsorIdSave" data-style="contract" data-dismiss="modal"><span class="ladda-label">
                                                                    Save
                                                                </span><span class="ladda-spinner"></span></div>
                                                                <button type="button" class="btn default" data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </fieldset>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="profilePanel" data-target="profile">
                                      <div class="profileSection mfkToggleWrap">
                                          <form method="POST" action="{{route('admin.members.profileProfile')}}" class="form ajaxSave" id="profileForm{{$user->id}}">
                                            @csrf
                                              <input type="hidden" name="userId" value="{{ $user->id }}" readonly>
                                              <h3 class="mfkToggle">Personal</h3>
                                              <div class="profileSectionBody toggleBody" style="display: block">
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>First Name<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{ $user->first_name }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Last Name<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{ $user->last_name }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Date of Birth<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="datePicker date_of_birth" data-date-format="yyyy-mm-dd" name="date_of_birth" value="{{ $user->date_of_birth }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Passport Number<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Passport Number" name="passport_id" id="passport_id" value="{{ $user->passport_id }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Gender<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7 mt-radio-inline" style="padding: 0px 10px;">
                                                          <label class="mt-radio">
                                                              <input type="radio" name="gender" id="optionsRadios25" value="M" @if($user->gender == 'M') checked @endif> Male
                                                              <span></span>
                                                          </label>
                                                          <label class="mt-radio">
                                                              <input type="radio" name="gender" id="optionsRadios26" value="F" @if($user->gender == 'F') checked @endif> Female
                                                              <span></span>
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Nationality<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <select name="nationality" id="country_list" class="form-control select2-hidden-accessible rounded-0" style="width:100%;" tabindex="-1" aria-hidden="true">
                                                              @foreach($countries as $country)
                                                                  <option value="{{ $country['id'] }}"
                                                                          @if($country['id'] == $user->nationality ) selected @endif>{{ $country['name'] }}</option>
                                                              @endforeach
                                                          </select>                                         
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Place of Birth<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <select name="country_of_birth" id="country_list" class="form-control select2-hidden-accessible rounded-0" style="width:100%;" tabindex="-1" aria-hidden="true">
                                                              @foreach($countries as $country)
                                                                  <option value="{{ $country['id'] }}"
                                                                          @if($country['id'] == $user->country_of_birth ) selected @endif>{{ $country['name'] }}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label> Date of Passport Issuance<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="datePicker date_of_passport_issuance" data-date-format="yyyy-mm-dd" placeholder=" Date of Passport Issuance" name="date_of_passport_issuance" value="{{ $user->date_of_passport_issuance }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Passport Expiration Date<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="datePicker date_of_passport_expiration" data-date-format="yyyy-mm-dd" placeholder="Passport Expiration Date" name="date_of_passport_expiration" value="{{ $user->date_of_passport_expiration }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label> Country of Passport Issuance<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <select name="country_of_passport_issuance" id="country_list" class="form-control select2-hidden-accessible rounded-0" style="width:100%;" tabindex="-1" aria-hidden="true">
                                                              @foreach($countries as $country)
                                                                  <option value="{{ $country['id'] }}"
                                                                          @if($country['id'] == $user->country_of_passport_issuance ) selected @endif>{{ $country['name'] }}</option>
                                                              @endforeach                      
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>E-mail<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="E-mail" name="email" id="email" value="{{ $user->email }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Phone<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Phone" name="mobile_number" id="mobile_number" value="{{ $user->mobile_number }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Street Name<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Street Name" name="street_name" id="street_name" value="{{ $user->street_name }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>House Number<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="House Number" name="house_number" id="house_number" value="{{ $user->house_number }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Postal Code<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Postal Code" name="postal_code" id="postal_code" value="{{ $user->postal_code }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Country<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <select name="country" id="country_list" class="form-control select2-hidden-accessible rounded-0 box-shadow-0" style="width:100%;" tabindex="-1" aria-hidden="true">
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country['id'] }}"
                                                                        @if($country['id'] == $user->country ) selected @endif>{{ $country['name'] }}</option>
                                                            @endforeach
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>City<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="City" name="city" id="city" value="{{ $user->city }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Company Name</label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name" value="{{ $user->company_name }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Company Registration NR</label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Company Registration NR" name="company_registration_nr" id="company_registration_nr" value="{{ $user->company_registration_nr }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Company Address</label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="text" class="form-control" placeholder="Company Address" name="company_address" id="company_address" value="{{ $user->company_address }}">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Confirm You are UBO-Director</label>
                                                      </div>
                                                      <div class="col-md-7 mt-radio-inline" style="padding: 0px 10px;">
                                                          <label class="mt-radio">
                                                              <input type="checkbox" name="company_ubo_director" id="company_ubo_director" @if($user->company_ubo_director == '1') checked @endif> Confirm
                                                              <span></span>
                                                          </label>
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#profileSaveModal_{{ $user->id }}" style="min-width: 100px">
                                                              Save
                                                          </button>
                                                      </div>
                                                  </div>
                                                  <div class="modal fade" id="profileSaveModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="profileSaveModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">×</span>
                                                                  </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>This will save your information, would you like to continue?</p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn green ladda-button profileSave" data-style="contract" data-dismiss="modal"><span class="ladda-label">
                                                                      Save
                                                                  </span><span class="ladda-spinner"></span></button>
                                                                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                                  <div class="profilePanel" data-target="password">
                                      <div class="profileSection mfkToggleWrap">
                                        <form method="POST" action="{{route('admin.members.profilePassword')}}" class="form ajaxSave" id="passwordForm{{$user->id}}">
                                            @csrf
                                              <input type="hidden" name="userId" value="{{ $user->id }}" readonly>
                                              <h3 class="mfkToggle">Change Password</h3>
                                              <div class="profileSectionBody toggleBody" style="display: block">
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Password<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="password" class="form-control" name="password" id="password">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <label>Confirm Password<span class="required" aria-required="true"> * </span></label>
                                                      </div>
                                                      <div class="col-md-7">
                                                          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                                      </div>
                                                  </div>
                                                  <div class="eachField row">
                                                      <div class="col-md-5">
                                                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#passwordSaveModal_{{ $user->id }}" style="min-width: 100px">
                                                              Save
                                                          </button>
                                                      </div>
                                                  </div>
                                                  <div class="modal fade" id="passwordSaveModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="passwordSaveModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">×</span>
                                                                  </button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>This will save your information, would you like to continue?</p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn green ladda-button passwordSave" data-style="contract" data-dismiss="modal"><span class="ladda-label">
                                                                      Save
                                                                  </span><span class="ladda-spinner"></span></button>
                                                                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                        </form>
                                      </div>
                                  </div>
                                  <div class="profilePanel" data-target="notes_info">
                                      <div class="profileSection mfkToggleWrap">
                                          <form method="POST" action="{{route('admin.members.profileNotes')}}" class="form ajaxSave" id="notesForm{{$user->id}}">
                                            @csrf
                                              <input type="hidden" name="userId" value="{{ $user->id }}" readonly>
                                              <h3 class="mfkToggle">Notes Info</h3>
                                              <div class="profileSectionBody toggleBody" style="display: block">
                                                      <div class="eachField row">
                                                          <div class="col-md-12">
                                                              <textarea class="form-control" placeholder="Notes" name="notes" id="notes" rows="20">{{ $user->notes }}</textarea>
                                                          </div>
                                                      </div>
                                                      <div class="eachField row">
                                                          <div class="col-md-5">
                                                              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#notesSaveModal_{{ $user->id }}" style="min-width: 100px">
                                                                  Save
                                                              </button>
                                                          </div>
                                                      </div>
                                                      <div class="modal fade" id="notesSaveModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="notesSaveModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">×</span>
                                                                      </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                      <p>This will save your information, would you like to continue?</p>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <div type="button" class="btn green ladda-button notesSave" data-style="contract" data-dismiss="modal"><span class="ladda-label">
                                                                          Save
                                                                      </span><span class="ladda-spinner"></span></div>
                                                                      <button type="button" class="btn default" data-dismiss="modal">Close
                                                                      </button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>

      <script>
        "use strict";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#content').on('click', function() {
          $('.ajaxFetcherWrapper').hide();
          $('.advSearchResult').hide();
        })

        $('.closeAdvResults').on('click', function() {
          $('.advSearchResult').hide();
        })

        $('.search-holder input[type="text"]').on('keyup', function() {
          if($(this).val() == '') {
            $('.ajaxFetcherWrapper').hide();
          } else {
            var options = {
                keyword: $(this).val(),
            };
            $.ajax({
              url: '{{ route("admin.members.filter") }}',
              method: "POST",
              data: options,
              success:function(res){
                if (res.length) {
                  var html = '<ul  class="ajaxFetcher">';
                  for(var resIndex = 0; resIndex < res.length; resIndex++) {
                    html += '<li class="eachItem" data-id="' + res[resIndex].id +'"><i class="fa fa-user"></i> ' + res[resIndex].username + '</li>';
                  }
                  html += '</ul';
                  $('.ajaxFetcherWrapper').html(html);
                  $('.ajaxFetcherWrapper').show();
                } else {
                  var html = '<ul  class="ajaxFetcher">'
                    +'<li class="eachItem"><i class="fa fa-user"></i> No data</li>'
                    +'</ul';
                  $('.ajaxFetcherWrapper').html(html);
                  $('.ajaxFetcherWrapper').show();
                }
              },
              error:function(err){
                  toastr['error']('Error');
              }
            })
          }
        })

        $(document).on('click', '.eachItem', function() {
            window.location.href = '{{config('app.url')}}' + '/admin/' + $(this).data('id');
        })

        $('button.advSearch').click(function () {
          var options = {
              memberId: $('.member_id_filter').val()
          };
          $.ajax({
            url: '{{ route("admin.members.filter") }}',
            method: "POST",
            data: options,
            success:function(res){
              console.log(res)
              if (res.length) {
                $('.advSearchResult .resultSummary').find('h3 span').text(res.length);
                let output = '';
                output += '<div class="col-md-3 setHolder">\n' +
                    '                <div class="resultSet" data-id="' + res[0].id + '">\n' +
                    '                    <div class="headerData">\n' +
                    '                        <div class="profilePic">\n' +
                    '                            <img src="{{ asset('images/Image') }}' + ((res[0].gender == 'F')?'/femaleUser.jpg':'/maleUser.jpg') + '">\n' +
                    '                        </div>\n' +
                    '                        <div class="data">\n' +
                    '                            <div class="username">' + res[0].username + '</div>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                    <div class="bodyData">\n' +
                    '                        <div class="eachData">\n' +
                    '                           <label>Full Name</label>\n' +
                    '                            <span class="value">' + res[0].first_name + ' ' + res[0].last_name + '</span>\n' +
                    '                        </div>\n' +
                    '                        <div class="eachData">\n' +
                    '                          <label>Email</label>\n' +
                    '                            <span class="value">' + res[0].email + '</span>\n' +
                    '                        </div>\n' +
                    '                        <div class="eachData">\n' +
                    '                            <label>Phone</label>\n' +
                    '                            <span class="value">' + res[0].mobile_number + '</span>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div></div>';
                $('.advSearchResult .resultHolder').html(output);
                $('.advSearchResult').show();
              } else {
                $('.advSearchResult .resultSummary').find('h3 span').text(res.length);
                $('.advSearchResult .resultHolder').html("<div class='noAdvSearchResults'>No results !!</div>");
                $('.advSearchResult').show();
              }
            },
            error:function(err){
                toastr['error']('Error');
            }
          })
        });

        $(document).on('click', '.resultSet', function() {
            window.location.href = '{{config('app.url')}}' + '/admin/' + $(this).data('id');
        })


        $('[data-target="account"]').on('keyup', 'input', function () {
            $('[data-target="#usernameSaveModal"]').text('Save');
        });

        $('[data-target="profile"]').on('keyup', 'input', function () {
            $('[data-target="#profileSaveModal"]').text('Save');
        });

        $('[data-target="profile"]').on('change', 'select', function () {
            $('[data-target="#profileSaveModal"]').text('Save');
        });

        $('[data-target="password"]').on('keyup', 'input', function () {
            $('[data-target="#passwordSaveModalLabel"]').text('Save');
        });

        $('[data-target="notes_info"]').on('keyup', 'textarea', function () {
            $('[data-target="#notesSaveModalLabel"]').text('Save');
        });

        $(function () {

            const update = {
                init: function () {
                    this.variables();
                    this.addEventListeners();
                    this.validateForms();
                    this.datePicker();
                },
                variables: function () {
                    this.usernameForm = $('#usernameForm{{ $user->id }}');
                    this.sponsorIdForm = $('#sponsorIdForm{{ $user->id }}');
                    this.profileForm = $('#profileForm{{ $user->id }}');
                    this.passwordForm = $('#passwordForm{{ $user->id }}');
                    this.notesForm = $('#notesForm{{ $user->id }}');

                    this.usernameSave = $('.usernameSave');
                    this.sponsorIdSave = $('.sponsorIdSave');
                    this.profileSave = $('.profileSave');
                    this.passwordSave = $('.passwordSave');
                    this.notesSave = $('.notesSave');

                    this.date_of_birth = $('.date_of_birth');
                    this.date_of_passport_issuance = $('.date_of_passport_issuance');
                    this.date_of_passport_expiration = $('.date_of_passport_expiration');
                },
                addEventListeners: function () {
                    this.usernameForm.on('submit', function (event) {
                        if(this.validateForms())
                          return true;
                    }.bind(this))

                    this.sponsorIdForm.on('submit', function (event) {
                        if(this.validateForms())
                          return true;
                    }.bind(this))

                    this.profileForm.on('submit', function(event){
                        if(this.validateForms())
                          return true;
                    }.bind(this))

                    this.passwordForm.on('submit', function(event){
                        if(this.validateForms())
                          return true;
                    }.bind(this))
                    
                    this.usernameSave.on('click', function(event) {
                        this.usernameForm.submit();
                    }.bind(this))
                    
                    this.sponsorIdSave.on('click', function(event) {
                        this.sponsorIdForm.submit();
                    }.bind(this))

                    this.profileSave.on('click', function(event){
                        this.profileForm.submit();
                    }.bind(this))

                    this.passwordSave.on('click', function(event){
                        this.passwordForm.submit();
                    }.bind(this))

                    this.notesSave.on('click', function(event){
                        this.notesForm.submit();
                    }.bind(this))
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
                    this.usernameForm.validate({
                        errorClass: "has-error",
                        validClass: 'valid',
                        onkeyup: function (element) {
                            $(element).valid();
                        },
                        rules: {
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

                    this.sponsorIdForm.validate({
                        errorClass: "has-error",
                        validClass: 'valid',
                        onkeyup: function (element) {
                            $(element).valid();
                        },
                        rules: {
                            sponsor_customer_id: {
                              required: true,
                              minlength: 6,
                              maxlength: 6
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

                    this.profileForm.validate({
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
                                minlength: 7,
                                maxlength: 17
                            },
                            country_id: {
                                required: true
                            },
                            state: {
                                required: true,
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
                                minlength: 2,
                                maxlength: 10
                            },
                            email:{
                                required:true,
                                email:true
                            },
                            passport_id: {
                                required: true,
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

                    this.passwordForm.validate({
                        errorClass: "has-error",
                        validClass: 'valid',
                        onkeyup: function (element) {
                            $(element).valid();
                        },
                        rules: {
                            password: {
                                required: true,
                                minlength: 3,
                                maxlength: 50
                            },
                            password_confirmation: {
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
                    this.passwordForm.on('submit', function(event){
                        self.hideerror($('.password')[1]);
                        self.hideerror($('.password_confirmation')[1]);

                        if(!$('.password').val())
                        {
                            $('.password').focus();
                            self.adderror($('.password')[0],'This field is required');
                            return false;
                        }
                        else if($('.password').val() && !$('.password_confirmation').val())
                        {
                            $('.password_confirmation').focus();
                            self.adderror($('.password_confirmation')[0],"This field is required");
                            return false;
                        }
                        else if($('.password').val() && $('.password').val() != $('.password_confirmation').val())
                        {
                            $('.password_confirmation').focus();
                            self.adderror($('.password_confirmation')[0],"This field has to be equal to Re Type Password");
                            return false;
                        }
                        else if(!$('.password_confirmation').val() && $('.password').val())
                        {
                            $('.password_confirmation').focus();
                            self.adderror($('.password_confirmation')[0],'This field is required');
                            return false;
                        }
                        else if(!this.passwordForm.valid())
                        {
                            return false;
                        }

                    }.bind(this))

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
                    this.date_of_birth.datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        endDate: '-18y',
                        format: 'yyyy-mm-dd',
                        showOnFocus: true
                    }).on('hide', function () {
                        $('.date_of_birth').valid();
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
                        $('.date_of_passport_issuance').valid();
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
                        $('.date_of_passport_expiration').valid();
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
                url: url,
                method:"POST",
                data:$(this).serialize(),
                success:function(res){
                    console.log(res)
                    if (res.status) {
                        toastr['success']("You have updated successfully");
                    } else {
                        for(var item in res.message)
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
                update.init();
            });
        });

    </script>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
@endsection


@section('PAGE_END')
@endsection