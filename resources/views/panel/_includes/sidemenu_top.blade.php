<?php $ACTIVE_TAB = Request::path() ?>
@if (isset($ACTIVE_LIST) && $ACTIVE_LIST === 'home')
<div class="row left-up-menu" style="margin-right: 0px; margin-left: 0px;">
    <div class="col">
        <div class="infoGrid">
            <h3>Client ID</h3>
            <h5>{{$userDetails->client_id}}</h5>
        </div>
    </div>
    <div class="col">
        <div class="infoGrid">
            <h3>Name</h3>
            <h5>{{$userDetails->first_name}} {{$userDetails->last_name}}</h5>
        </div>
    </div>
    <div class="col">
        <a href="{{ route('home') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'home' ? 'bg-green' : '' }}">
                <h3>ALPHA LINEA</h3>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('pinnacle') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'pinnacle' ? 'bg-green' : '' }}">
                <h3>PINNACLE PORTFOLIO</h3>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('aurum') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'aurum' ? 'bg-green' : '' }}">
                <h3>AURUM DIGITAL</h3>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('satoshi') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'satoshi' ? 'bg-yellow-active' : 'bg-yellow-inactive' }}">
                <h3>Satoshi Strategies</h3>
            </div>
        </a>
    </div>
    
    <div class="col">
        <div class="infoGrid bg-green">
            <h3>TOTAL ROI</h3>
            <h2><span class="euro-sign">€</span><span class="amounts">{{$total_roi}}</span></h2>
        </div>
    </div>
</div>
@endif
@if (isset($ACTIVE_LIST) && $ACTIVE_LIST === 'insider')
<div class="row left-up-menu" style="margin-right: 0px; margin-left: 0px; border-top: 1px solid #DDD;">
    <div class="col">
        <div class="text-center">
            <img src="{{asset('images/NewInsider.png')}}" style="width: 250px; padding: 10px 25px;"/>
        </div>
    </div>
    <div class="col" style="border: solid 1px #DDD;">
        <a href="{{ route('insider') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider' ? 'bg-green' : '' }}">
                <h3>QUANT EA INDICATORS</h3>
            </div>
        </a>
    </div>
    <div class="col" style="border: solid 1px #DDD;">
        <a href="{{ route('insider.tradingview') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider/tradingview' ? 'bg-green' : '' }}">
                <h3>LIVE INDICATOR CHARTS</h3>
            </div>
        </a>
    </div>
    <div class="col" style="border: solid 1px #DDD;">
        <a href="{{ route('insider.news') }}">
            <div class="infoGrid {{ isset($ACTIVE_TAB) && $ACTIVE_TAB === 'insider/news' ? 'bg-green' : '' }}">
                <h3>OPINION UPDATES</h3>
            </div>
        </a>
    </div>
</div>
@endif