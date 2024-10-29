<?php
// use GeoIP;

use Torann\GeoIP\Facades\GeoIP;
?>

<div class="side-menu navbar navbar-expand-lg navbar-light d-lg-block slideNav" id="slideNav">

    <div class="search_sidebar_box">
        <i class="fas fa-search"></i>
        <input type="text" name="search" placeholder="SEARCH"/>
    </div>
    <button class="navbar-toggler fas fa-angle-down mr-2" type="button" data-toggle="collapse" data-target="#navbarSide"
            aria-controls="navbarSide" aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <?php $ACTIVE_TAB = Request::path() ?>
    <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSide">
        <ul class="nav flex-column w-100">
            <li class="nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'home' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home mr-2"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'my_profile' ? 'active' : '' }}">
                <a href="{{ route('my_profile') }}" class="nav-link cursor-pointer w-100 m-0"
                   data-side-menu="title">
                    <i class="fas fa-user mr-2"></i>
                    <span>My profile</span>
                </a>
            </li>
            <li class="nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'dailyPriceChart' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dailyPriceChart') }}">
                    <i class="fas fa-share-alt mr-2"></i>
                    <span>Daily Price Chart</span>
                </a>
            </li>
            <li class="nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider/news' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('insider.news') }}">
                    <i class="fas fa-bell mr-2"></i>
                    <span>OPINION UPDATES</span>
                </a>
            </li>
            <li class="nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'marketEntryRisk' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('marketEntryRisk') }}">
                    <i class="fas fa-thumbs-up mr-2"></i>
                    <span>MARKET ENTRY RISK</span>
                </a>
            </li>
            @if ($user->customer_id == 888888 || $user->customer_id == 526792)
            <li class="nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'manageMarketRisks' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('market.manage') }}">
                    <i class="fas fa-thumbs-up mr-2"></i>
                    <span>MARKET ENTRY ADMIN</span>
                </a>
            </li>
            @endif
            <li class="nav-item btc-nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider/tradingview1' ? 'active' : '' }}">
                <a class="nav-link cursor-pointer w-100 m-0" href="{{ route('insider.tradingview1') }}">
                    <div class="btc-logo mr-2"></div>
                    <span>LIVE BTC INDICATORS</span>
                </a>
            </li>
            <li class="nav-item eth-nav-item w-100 {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider/tradingview2' ? 'active' : '' }}">
                <a class="nav-link cursor-pointer w-100 m-0" href="{{ route('insider.tradingview2') }}">
                    <div class="eth-logo mr-2"></div>
                    <span>LIVE ETH INDICATORS</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="container-fluid slideBarClockBox">
        <div class="row">
            <div class="col-12 col-sm-6">
                <img id="Layer_1_ClockDay" src="{{asset('images/ClockDay.png')}}" width="100" height="100" style="display: none;" />
                <canvas id="canvas-clock" width="100" height="100"></canvas>
                <span class="timeText">LOCAL TIME</span>
            </div>
            <div class="col-12 col-sm-6">
                <img id="Layer_1_ClockNight" src="{{asset('images/ClockNight.png')}}" width="100" height="100" style="display: none;" />
                <canvas id="canvas-clock-server" width="100" height="100"></canvas>
                <span class="timeText">SERVER TIME</span>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="alter-UK">
    <div class="modal-dialog modal-dialog-centered" style="width: 650px;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>    
        <div class="modal-body">
            Please contact support as this is not available in your region.
        </div>
          <div class="modal-footer">          
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div> 

<div class="modal" id="alter-unInsider">
    <div class="modal-dialog modal-dialog-centered" style="width: 650px;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>    
        <div class="modal-body">
            You don't have this permission. Please subscribe the Insider membership in <a href="https://office.elysiumnetwork.io" target="_blank">here</a>.
        </div>
          <div class="modal-footer">          
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div> 

<script>

    var local_time = moment("<?=date('l, d-M-Y H:i:s e',$shareTime['localTimeStamp'])?>");
    var server_time = moment("<?=date('l, d-M-Y H:i:s e',$shareTime['serverTimeStamp'])?>");



    var canvas_clock = document.getElementById("canvas-clock");
    var ctx_clock = canvas_clock.getContext("2d");
    var radius_clock = canvas_clock.height / 2;
        ctx_clock.translate(radius_clock, radius_clock);
        radius_clock = radius_clock * 0.90;

    setInterval( function(){
        local_time = moment(local_time).tz("<?=$shareTime['localTimeZone']?>").add(1,'seconds');
        drawClock(ctx_clock, radius_clock,local_time);
    }, 1000);


    var canvas_clock_server = document.getElementById("canvas-clock-server");
    var ctx_clock_server = canvas_clock_server.getContext("2d");
    var radius_clock_server = canvas_clock_server.height / 2;
    ctx_clock_server.translate(radius_clock_server, radius_clock_server);
    radius_clock_server = radius_clock_server * 0.90;
    setInterval( function(){
        server_time = moment(server_time).tz("<?=$shareTime['serverTimeZone']?>").add(1,'seconds');
        drawClock1(ctx_clock_server, radius_clock_server, server_time);
    }, 1000);


    function drawClock(ctx, radius,time) {
        drawFace(ctx, radius);
        drawTime(ctx, radius,time);
    }

    function drawFace(ctx, radius) {

        var img = document.getElementById("Layer_1_ClockDay");
        ctx.clearRect(0, 0, 100, 100);
        ctx.drawImage(img, -50, -50, 100, 100);
    }

    function drawTime(ctx, radius, time){
        var now =moment(time);
        var hour = now.format('hh');
        var  minute= now.format('mm');
        var second = now.format('ss');

        hour=hour%12;
        hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
        drawHand(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.strokeStyle = '#293142';
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }


    function drawClock1(ctx, radius,time) {
        drawFace1(ctx, radius);
        drawTime1(ctx, radius,time);
    }

    function drawFace1(ctx, radius) {
        var img = document.getElementById("Layer_1_ClockNight");
        ctx.drawImage(img, -50, -50, 100, 100);
    }

    function drawTime1(ctx, radius, time){
        var now =moment(time);
        var hour = now.format('hh');
        var  minute= now.format('mm');
        var second = now.format('ss');

        hour=hour%12;
        hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
        drawHand1(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand1(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand1(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand1(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.strokeStyle = '#828EA6';
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }

</script>
<script type="text/javascript">
    $('.alter-UK').click(function() {
        $('#alter-UK').modal('show');
    })
    $('.alter-unInsider').click(function() {
        $('#alter-unInsider').modal('show');
    })
</script>