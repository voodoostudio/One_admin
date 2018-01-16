<!DOCTYPE html><!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 5.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>@yield('page_title', 'Admin panel' . " - " . setting('admin.description'))</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ voyager_asset('images/logo-icon.png') }}" type="image/x-icon">


    @yield('css')
    <!--begin::Base Styles -->
    <link href="{{ asset('assets/metronic_5/theme/dist/html/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->

    <!-- App CSS -->
    {{--<link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">--}}

    {{--@yield('css')--}}
    <link rel="shortcut icon" href="{{ asset('assets/house_invest_spain/img/favicon.ico') }}" />

    @yield('head')
</head>
<!-- end::Head -->

{{--<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">--}}
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize">

<?php
$user_avatar = Voyager::image(Auth::user()->avatar);
if ((substr(Auth::user()->avatar, 0, 7) == 'http://') || (substr(Auth::user()->avatar, 0, 8) == 'https://')) {
    $user_avatar = Auth::user()->avatar;
}
?>

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
@include('voyager::dashboard.navbar')
<!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
    @include('voyager::dashboard.sidebar')
    <!-- END: Left Aside -->
        @yield('content')
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
@include('voyager::partials.app-footer')
<!-- end::Footer -->
</div>
<!-- end:: Page -->

{{--@include('voyager::partials.app-footer')--}}

<!-- Javascript Libs -->


{{--<script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>--}}


{{--<script>--}}
{{--@if(Session::has('alerts'))--}}
{{--let alerts = {!! json_encode(Session::get('alerts')) !!};--}}
{{--helpers.displayAlerts(alerts, toastr);--}}
{{--@endif--}}

{{--@if(Session::has('message'))--}}

{{--// TODO: change Controllers to use AlertsMessages trait... then remove this--}}
{{--var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};--}}
{{--var alertMessage = {!! json_encode(Session::get('message')) !!};--}}
{{--var alerter = toastr[alertType];--}}

{{--if (alerter) {--}}
{{--alerter(alertMessage);--}}
{{--} else {--}}
{{--toastr.error("toastr alert-type " + alertType + " is unknown");--}}
{{--}--}}

{{--@endif--}}
{{--</script>--}}
<!--begin::Base Scripts -->
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->

<!--begin::Page Resources -->
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
<!--end::Page Resources -->

<script>
    MyOutdatedBrowser();
    function MyOutdatedBrowser() {
        //TODO create a public api to have these set from the cloud rather than having them hardcoded in typescript
        var browsers = {
            GoogleChrome: {
                name: "chrome",
                version: 53
            },
            MozillaFirefox: {
                name: "firefox",
                version: 46
            },
            InternetExplorer: {
                name: "msie",
                version: 14
            },
            InternetExplorerElse: {
                name: "ie",
                version: 11
            },
            AppleSafari: {
                name: "safari",
                version: 5
            },
            Opera: {
                name: "opera",
                version: 38
            }
        };


        function getBrowserKeys() {
            return Object.getOwnPropertyNames(browsers)
        }

        function isBrowserOutdated(curBrowser) {
            var curBrowserName = curBrowser.name.toLowerCase();

            var keys = getBrowserKeys();

            var browser_version = curBrowser.version;

            for(var i=0; i< keys.length ; i++) {
                var browser = browsers[keys[i]];

                if(curBrowserName == browser.name) {
                    return curBrowser.version <= browser.version;
                } else {
                    //continue
                }
            }
            return true;  //browser is found and version is equal or greater than ours
        }

        function get_browser_info() {
            var ua = navigator.userAgent, tem, M = ua.match(/(opera|chrome|safari|firefox|msie|ie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if (/trident/i.test(M[1])) {
                tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
                return {name: 'ie', version: (tem[1] || '')};
            }
            if (M[1] === 'Chrome') {
                tem = ua.match(/\bOPR\/(\d+)/);
                if (tem != null) {
                    return {name: 'Opera', version: tem[1]};
                }
            }
            M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
            if ((tem = ua.match(/version\/(\d+)/i)) != null) {
                M.splice(1, 1, tem[1]);
            }
            return {
                name: M[0],
                version: M[1]
            };

        }

        function addLoadEvent(func) {
            var oldonload = window.onload;
            if (typeof window.onload != 'function') {
                window.onload = func;
            } else {
                window.onload = function() {
                    if (oldonload) {
                        oldonload();
                    }
                    func();
                }
            }
        }

        var blockID = "outdated";
        var closeButtonID = "btnCloseUpdateBrowser";

        addLoadEvent(function() {
            if(isBrowserOutdated(get_browser_info())) {
                //var block = document.getElementById(blockID);
                //show
                $('#outdated_browser_alert').show();
                //block.setAttribute("style", "display: block;");
            } else {
                //nop
            }
        })
    }
</script>
@yield('javascript')

@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
@foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

</body>
</html>
