<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ \Session::get('app.title') }} :: @yield('title')</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset(Session::get('app.favicon')) }}" type="image/x-icon" />

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- template bootstrap -->
        <link href="{{ asset('public/assets/css/template.min.css') }}" rel='stylesheet prefetch'>
        <!-- roboto -->
        <link href="{{ asset('public/assets/css/roboto.css') }}" rel='stylesheet'>
        <!-- material-design -->
        <link href="{{ asset('public/assets/css/material-design.css') }}" rel='stylesheet'>
        <!-- small-n-flat -->
        <link href="{{ asset('public/assets/css/small-n-flat.css') }}" rel='stylesheet'>
        <!-- font-awesome -->
        <link href="{{ asset('public/assets/css/font-awesome.min.css') }}" rel='stylesheet'>
        <!-- jquery-ui -->
        <link href="{{ asset('public/assets/css/jquery-ui.min.css') }}" rel='stylesheet'>
        <!-- datatable -->
        {{-- <link href="{{ asset('public/assets/css/dataTables.min.css') }}" rel='stylesheet'> --}}
        <link href="{{ asset('public/assets/css/datatables_css.min.css') }}" rel='stylesheet'>
        <!-- select2 -->
        <link href="{{ asset('public/assets/css/select2.min.css') }}"  rel='stylesheet'>
        <!-- custom style -->
        <link href="{{ asset('public/assets/css/style.css') }}" rel='stylesheet'>
        <!-- bootstrap cdn -->
        <!-- <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}"> -->
        <!-- Admin Dashboard Styles -->
        <link rel="stylesheet" href="{{asset('public/assets/css/admin_dashboard.css')}}">
        {{-- Forms Styles --}}
        <link rel="stylesheet" href="{{ asset('public/assets/css/forms_styles.css') }}">
        <!-- Page styles -->
        @stack('styles')

        <!-- Autoken Stylesheet -->
        <link rel="stylesheet" href="{{asset('public/assets/css/auto_token_styles.css')}}">
        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">

        <!-- Jquery  -->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        {{-- Datatables Script --}}
        <script src="{{ asset('public/assets/js/datatables.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class="cm-no-transition cm-1-navbar loader-process">
        @include('backend.common.info')

        {{-- <div class="loader">
            <div>
                <span>P</span>
                <span>C</span>
                <span>L</span>
                <span>U</span>
                <span></span>
                <span>Q</span>
                <span>U</span>
                <span>E</span>
                <span>U</span>
                <span>E</span>
                <span></span>
            </div>
        </div> --}}

        <!-- Starts of Sidebar -->
        <div id="cm-menu">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="cm-flex">
                    <a href="javascript:void(0)" class="cm-logo">
                        <img src="{{ asset('public/assets/images/pclu_banner.svg') }}" width="212" height="50">
                    </a>
                </div>
                <div class="btn btn-primary md-menu-white" data-toggle="cm-menu"></div>
            </nav>
            <div id="cm-menu-content">
                <div id="cm-menu-items-wrapper">
                    <div id="cm-menu-scroller">
                        <ul class="cm-menu-items">
                            {{-- <li class="">
                                <div>
                                    <img src="{{ !empty(Auth::user()->photo)?asset(Auth::user()->photo):asset('public/assets/img/icons/no_user.jpg') }}" width="140" height="105">
                                </div>
                                <a href="{{ url('admin') }}" class="sf-dashboard">
                                    {{ Auth::user()->firstname .' '. Auth::user()->lastname }}
                                </a>
                            </li> --}}
                            <!-- // ADMIN MENU -->
                            @if(Auth::user()->hasRole('admin'))
                            <li class="{{ ((Request::is('admin')) ? 'active' : '') }}">
                                <a href="{{ url('admin') }}" class="sf-dashboard">
                                    {{ trans('app.dashboard') }}
                                </a>
                            </li>

                            <li class="cm-submenu {{ (Request::segment(2)=='department' ? 'open' : '') }}">
                                <a class="sf-building">
                                    Services <span class="caret"></span>
                                </a>
                                <ul>
                                    <li class="{{ (Request::is('admin/department/create') ? 'active' : '') }}">
                                        <a href="{{ url('admin/department/create') }}"><i class="bi bi-chevron-right"></i> Add Services</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/department') ? 'active' : '') }}">
                                        <a href="{{ url('admin/department') }}"><i class="bi bi-chevron-right"></i> Services List</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="cm-submenu {{ (Request::segment(2)=='counter' ? 'open' : '') }}">
                                <a class="sf-star">Window <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('admin/counter/create') ? 'active' : '') }}">
                                        <a href="{{ url('admin/counter/create') }}"><i class="bi bi-chevron-right"></i> Add Window</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/counter') ? 'active' : '') }}">
                                        <a href="{{ url('admin/counter') }}"><i class="bi bi-chevron-right"></i> Windows List</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="cm-submenu {{ (Request::segment(2)=='user' ? 'open' : '') }}">
                                <a class="sf-profile-group">{{ trans('app.users') }} <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('admin/user/create') ? 'active' : '') }}">
                                        <a href="{{ url('admin/user/create') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.add_user') }}</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/user') ? 'active' : '') }}">
                                        <a href="{{ url('admin/user') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.user_list') }}</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- <li class="cm-submenu {{ (Request::segment(2)=='sms' ? 'open' : '') }}">
                                <a class="sf-bubbles">{{ trans('app.sms') }} <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('admin/sms/new') ? 'active' : '') }}">
                                        <a href="{{ url('admin/sms/new') }}">{{ trans('app.new_sms') }}</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/sms/list') ? 'active' : '') }}">
                                        <a href="{{ url('admin/sms/list') }}">{{ trans('app.sms_history') }}</a>
                                    </li>
                                    <li class="bg-danger {{ (Request::is('admin/sms/setting') ? 'active' : '') }}">
                                        <a href="{{ url('admin/sms/setting') }}">{{ trans('app.sms_setting') }}</a>
                                    </li>
                                </ul>
                            </li> -->

                            <li class="cm-submenu {{ (Request::segment(2)=='token' ? 'open' : '') }}">
                                <a class="sf-user-id">Numbers <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('admin/token/list') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/auto') }}"><i class="bi bi-chevron-right"></i> Create Number</a>
                                    </li>
                                    {{-- <li class="{{ (Request::is('admin/token/create') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/create') }}">{{ trans('app.manual_token') }}</a>
                                    </li> --}}
                                    <li class="{{ (Request::is('admin/token/current') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/current') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.active') }} / Current Numbers <i class="fa fa-dot-circle-o" style="color:#03d003"></i></a>
                                    </li>
                                    <li class="{{ (Request::is('admin/token/report') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/report') }}"><i class="bi bi-chevron-right"></i> Number Report</a>
                                    </li>
                                    <!-- <li class="{{ (Request::is('admin/token/performance') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/performance') }}">{{ trans('app.performance_report') }}</a>
                                    </li> -->
                                    <li class="bg-danger {{ (Request::is('admin/token/setting') ? 'active' : '') }}">
                                        <a href="{{ url('admin/token/setting') }}"><i class="bi bi-chevron-right"></i> Number Setting</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <!-------------------------------------------------------->
                            <!-- OFFICER MENU                                       -->
                            <!-------------------------------------------------------->
                            @if(Auth::user()->hasRole('officer'))
                            <li class="{{ ((Request::is('officer')) ? 'active' : '') }}">
                                <a href="{{ url('officer') }}" class="sf-dashboard">
                                    {{ trans('app.dashboard') }}
                                </a>
                            </li>


                            <li class="cm-submenu {{ (Request::segment(2)=='token' ? 'open' : '') }}">
                                <a class="sf-user-id">Numbers <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('officer/token/current') ? 'active' : '') }}">
                                        <a href="{{ url('officer/token/current') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.active') }} / Current Numbers <i class="fa fa-dot-circle-o" style="color:#03d003"></i></a>
                                    </li>
                                    <li class="{{ (Request::is('officer/token') ? 'active' : '') }}">
                                        <a href="{{ url('officer/token') }}"><i class="bi bi-chevron-right"></i> Number List</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <!-------------------------------------------------------->
                            <!-- RECEPTIONIST MENU                               -->
                            <!-------------------------------------------------------->
                            @if(Auth::user()->hasRole('receptionist'))
                            <li class="cm-submenu {{ ((Request::is('receptionist') || Request::segment(2)=='token') ? 'open' : '') }}">
                                <a class="sf-user-id">Queue <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('receptionist/token/list') ? 'active' : '') }}">
                                        <a href="{{ url('receptionist/token/auto') }}"><i class="bi bi-chevron-right"></i> Create Queue </a>
                                    </li>
                                    <!-- <li class="{{ (Request::is('receptionist/token/create') ? 'active' : '') }}">
                                        <a href="{{ url('receptionist/token/create') }}">{{ trans('app.manual_token') }}</a>
                                    </li> -->
                                    <!-- <li class="{{ (Request::is('receptionist/token/current') ? 'active' : '') }}">
                                        <a href="{{ url('receptionist/token/current') }}">{{ trans('app.active') }} / Current Queue <i class="fa fa-dot-circle-o" style="color:#03d003"></i></a>
                                    </li> -->
                                </ul>
                            </li>
                            @endif


                            <!-------------------------------------------------------->
                            <!-- COMMON MENU                                        -->
                            <!-------------------------------------------------------->
                            @if(!Auth::user()->hasRole('receptionist'))
                            <li class="cm-submenu {{ (Request::segment(2)=='display' ? 'open' : '') }}">
                                <a target="_blank" class="sf-device-tablet">
                                    {{ trans('app.display') }}
                                    <span class="caret"></span>
                                </a>
                                <ul>
                                    <!-- <li class="{{ (session()->get('app.display')==1 ? 'active' : '') }}">
                                        <a href="{{ url('common/display?type=1') }}" target="_blank">{{ trans('app.display_1') }}</a>
                                    </li> -->
                                    {{-- <li class="{{ (session()->get('app.display')==2 ? 'active' : '') }}">
                                        <a href="{{ url('common/display?type=2') }}" target="_blank">{{ trans('app.display_2') }}</a>
                                    </li>                                     --}}
                                    <li class="{{ (session()->get('app.display')==3 ? 'active' : '') }}">
                                        <a href="{{ url('common/display?type=3') }}" target="_blank"><i class="bi bi-chevron-right"></i> Display 1</a>
                                    </li>
                                    {{-- <li class="{{ (session()->get('app.display')=='3b' ? 'active' : '') }}">
                                        <a href="{{ route('display3b') }}" target="_blank">Display 3b</a>
                                    </li> --}}
                                    {{-- <li class="{{ (session()->get('app.display')==4 ? 'active' : '') }}">
                                        <a href="{{ url('common/display?type=4') }}" target="_blank">{{ trans('app.display_4') }}</a>
                                    </li>                                      --}}
                                    <li class="{{ (session()->get('app.display')==5 ? 'active' : '') }}">
                                        <a href="{{ url('common/display?type=5') }}" target="_blank"><i class="bi bi-chevron-right"></i> Display 2</a>
                                    </li>
                                    <!-- @if (session()->has('custom_displays'))
                                    @foreach(session()->get('custom_displays') as $key => $name)
                                    <li>
                                        <a href="{{ url('common/display?type=6&custom='.$key) }}" target="_blank">{{ trans('app.custom_display') }} - {{ $name }}</a>
                                    </li>
                                    @endforeach
                                    @endif -->
                                </ul>
                            </li>
                            @endif

                            <!-- <li class="cm-submenu {{ (Request::segment(2)=='message' ? 'open' : '') }}">
                                <a class="sf-envelope-letter">{{ trans('app.message') }} <span class="caret"></span></a>
                                <ul>
                                    <li class="{{ (Request::is('common/message') ? 'active' : '') }}">
                                        <a href="{{ url('common/message') }}">{{ trans('app.new_message') }}</a>
                                    </li>
                                    <li class="{{ (Request::is('common/message/inbox') ? 'active' : '') }}">
                                        <a href="{{ url('common/message/inbox') }}">{{ trans('app.inbox') }}</a>
                                    </li>
                                    <li class="{{ (Request::is('common/message/sent') ? 'active' : '') }}">
                                        <a href="{{ url('common/message/sent') }}">{{ trans('app.sent') }}</a>
                                    </li>
                                </ul> -->
                            </li>
                            @if(!Auth::user()->hasRole('receptionist'))
                            <li class="cm-submenu {{ (Request::segment(2)=='setting' ? 'open' : '') }}">
                                <a class="sf-cog">General Settings <span class="caret"></span></a>
                                <ul>
                                    @if (auth()->user()->hasRole('admin'))
  <!--sidebar sa may settings  -->
                                    <!-- <li class="{{ (Request::is('admin/setting') ? 'active' : '') }}">
                                        <a href="{{ url('admin/setting') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.app_setting') }}</a>
                                    </li>
                                    <!-- <li class="{{ (Request::is('admin/setting/display') ? 'active' : '') }}">
                                        <a href="{{ url('admin/setting/display') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.display_setting') }}</a>
                                    </li> -->
                                    <li class="{{ (Request::is('admin/setting/ads/view') ? 'active' : '') }}">
                                        <a href="{{ route('ads_view') }}"><i class="bi bi-chevron-right"></i> Advertisement</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/database/backup-and-restore') ? 'active' : '') }}">
                                        <a href="{{ route('backup_and_restore') }}"><i class="bi bi-chevron-right"></i> Backup and Restore</a>
                                    </li>
                                    <li class="{{ (Request::is('admin/database/backup-files') ? 'active' : '') }}">
                                        <a href="{{ route('show_backup') }}"><i class="bi bi-chevron-right"></i> Backup Files</a>
                                    </li>
                                    @endif

                                    <li class="{{ (Request::is('common/setting/*') ? 'active' : '') }}">
                                        <a href="{{ url('common/setting/profile') }}"><i class="bi bi-chevron-right"></i> {{ trans('app.profile_information') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(!Auth::user()->hasRole('receptionist'))
                            <li class="{{ ((Request::is('logout')) ? 'active' : '') }}">
                                <a href="{{ url('logout') }}" class="sf-lock">
                                    {{ trans('app.signout') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ends of Sidebar -->


        <!-- Starts of Header/Menu -->
        <header id="cm-header">
            <nav class="cm-navbar cm-navbar-primary">
                <div class="btn btn-primary md-menu-white hidden-md hidden-lg" data-toggle="cm-menu"></div>
                <div class="cm-flex">
                    <h1 class="clearfix">{{ Session::get('app.title') }}</h1>
                </div>

                <!-- Buy Now -->
                @yield('info.buy-now')

                <!-- <div class="dropdown pull-right">
                    <button class="btn btn-primary md-desktop-windows-white" data-toggle="dropdown"></button>
                    <div class="popover cm-popover bottom">
                        <div class="arrow"></div>
                        <div class="popover-content">
                            <div class="list-group">
                                <a href="{{ url('common/display?type=1') }}" target="_blank" class="{{session()->get('app.display')==1?'active':null}} list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.display_1') }}</h4>
                                </a>
                                <a href="{{ url('common/display?type=2') }}" target="_blank" class="{{session()->get('app.display')==2?'active':null}} list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.display_2') }}</h4>
                                </a>
                                <a href="{{ url('common/display?type=3') }}" target="_blank" class="{{session()->get('app.display')==3?'active':null}} list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.display_3') }}</h4>
                                </a>
                                <a href="{{ url('common/display?type=4') }}" target="_blank" class="{{session()->get('app.display')==4?'active':null}} list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.display_4') }}</h4>
                                </a>
                                <a href="{{ url('common/display?type=5') }}" target="_blank" class="{{session()->get('app.display')==5?'active':null}} list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.display_5') }}</h4>
                                </a>
                                @if (session()->has('custom_displays'))
                                @foreach(session()->get('custom_displays') as $key => $name)
                                <a href="{{ url('common/display?type=6&custom='.$key) }}" target="_blank" class="list-group-item">
                                    <h4 class="list-group-item-heading"></i> {{ trans('app.custom_display') }} - {{ $name }}</h4>
                                </a>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="dropdown pull-right">
                    <a href="{{ url('common/message/inbox') }}" class="btn btn-primary md-local-post-office-white"> <span class="label label-danger" id="message-notify">0</span> </a>
                </div> -->
                <!-- <div class="dropdown pull-right">
                    <button class="btn btn-primary md-language-white" data-toggle="dropdown"> <span class="label label-danger">{{ Session::get('locale')? Session::get('locale'):'en' }}</span></button>
                    <div class="popover cm-popover bottom">
                        <div class="arrow"></div>
                        <div class="popover-content">
                            <div class="list-group">
                                <a href="javascript:void(0)" data-locale="en" class="select-lang list-group-item {{ ((Session::get('locale')=='en' || !Session::has('locale'))?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> English</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="ar" class="select-lang list-group-item {{ (Session::get('locale')=='ar'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> العَرَبِيَّة'</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="tr" class="select-lang list-group-item {{ (Session::get('locale')=='tr'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> Türkçe</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="bn" class="select-lang list-group-item {{ (Session::get('locale')=='bn'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> বাংলা</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="es" class="select-lang list-group-item {{ (Session::get('locale')=='es'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> Español</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="fr" class="select-lang list-group-item {{ (Session::get('locale')=='fr'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> Français</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="pt" class="select-lang list-group-item {{ (Session::get('locale')=='pt'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> Português</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="te" class="select-lang list-group-item {{ (Session::get('locale')=='te'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> తెలుగు</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="th" class="select-lang list-group-item {{ (Session::get('locale')=='th'?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> ภาษาไทย</h4>
                                </a>
                                <a href="javascript:void(0)" data-locale="vi" class="select-lang list-group-item {{ ((Session::get('locale')=='vi')?'active':'') }}">
                                    <h4 class="list-group-item-heading"></i> Tiếng Việt</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                @if($user = Auth::user())
                <div class="dropdown pull-right">
                    <button class="btn btn-primary md-account-circle-white" data-toggle="dropdown"></button>
                    <ul class="dropdown-menu account-menu">
                        <li class="disabled text-center account-profile-container">
                            <img src="{{ !empty($user->photo)?asset($user->photo):asset('public/assets/img/icons/no_user.jpg') }}" width="140" height="105">
                        </li>
                        <li class="disabled text-center">
                            <a style="cursor:default;"><strong>{{ $user->firstname .' '. $user->lastname }}</strong>
                            </a>
                            <span class="label label-success">{{ auth()->user()->role() }}</span>
                        </li>
                        <li class="divider"></li>
                        @if(!Auth::user()->hasRole('receptionist'))=
                        <li>
                            <a href="{{ url('common/setting/profile') }}"><i class="fa fa-user"></i> {{ trans('app.profile_information') }}</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> {{ trans('app.signout') }}</a>
                        </li>
                    </ul>
                </div>
                @endif
            </nav>
        </header>
        <!-- Ends of Header/Menu -->


        <div id="global">

            <div class="container-fluid">
                <!-- Starts of Message -->
                @yield('info.message')
                <!-- Ends of Message -->

                <!-- Starts of Content -->
                @yield('content')
                <!-- Ends of Contents -->
            </div>

            <!-- Starts of Copyright -->

            <footer class="cm-footer text-right">
                <span class="hidden-xs">{{ \Session::get('app.copyright_text') }}</span>
                <span class="pull-left text-center">@yield('info.powered-by') @yield('info.version')</span>
            </footer>
            <!-- Ends of Copyright -->
        </div>


        <!-- All js -->
        <!-- bootstrp -->
        <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
        <!-- select2 -->
        <script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
        <!-- juery-ui -->
        <script src="{{ asset('public/assets/js/jquery-ui.min.js') }}"></script>
        <!-- jquery.mousewheel.min -->
        <script src="{{ asset('public/assets/js/jquery.mousewheel.min.js') }}"></script>
        <!-- jquery.cookie.min -->
        <script src="{{ asset('public/assets/js/jquery.cookie.min.js') }}"></script>
        <!-- fastclick -->
        <script src="{{ asset('public/assets/js/fastclick.min.js') }}"></script>
        <!-- template -->
        <script src="{{ asset('public/assets/js/template.js') }}"></script>
        <!-- datatable -->
        <script src="{{ asset('public/assets/js/dataTables.min.js') }}"></script>
        <!-- custom script -->
        <script src="{{ asset('public/assets/js/script.js') }}"></script>

        <!-- Page Script -->
        @stack('scripts')

        <script type="text/javascript">
        (function() {
          //notification
            notify();
            setInterval(function(){
                notify();
            }, 30000);

            function notify()
            {
                $.ajax({
                   type:'GET',
                   url:'{{ URL::to("common/message/notify") }}',
                   data:'_token = <?php echo csrf_token() ?>',
                   success:function(data){
                      $("#message-notify").html(data);
                   }
                });
            }

            //language switch
            $(".select-lang").on('click', function() {
                $.ajax({
                   type:'GET',
                   url: '{{ url("common/language") }}',
                   data: {
                      'locale' : $(this).data("locale"),
                      '_token' : '<?php echo csrf_token() ?>'
                   },
                   success:function(data){
                      history.go(0);
                   }, error: function() {
                    alert('failed');
                   }
                });
            });

        })();


        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault(); // Prevent the default action (navigation)

            var url = $(this).attr('href'); // Get the URL from the href attribute

            Swal.fire({
                title: 'Are you sure you want to delete it?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Success!", "Deleted successfully", "success");
                    // If confirmed, proceed with the deletion
                    setTimeout(() => {
                        window.location.href = url;
                    }, 1500)
                }
            });
        });


        $(document).on('click', '.btn-complete', function(e) {
            e.preventDefault(); // Prevent the default action (navigation)

            var url = $(this).attr('href'); // Get the URL from the href attribute

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to complete this number!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: 'green',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, complete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, proceed with the completion
                    Swal.fire("Success!", "The number has been successfully completed", "success");
                    setTimeout(() => {
                        window.location.href = url;
                    }, 1500);
                }
            });
        });

        $(document).on('click', '.btn-stop', function(e) {
            e.preventDefault(); // Prevent the default action (navigation)

            var url = $(this).attr('href'); // Get the URL from the href attribute

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to stop this number!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'orangered',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, stop it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Success!", "The number has been stopped successfully", "success");
                    // If confirmed, proceed with the deletion
                    setTimeout(() => {
                        window.location.href = url;
                    }, 1500);
                }
            });
        });
        </script>
    </body>
</html>

