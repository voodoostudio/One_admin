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
    <title>Email confirmation</title>
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

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <div class="m-content">
            <div class="row">
                <div class="col-sm-2 col-lg-3"></div>
                <div class="col-sm-8 col-lg-6">
                    <!--begin:: Widgets/Announcements 2-->
                    <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Agreement notification
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 7-->
                            <div class="m-widget7">
                                <div class="m-widget7__desc" style="margin-bottom: 70px; margin-top: 70px">
                                    You are here to confirm that you are agree to receive email with details about "Object title". <br><br>
                                    If you are not agree, please close this page and ignore the email that you already received. <br><br>
                                    If you are agree, please click the following button. In this case you will receive another email with full Object specification.
                                </div>
                                <div class="m-widget7__button">
                                    <a class="m-btn btn-lg m-btn--pill btn btn-accent" href="#" role="button">I agree</a>
                                </div>
                            </div>
                            <!--end::Widget 7-->
                        </div>
                    </div>
                    <!--end:: Widgets/Announcements 2-->
                </div>
                <div class="col-sm-2 col-lg-3"></div>
            </div>
        </div>
    </div>
    <!-- end:: Body -->
</div>
<!-- end:: Page -->


{{--</script>--}}
<!--begin::Base Scripts -->
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->

<!--begin::Page Resources -->
<script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
<!--end::Page Resources -->

@yield('javascript')

@if(!empty(config('voyager.additional_js')))<!-- Additional Javascript -->
@foreach(config('voyager.additional_js') as $js)<script type="text/javascript" src="{{ asset($js) }}"></script>@endforeach
@endif

</body>
</html>
