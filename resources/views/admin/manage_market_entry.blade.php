@extends('admin._layout.admin')


@section('PAGE_LEVEL_STYLES')
<style type="text/css">
    .dataTables_filter input {
        border:1px #aaa solid;
        padding:5px 7px;
        outline: none;
    }

    .dataTables_wrapper {
      width:100%;
      padding-left: 50px;
      padding-right: 50px;
    }
    .risk_top_title {
        font-family: 'DIN Pro Condensed Bold' !important;
        color: #212529;
        font-size: 28px;
        margin-top: 50px;
        padding-bottom: 20px;
    }
    .risk_context {
        font-family: 'Din Pro Condensed Regular' !important;
        font-size: 20px;
        color: #212529;
    }
    .market_logo {
        width: 30px;
        height: 30px;
        margin-right: 20px;
    }
    .green_face {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }
    .red_face {
        width: 30px;
        height: 30px;
        margin-left: 10px;
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
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .entry_risk_section {
        align-items: center;
        justify-content: center;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .priceLabel {
        font-size: 14px;
        padding-right: 10px;
        margin: 0;
    }
    .percentLabel {
        font-size: 14px;
        padding-left: 10px;
        margin: 0;
    }
</style>
@endsection


@section('PAGE_START')
@endsection


@section('content')
<!-- Content -->
    <div id="content" style="background-color: #e3e3e3; padding-bottom: 20px;">
        <div class="container">
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
                    <div class="row">
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


    $(document).on('keyup', '.unitPrice', function() {
        var price = $(this).val();
        var code = $(this).data("code");
        if (!price) {
            toastr['error']("Please enter the value");
            return;
        } else if (isNaN(price)) {
            toastr['error']("Please enter the number");
            return;
        } else if (price < 0) {
            toastr['error']("Please enter the price value correctly");
            return;
        } else {
            $.ajax({
              type: 'POST',
              url: '{{route('admin.market.update')}}',
              data: { code: code, prefix: "price", price: price },
              success:function(data){
                  toastr['success']("You have updated successfully");
              },
              error:function(err){
                  toastr['error'](err.responseJSON.error);
              }
          });
        }
    })

    $(document).on('keyup','.riskPercent',function(e){
        var percent = $(this).val();
        var code = $(this).data("code");
        if (!percent) {
            toastr['error']("Please enter the value");
            return;
        } else if (isNaN(percent)) {
            toastr['error']("Please enter the number");
            return;
        } else if (percent > 100 || percent < 0) {
            toastr['error']("Please enter the percent value correctly");
            return;
        } else {
            $.ajax({
              type: 'POST',
              url: '{{route('admin.market.update')}}',
              data: { code: code, prefix: "percent", percent: percent },
              success:function(data){
                  toastr['success']("You have updated successfully");
              },
              error:function(err){
                  toastr['error'](err.responseJSON.error);
              }
          });
        }
    })
</script>
@endsection


@section('PAGE_END')
@endsection