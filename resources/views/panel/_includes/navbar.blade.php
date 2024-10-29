<?php
use App\InsiderNews;
$news = InsiderNews::where('user_id', $user->client_id)->where('status', 0)->get();
?>
<nav class="navbar navbar-top fixed-top navbar-expand-lg pl-lg-4 pr-lg-5">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/NewEOSgreen.png') }}" height="37" width="auto"
             class="d-inline-block align-top" alt="Elysium Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="slideBar">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="navbar-brand ml-5">
        <img src="{{ asset('images/InsiderLogoW.svg') }}" height="37" width="auto"
             class="d-inline-block align-top" alt="Insider Logo">
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>

        <div class="form-inline my-2 my-lg-0">

            <div class="customSelect btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:">
                    
                    ENGLISH
                    <span class="caret"><i class="fas fa-angle-down"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a href="javascript:">ENGLISH</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="javascript:">ARMENIA</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="javascript:">RUSSIA</a>
                    </li>
                </ul>
            </div>

            <div class="headerNotificationsBox">
                <div class="notItemBox goToNews">
                    <i class="fas fa-bell"></i>
                    <span class="notCount">{{count($news) ?? '0'}}</span>
                </div>
                <!-- <div class="notItemBox">
                    <i class="fas fa-envelope-open"></i>
                    <span class="notCount">0</span>
                </div> -->
            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item cursor-pointer">
                    <div class="dropdown">
                        <div class="nav-link" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-fluid img-avatar mr-2" src="{{ asset('images/member_m.png') }}">
                            <span class="mr-2">{{$user->first_name}}</span><i class="fal fa-chevron-down"></i>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuUser">
                            <a class="dropdown-item" href="{{ route('my_profile') }}">
                                <span>My profile</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('auth::logout') }}">
                                <span>Sign Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    $('.goToNews').click(function() {
        window.location.href = '{{ route('insider.news') }}';
    })
</script>