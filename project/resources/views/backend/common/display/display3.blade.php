@extends('layouts.display')
@section('title', 'Display 1')

@section('content')
<div class="panel panel-primary">

    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12">
                <h3>DISPLAY 1 <button class="pull-right btn btn-sm btn-primary" onclick="goFullscreen('fullscreen'); return false"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button></h3>
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
          <div id="display3"></div>
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
    var view_token = [];
    var interval = 1000; 

    var display = function() {
        var width  = $(window).width();
        var height = $(window).height();
        var isFullScreen = document.fullScreen ||
            document.mozFullScreen ||
            document.webkitIsFullScreen || (document.msFullscreenElement != null);
        if (isFullScreen) {
            width  = $(window).width();
            height = $(window).height();
        } 

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{ URL::to("common/display3") }}',
            data: {
                _token: '<?php echo csrf_token() ?>',
                view_token: view_token,
                width: width,
                height: height
            },
            success: function(data) {
                $("#display3").html(data.result); 

                view_token = (data.all_token).map(function(item) {
                    return { counter: item.counter, token: item.token }; 
                }); 

                if (data.status) {  
                    var newTokens = data.new_token.map(function(item) {
                        return "Token number " + item.token + " please proceed to window " + item.counter;
                    }).join('. ');

                    // Announce the tokens via Text-to-Speech
                    speakText(newTokens);

                    setTimeout(display, data.interval);
                }
            }
        });
    };

    setTimeout(display, interval);

    // TTS function using Web Speech API
    function speakText(text) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'en-US'; // Set the language, customize if needed
            utterance.pitch = 1;      // Set pitch level (0-2)
            utterance.rate = 1;       // Set speed of speech (0.1-10)
            window.speechSynthesis.speak(utterance);
        } else {
            console.log('Sorry, your browser does not support text-to-speech.');
        }
    }

});
</script>
@endpush

