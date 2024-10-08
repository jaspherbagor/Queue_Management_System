@extends('layouts.display')
@section('title', 'Dislay 3B')

@section('content')
<div class="panel panel-primary">

    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12">
                <h3>{{ trans('app.display_3') }} <button class="pull-right btn btn-sm btn-primary" onclick="goFullscreen('fullscreen'); return false"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button></h3>
                <span class="text-danger">(enable full-screen mode and wait 10 seconds to adjust the screen)</span>
            </div> 
        </div>
    </div> 

    <div class="panel-body" id="fullscreen">
    
      <div class="media row" style="height:60px;background:#3498db;margin-top:-20px;margin-bottom:20px">
        <div class="media-left hidden-xs">
          <img class="media-object" style="height:59px;" src="{{ asset('public/assets/images/pclu_banner.svg') }}" alt="Logo">
        </div>
        <div class="media-body" style="color:#ffffff">
          <h4 class="media-heading" style="font-size:40px;line-height:60px"><marquee direction="{{ (!empty($setting->direction)?$setting->direction:null) }}">{{ (!empty($setting->message)?$setting->message:null) }}</marquee></h4> 
        </div>
      </div>

        <div class="row">  
          <div id="display3b"></div>
        </div>


        <div class="panel-footer row" style="margin-top:10px">
          @include('backend.common.info')
          <span class="col-xs-10 text-left">@yield('info.powered-by')</span>
          <span class="col-xs-2 text-right">@yield('info.version')</span>
        </div>
    </div>  
</div>  
@endsection

@push('scripts')
<script type="text/javascript">  
  $(document).ready(function(){
    // Get previous token
    var view_token = [];
    var interval = 10000; 

    var display = function() {
        var width  = $(window).width();
        var height = $(window).height();
        var isFullScreen = document.fullScreen ||
            document.mozFullScreen ||
            document.webkitIsFullScreen || 
            (document.msFullscreenElement != null);
        
        if (isFullScreen) {
            width  = $(window).width();
            height = $(window).height();
        }

        $.ajax({
            type:'post',
            dataType:'json',
            url:'{{ URL::to("common/display3") }}',
            data: {
                _token: '<?php echo csrf_token() ?>',
                view_token: view_token,
                width: width,
                height: height
            },
            success:function(data) {
                // Refresh only the div with the queue-box class
                $(".queue-box").html(data.result);

                view_token = (data.all_token).map(function(item) {
                    return { counter: item.counter, token: item.token };
                });

                // Notification sound
                if (data.status) {  
                    var url  = "{{ URL::to('') }}"; 
                    var lang = "{{ in_array(session()->get('locale'), $setting->languages) ? session()->get('locale') : 'en' }}";
                    var player = new Notification;
                    player.call(data.new_token, lang, url);
                }

                setTimeout(display, data.interval);
            }
        });
    };

    setTimeout(display, interval);
  
      // Video handling
      var $video = $('#display1Video');
  
      // Function to set the video time from localStorage
      function setVideoTime() {
          var savedTime = localStorage.getItem('videoTime');
          if (savedTime) {
              // Ensure the video metadata is loaded before setting the currentTime
              $video.on('loadedmetadata', function() {
                  $video[0].currentTime = savedTime;
              });
          }
      }
  
      // Set the video time when the page loads
      setVideoTime();
  
      // Save the current video time before the page unloads
      $(window).on('beforeunload', function() {
          var currentTime = $video[0].currentTime;
          localStorage.setItem('videoTime', currentTime);
      });
  });
  </script>
@endpush

