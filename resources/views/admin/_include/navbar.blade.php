<div class="header d-flex align-items-center pr-4">
      <div class="logo">
        <a href="#">
          <img src="{{ asset('images/Image/EOSgreen.png') }}" style="height: 40px; width: auto;">
        </a>
      </div>
      <div class="toggle-btn-wrapper d-flex">
        <button class="btn bg-transparent shadow-none" type="button" id="sidebarCollapse">
          <i class="fa fa-navicon text-white" style="font-size: 22px;"></i>
        </button>
      </div>

      <div class="form-inline my-2 my-lg-0 ml-auto">
          <!-- <div class="customSelectCurrency btn-group">
              <a class="btn dropdown-toggle rounded-0" data-toggle="dropdown" href="javascript:" style="display: block; color: #ffffff; background-color: #686d72; padding: 3px 15px;">
                  <span>€</span>
                  EUR
              <ul class="dropdown-menu rounded-0">
                  <li class="dropdown-item">
                      <a href="javascript:"><span>€</span> EUR</a>
                  </li>
                  <li class="dropdown-item">
                      <a href="javascript:"><span>֏</span> AMD</a>
                  </li>
                  <li class="dropdown-item">
                      <a href="javascript:"><span>₽</span> RUB</a>
                  </li>
              </ul>
          </div>

          <div class="customSelect btn-group ml-2">
              <a class="btn dropdown-toggle rounded-0" data-toggle="dropdown" href="javascript:" style="display: block; color: #ffffff; background-color: #686d72; padding: 3px 15px;">
                  <img src="Image/flags_iso/24/gb.png"/>
                  ENGLISH
              <ul class="dropdown-menu rounded-0">
                  <li class="dropdown-item">
                      <a href="javascript:"><img src="{{ asset('images/Image/flags_iso/24/gb.png') }}"/> ENGLISH</a>
                  </li>
                  <li class="dropdown-item">
                      <a href="javascript:"><img src="{{ asset('images/Image/flags_iso/24/am.png') }}"/> ARMENIA</a>
                  </li>
                  <li class="dropdown-item">
                      <a href="javascript:"><img src="{{ asset('images/Image/flags_iso/24/ru.png') }}"/> RUSSIA</a>
                  </li>
              </ul>
          </div> -->

          <div class="headerNotificationsBox">
              <div class="notItemBox">
                  <i class="fa fa-bell"></i>
                  <span class="notCount">0</span>
              </div>
              <div class="notItemBox">
                  <i class="fa fa-envelope-open"></i>
                  <span class="notCount">0</span>
              </div>
          </div>
          <ul class="navbar-nav mr-auto">
              <li class="nav-item cursor-pointer">
                  <div class="dropdown">
                      <div class="nav-link" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img class="img-fluid img-avatar mr-2" src="{{ asset('images/Image/member_m.png') }}">
                          <span class="mr-2 text-white">admin</span>
                      </div>
                      <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownMenuUser">
                          <!-- <a class="dropdown-item" href="{{ route('my_profile') }}">
                              <span>My profile</span>
                          </a> -->
                          <!-- <div class="dropdown-divider"></div> -->
                          <a class="dropdown-item" href="{{ route('auth::logout') }}">
                              <span>Sign Out</span>
                          </a>
                      </div>
                  </div>
              </li>
          </ul>
      </div>
    </div>