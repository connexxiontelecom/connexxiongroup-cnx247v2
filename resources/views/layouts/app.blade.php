<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{Auth::user()->tenant->company_name ?? ''}} | @yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="">
    <meta name="author" content="Connexxion Group">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="/assets/images/company-assets/favicons/{{Auth::user()->tenant->favicon ?? 'favicon.ico' }} " type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/icon/material-design/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\font-awesome\css\font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="/assets/icon/feather/css/feather.css">
    <!--Intro -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/intro.js/css/introjs.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/cus/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/bower_components/offline/css/offline-theme-slide.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/offline/css/offline-language-english.css">

    <style>
        .card{
            border-radius: 0px !important;
        }
        .dropdown-menu{
            border-radius: 0px !important;
        }
        #dialer-screen{
            border-radius:20px;
            width:100%;
            background:#E2E8F0;
            color:#000000;
            padding:10px;
            font-family: 'Oswald', sans-serif;
            letter-spacing:2px;
        }
        .modal-content{
            border-radius: 0px !important;
        }
        .theme-border{
            border: 2px solid #0AC282;
        }
    </style>
    @yield('extra-styles')
    @livewireStyles
</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('partials.commons._top-navbar')


        @livewire('backend.chat-n-calls.messenger-list')

        <div class="pcoded-main-container" id="pcoded-background" style="background: url('/assets/uploads/wallpapers/paper2.jpg'); background-size:cover; background-repeat: no-repeat;">
            <div class="pcoded-wrapper">

                @include('partials.sidebar._admin-sidebar')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <div class="page-body">


                                    @yield('content')


                                </div>
                            </div>
                        </div>
                        {{-- <div id="styleSelector">

                        </div> --}}
                        <footer class="footer" style="position: relative; bottom:0px; width:100%; margin-top:30px; background:none;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-9">
                                        <nav class="nav">
                                            <a class="nav-link" href="{{route('cnx247-terms-n-conditions')}}">Terms & Conditions</a>
                                            <a class="nav-link" href="{{route('cnx247-privacy-policy')}}">Privacy Policy</a>
                                            <a class="nav-link" href="http://www.connexxiongroup.com" target="_blank">All Rights Reserved &copy; {{date('Y')}} Connexxion Group</a>
                                        </nav>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-inline">
                                            <div class="form-group mr-1">
                                                <select name="" class="form-control" id="">
                                                    <option value="en">English</option>
                                                    <option value="fr">French</option>
                                                    <option value="es">Spanish</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-out-dashed btn-primary btn-square" data-toggle="modal" data-target="#themeModal" style="background: none;">Themes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('dialog-section')
<div class="modal fade" id="themeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="sub-title">Themes</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row" style="height: 500px; overflow-y: scroll;" id="theme-collection">
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper" data-themeid="23">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div class="thumb" style="cursor: pointer;">
                                <img src="\assets\images\gallery-grid\1.png" alt="" class="img-fluid img-thumbnail theme-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group ">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close text-white mr-2"></i> Close</button>
                    <button type="button" class="btn btn-success waves-effect btn-mini waves-light" id="saveTheme"> <i class="ti-check text-white mr-2"></i> Save</button>
                </div>
                <button type="button" class="btn btn-secondary waves-effect btn-mini waves-light float-right" data-toggle="modal" data-target="#customModal" id="custome">Custom Theme</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="sub-title">Use Your Own Theme</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-block" style="background: #EEF2F4;">
                                <div class="form-group">
                                    <label for="">Background Image</label> <br>
                                    <img src="\assets\images\gallery-grid\1.png" class="mb-2" height="48" width="48" alt="">
                                    <input type="file" name="background_image" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <label for="">Text Color</label>
                                    <input type="color" name="text_color" class="form-control col-md-2">
                                </div>
                                <div class="form-group">
                                    <label for="">Caption Color</label>
                                    <input type="color" name="text_color" class="form-control col-md-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group ">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close text-white mr-2"></i> Close</button>
                    <button type="button" class="btn btn-success waves-effect btn-mini waves-light" id="useMine"> <i class="ti-check text-white mr-2"></i> Use Mine</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="/assets/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="/assets/bower_components/modernizr/js/css-scrollbars.js"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="/assets/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script src="/assets/js/pcoded.min.js"></script>
<script src="/assets/js/vartical-layout.min.js"></script>
<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="/assets/js/script.js"></script>
<!-- Offline js -->
<script type="text/javascript" src="/assets/bower_components/offline/js/offline.min.js"></script>
<script type="text/javascript" src="/assets/pages/offline/offline-custom.js"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/notify.js')}}"></script>
<script type="text/javascript" src="/assets/bower_components/intro.js/js/intro.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.theme-wrapper', function(e){
            e.preventDefault();
            $(this).closest('#theme-collection').removeClass('theme-border');
            $(this).addClass('theme-border');
            var image = $(this).attr('src');
            var id = $(this).data('themeid');
            //$('#pcoded-background').css("background","url(" + image + ")");
        });
    });
</script>
@stack('chat-script')
    @yield('extra-scripts')
@livewireScripts

</body>

</html>
