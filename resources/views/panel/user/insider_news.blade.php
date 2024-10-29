@extends('panel._layouts.panel', ['ACTIVE_LIST' => 'insider_news'])

@section('meta.title',          __('pages/index.meta_title'))
@section('meta.description',    __('pages/index.meta_description'))
@section('meta.keywords',       __('pages/index.meta_keywords'))

@section('PAGE_LEVEL_STYLES')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}" >
    <style type="text/css">
      .trading-page-content {
          min-height: calc(100vh - 65px);
          padding-top: 50px;
          padding-bottom: 50px;
      }
      .mail_date {
        font-family: 'DIN Pro Condensed Regular' !important;
        font-size: 24px;
        color: #FFFFFF;
        text-align: justify;
        padding-left: 10px;
        padding-right: 30px;
    }
    </style>
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_END')
@endsection

@section('content')

<div class="bg-login-image">
    <div class="container trading-page-content" data-backgound="register-bg">
        <div class="col-lg-12 available_content" style="min-height:500px; justify-content: center; align-self: center; margin-top: 200px; text-align: center">
            <h2 class="text-center text-white">AVAILABLE SOON!</h2>
        </div>

        <div class="col-lg-12 text-center news_content">
          <div class="m-auto" style="width: 690px;">
            <h2 class="text-left text-white mail_date"></h2>
          </div>
          
          <div class="m-auto" style="width: 690px; height: 800px; overflow: auto;">
            <div class="other_mails">
              @include('panel._includes.insider_mail_header')
                <div class="preview-iframe"></div>
              @include('panel._includes.insider_mail_footer')
            </div>
            <div class="welcome_mail" style="display: none;">
              @include('panel._includes.insider_welcome_mail')
            </div>
          </div>
        </div>
        <div class="col-lg-12 text-center mt-3">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                
              </ul>
            </nav>
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
        var welcome_date = '{{$welcome_date}}';
        var html_array = '{{$details}}';
        html_array = html_array.split('&quot;').join('"');
        html_array = html_array.split('&lt;').join('<');
        html_array = html_array.split('&gt;').join('>');
        html_array = html_array.split('&#039;').join("'");
        html_array = JSON.parse(html_array);
        html_array.push('welcome');
        $(document).ready(function(){
          if(html_array.length) {
            $('.available_content').hide();
            paginations();
          } else {
            $('.news_content').hide();
          }
          $.ajax({
            type: 'POST',
            url: '{{ route('insider.read_news') }}',
            // data: {},
            success: function(data) {
                $('.notCount').html('0');
            },
            error: function(data){
                console.log(data);
            }
          })
        })

        function paginations(){
            var totoal_count = html_array.length;
            var items_per_page = 1;

            if(totoal_count > items_per_page){
              $('.pagination').show();
              var pagecount = Math.ceil(totoal_count / items_per_page);
              var html_pg = '<li class="page-item previouse-link disabled">';
              html_pg += '<a class="page-link" href="#">Previous</a>';
              html_pg += '</li>';
              html_pg += '<li class="page-item active page-index first-index" idxval="1"><a class="page-link" href="#">1</a></li>';
              for(var i = 2; i <= pagecount; i++){
                if(i == pagecount){
                  html_pg += '<li class="page-item page-index last-index" idxval="'+i+'"><a class="page-link" href="#">'+i+'</a></li>';
                }else{
                  html_pg += '<li class="page-item page-index" idxval="'+i+'"><a class="page-link" href="#">'+i+'</a></li>';
                }
              }
              html_pg += '<li class="page-item next-link">';
              html_pg += '<a class="page-link" href="#">Next</a>';
              html_pg += '</li>';
              $('.pagination').html(html_pg);

            }else{
              $('.pagination').hide();
            }

            confirm_link();

            $('.page-index').click(function(){
              $('.page-index').removeClass('active');
              $(this).addClass('active');
              confirm_link();
            });

            $('.next-link').click(function(){
              if(!$(this).hasClass('disabled')){
                var idxval = new Number($('.page-item.active').attr('idxval')) + 1;
                $('.page-index').removeClass('active');
                $('.page-index').each(function(){
                  if($(this).attr('idxval') == idxval){
                    $(this).addClass('active');
                  }
                });
              }
              confirm_link();
            });

            $('.previouse-link').click(function(){
              if(!$(this).hasClass('disabled')){
                var idxval = new Number($('.page-item.active').attr('idxval')) - 1;
                $('.page-index').removeClass('active');
                $('.page-index').each(function(){
                  if($(this).attr('idxval') == idxval){
                    $(this).addClass('active');
                  }
                });
              }
              confirm_link();
            });

            function confirm_link(){
              var idxval = (html_array.length==1)?html_array.length:$('.page-item.active').attr('idxval');
              if (html_array.length == 1 || html_array.length == idxval) {
                $('.other_mails').hide();
                $('.welcome_mail').show();
                // $('.mail_date').html(welcome_date);
                $('.mail_date').html('');
              } else {
                $('.other_mails').show();
                $('.welcome_mail').hide();
                $('.preview-iframe').html(html_array[idxval-1]['content']);
                $('.mail_date').html('Posted on ' + html_array[idxval-1]['date']);
              }
              if(!$('.first-index').hasClass('active') && !$('.last-index').hasClass('active')){
                $('.next-link').removeClass('disabled');
                $('.previouse-link').removeClass('disabled');
              }

              if($('.first-index').hasClass('active')){
                $('.next-link').removeClass('disabled');
                $('.previouse-link').addClass('disabled');
              }

              if($('.last-index').hasClass('active')){
                $('.previouse-link').removeClass('disabled');
                $('.next-link').addClass('disabled');
              }

              var index_show_pg_num = idxval - 1;
              if (index_show_pg_num < 9) {
                index_show_pg_num = 1;
              }

              $('.page-index').hide();
              for (var i = index_show_pg_num; i < index_show_pg_num + 9; i++) {
                $('.page-index').each(function(){
                  if($(this).attr('idxval') == i){
                    $(this).show();
                  }
                });        
              }
              $('.first-index').show();
              $('.last-index').show();

            }
          }
    </script>
@endsection
