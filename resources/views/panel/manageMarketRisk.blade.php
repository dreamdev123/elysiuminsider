@extends('panel._layouts.panel', ['ACTIVE_LIST' => 'marketEntryRisk'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}" >
    <style type="text/css">
        .entry-risk-page-content {
            min-height: calc(100vh - 65px);
            padding-top: 20px;
            padding-bottom: 50px;
        }
        .side-content {
            background-color: #282f37;
            border-left: 2px solid #DDDDDD;
        }
        .risk_top_title {
            font-family: 'DIN Pro Condensed Bold' !important;
            color: #fff;
            font-size: 28px;
            margin-top: 50px;
            padding-bottom: 20px;
        }
        .risk_context {
            font-family: 'Din Pro Condensed Regular' !important;
            font-size: 20px;
            color: #fff;
        }
        .market_logo {
            width: 30px;
            height: 30px;
            margin-right: 20px;
        }
        .project_section {
            align-items: center;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .price_section {
            align-items: center;
            justify-content: center;
            border-right: 1px solid #fff;
            border-left: 1px solid #fff;
            padding: 5px 20px;
        }
        .entry_risk_section {
            align-items: center;
            justify-content: center;
            padding: 5px 20px;
        }
        .priceLabel {
            color: #fff;
            font-size: 16px;
            padding-right: 10px;
            margin: 0;
        }
        .percentLabel {
            color: #fff;
            font-size: 16px;
            padding-left: 10px;
            margin: 0;
        }

        .button-submit {
            width: 160px;
            font-family: 'Din Pro Condensed Regular';
            font-size: 20px;
            padding: .7rem 1rem;
            color: #a6a8ab !important;
            background-color: #41464d !important;
            border-color: #41464d !important;
            text-transform: uppercase;
            border: none;
            border-radius: 0;
        }

        .button-submit:hover {
            color: #fff !important;
            background-color: #00aeaa !important;
            border-color: #00aeaa !important;
        }
    </style>
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection

@section('content')

<div class="bg-login-image">
    <div class="container entry-risk-page-content" data-backgound="register-bg">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 col-md-6 col-sm-5">
                <h2 class="risk_top_title text-center">PROJECT</h2>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4">
                <h2 class="risk_top_title text-center">PRICE</h2>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h2 class="risk_top_title text-center">PERCENT</h2>
            </div>
        </div>
        @if(isset($risks) && count($risks) > 0)
            @foreach($risks as $key => $risk)
                <div class="row risk_section">
                    <div class="col-lg-5 offset-lg-1 col-md-6 col-sm-5 d-flex project_section">
                        <img src="{{asset('images/IconCrypto')}}/{{$risk['code']}}.svg" class="market_logo">
                        <span class="risk_context" style="flex: 1;">{{$risk['name']}}</span>
                        <span class="risk_context" style="flex: 0.5;">({{$risk['code']}})</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 d-flex price_section">
                        <label class="priceLabel">$ </label>
                        <input type="text" class="form-control unitPrice" placeholder="{{$risk['code']}} unit price" name="{{$risk['code']}}_unit_price" data-code="{{$risk['code']}}" value="{{$risk['price']}}">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 d-flex entry_risk_section">
                        <input type="text" class="form-control riskPercent" placeholder="{{$risk['code']}} Risk percent" name="{{$risk['code']}}_risk_percent" data-code="{{$risk['code']}}" value="{{$risk['percent']}}">
                        <label class="percentLabel">% </label>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-lg-12 d-flex mt-3" style="justify-content: flex-end;">
                <button class="btn button-submit">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.button-submit', function() {
        var send_data = {};

        send_data['crypto_risks'] = [];

        $(document).find('.risk_section').each(function(){
          var risk_group = {};
          $(this).find('.unitPrice').each(function(){
            risk_group['price'] = $(this).val();
            risk_group['code'] = $(this).data("code");
          })
          $(this).find('.riskPercent').each(function(){
            risk_group['percent'] = $(this).val();
          })

          send_data['crypto_risks'].push(risk_group);
        });

        $.ajax({
          type: 'POST',
          url: '{{route('market.update')}}',
          data: send_data,
          success:function(data){
              toastr['success']("You have updated successfully");
          },
          error:function(err){
              toastr['error']("Failed!");
          }
        });
    })
</script>
@endsection
