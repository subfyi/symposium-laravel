<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../../">
    <meta charset="utf-8"/>
    <title>ISESER | 2020</title>
    <meta name="description"
          content="International Symposium for Environmental Science and Engineering Research | ISESER2020"/>
    <meta content="BG" name="author"/>
    <link rel="icon" type="image/png" href="/wp-content/uploads/2017/11/v_5_telif-300x300.png">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->

    <!--end::Fonts -->

    <!--begin::Global Theme Styles(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <link href="{{url('/')}}/cms/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>

    <!--end:: Vendor Plugins -->
    <link href="{{url('/')}}/cms/css/style.bundle.css" rel="stylesheet" type="text/css"/>

    <!--begin:: Vendor Plugins for custom pages -->
    <link href="{{url('/')}}/cms/plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/jqvmap/dist/jqvmap.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/cms/plugins/custom/uppy/dist/uppy.min.css" rel="stylesheet" type="text/css"/>

    <!--end:: Vendor Plugins for custom pages -->
    <!--end::Layout Skins -->


    <?php
    if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
        $local = True;
    } else {
        $local = False;
    }
    ?>
    @if($local==false)
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109514763-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-109514763-1');
        </script>


    @endif
    @yield('css')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-page--loading-enabled kt-page--loading kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled kt-subheader--transparent kt-page--loading">

<!-- begin::Page loader -->

<!-- end::Page Loader -->

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__brand">
        <a class="kt-header-mobile__logo" href="?page=index&demo=demo5">
            <img style="
    width: 190px;
" alt="Logo" src="{{url('/')}}/doc/logo/v6_telifsiz-300x72.png"/>
        </a>
        <div class="kt-header-mobile__nav">
            <div class="dropdown">
                <button type="button" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24"
                         version="1.1"
                         class="kt-svg-icon kt-svg-icon--md kt-svg-icon--success">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z"
                                  fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z"
                                  fill="#000000"/>
                        </g>
                    </svg>
                </button>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md">
                    <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-margin-t-20 kt-margin-b-20">
                        <li class="kt-nav__item">
                            <a class="kt-nav__link active" href="{{url('/')}}">
                                <span class="kt-nav__link-icon"><i class="flaticon2-chart2"></i></span>
                                <span class="kt-nav__link-text">Home</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a class="kt-nav__link" href="{{url('/')}}/documents">
                                <span class="kt-nav__link-icon"><i class="flaticon2-chart2"></i></span>
                                <span class="kt-nav__link-text">Documents</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a class="kt-nav__link" href="{{url('/')}}/contact">
                                <span class="kt-nav__link-icon"><i class="flaticon2-chart2"></i></span>
                                <span class="kt-nav__link-text">Contact</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-header__top">
                    <div class="kt-container ">

                        <!-- begin:: Brand -->
                        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                            <div class="kt-header__brand-logo">

                                <a href="/admin">
                                    <img src="/doc/logo/v6_telifsiz-300x72.png" alt="logo" style="

    height: 50px;
" class="logo-default">
                                </a>
                            </div>

                        </div>

                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">


                            <!--begin: User bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
                                    <span class="kt-hidden kt-header__topbar-welcome">Hallo,</span>
                                    <span class="kt-hidden kt-header__topbar-username"> {{ Auth::user()->name }}</span>
                                    @if(isset(Auth::user()->logo))
                                        <img src="/uploads/img/{{ Auth::user()->logo }}" class="kt-hidden-" alt="Pic">
                                    @else
                                        <img src="/uploads/img/logo.png" class="kt-hidden-" alt="Pic">
                                    @endif
                                    <span class="kt-header__topbar-icon kt-header__topbar-icon--brand kt-hidden"><b>S</b></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                        <div class="kt-user-card__avatar">
                                            @if(isset(Auth::user()->logo))
                                                <img class="kt-hidden-" alt="Pic" src="/uploads/img/{{ Auth::user()->logo }}">
                                            @else
                                                <img class="kt-hidden-" src="/uploads/img/logo.png" alt="Pic">
                                        @endif
                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                        </div>
                                        <div class="kt-user-card__name">
                                            {{ Auth::user()->name }}
                                        </div>
                                    </div>

                                    <!--end: Head -->

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <a href="/user" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Profile
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Account settings and more
                                                </div>
                                            </div>
                                        </a>

                                        <div class="kt-notification__custom kt-space-between">
                                            <a ></a>
                                            <a href="/cikisyap" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign
                                                Out</a>
                                        </div>
                                    </div>

                                    <!--end: Navigation -->
                                </div>
                            </div>

                            <!--end: User bar -->
                        </div>

                        <!-- end:: Header Topbar -->
                    </div>
                </div>
                <div class="kt-header__bottom">
                    <div class="kt-container ">

                        <!-- begin: Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                                <ul class="kt-menu__nav ">
                                    <li class="kt-menu__item  kt-menu__item--rel">
                                        <a href="{{url('/')}}/" class="kt-menu__link ">
                                            <span class="kt-menu__link-text">Home</span><i></i></a>
                                    </li>

                                    @if(\Illuminate\Support\Facades\Auth::user()->yetki > 0)

                                        <li class="kt-menu__item  kt-menu__item--rel">
                                            <a href="{{url('/')}}/user/" class="kt-menu__link ">
                                                <span class="kt-menu__link-text">Profile</span><i></i></a>
                                        </li>

                                        <li class="kt-menu__item  kt-menu__item--rel">
                                            <a href="{{url('/')}}/user/paper-add" class="kt-menu__link ">
                                                <span class="kt-menu__link-text">Paper
                                                Submission</span><i></i></a>
                                        </li>

                                        <li class="kt-menu__item  kt-menu__item--rel">
                                            <a href="{{url('/')}}/user/papers" class="kt-menu__link ">
                                                <span class="kt-menu__link-text">Sended
                                                Papers</span><i></i></a>
                                        </li>


                                        <li class="kt-menu__item  kt-menu__item--rel">
                                            <a href="{{url('/')}}/user/feedback/feedback-add" class="kt-menu__link ">
                                                <span class="kt-menu__link-text">Add
                                                Feedback</span><i></i></a>
                                        </li>
                                    @endif


                                    <li class="kt-menu__item  kt-menu__item--rel">
                                        <a href="{{url('/')}}/documents" class="kt-menu__link ">
                                            <span class="kt-menu__link-text">Documents</span><i></i></a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click"
                                        aria-haspopup="true"><a
                                                href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                    class="kt-menu__link-text">Old Symposiums</span><i
                                                    class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/documents/2019/"
                                                                                                   class="kt-menu__link "><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">2019</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/documents/2018/"
                                                                                                   class="kt-menu__link "><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">2018</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="/documents/2017/" class="kt-menu__link "><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">2017</span></a>
                                                </li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="/documents/2016/"
                                                                                                   class="kt-menu__link "><i
                                                                class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                class="kt-menu__link-text">2016</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--rel">
                                        <a href="{{url('/')}}/contact" class="kt-menu__link ">
                                            <span class="kt-menu__link-text">Contact</span><i></i></a>
                                    </li>



                                    @if(\Illuminate\Support\Facades\Auth::user()->yetki > 7)


                                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click"
                                            aria-haspopup="true"><a
                                                    href="javascript:;" class="kt-menu__link kt-menu__toggle"><span
                                                        class="kt-menu__link-text">Admin</span><i
                                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                                <ul class="kt-menu__subnav">

                                                    <li class="kt-menu__item  kt-menu__item--rel">
                                                        <a href="{{url('/')}}/user/preparing" class="kt-menu__link ">
                                                            <span class="kt-menu__link-text">Preparing</span><i></i></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/papers-add"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Paper Add</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/papers-all"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">All Papers</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="/user/feedback" class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Feedbacks</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="/user/feedback/feedback-add"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Feedbacks</span></a>
                                                    </li>
                                                </ul>
                                                <ul class="kt-menu__subnav">
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/is-turu"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Title Types</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/is-turu-ekle"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Title Type</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/malzeme-turu"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Type Types</span></a>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/malzeme-turu-ekle"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Type Type</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/uygulama-turu"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">PresentationTypes</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/uygulama-turu-ekle"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Presentation
                                                        Type</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/birim-turu"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Paper Types</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/birim-turu-ekle"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Paper Type</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/yetki-turu"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Authority Types</span></a>
                                                    </li>
                                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{url('/')}}/user/tur/yetki-turu-ekle"
                                                                                                       class="kt-menu__link "><i
                                                                    class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span
                                                                    class="kt-menu__link-text">Add Authority Type</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    @endif


                                </ul>
                            </div>
                            <div class="kt-header-toolbar">

                                <?php echo "[".date("Y-m-d")."]";?>
                            </div>
                        </div>

                        <!-- end: Header Menu -->
                    </div>
                </div>
            </div>

            <!-- end:: Header -->
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Subheader -->
                    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                        <div class="kt-container ">

                        </div>
                    </div>

                    <!-- end:: Subheader -->

                    <!-- begin:: Content -->

                @yield('content')
                <!-- end:: Content -->
                </div>
            </div>

            <!-- begin:: Footer -->
            <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
                <div class="kt-footer__top">
                    <div class="kt-container ">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="kt-footer__section">
                                    <h3 class="kt-footer__title">ABOUT US</h3>
                                    <div class="kt-footer__content">
                                        International Symposium for Environmental Science and Engineering Research (ISESER2020)<br>
                                        ISESER2020 which will be held on 29-31 May 2020 in, Manisa.
                                        <div class="footer-email-wrap">Contact us: <a href="tel:iseser@iseser.com"><span>iseser@iseser.com</span></a>
                                            <br>
                                            <a href="tel:+903322238630">Şükrü Dursun (office)</a>: +903322238630
                                            <br>
                                            <a href="tel:+902362013159">Nilgün Yenil Harmancı (office)</a>: +902362013159
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="kt-footer__bottom">
                    <div class="kt-container ">
                        <div class="kt-footer__wrapper">
                            <div class="kt-footer__copyright">
                                &copy; 2020 ISESER By <a href="https://sub.fyi/" target="_blank">Sub.fyi</a>
                            </div>
                            <div class="kt-footer__menu">
                                <a href="{{url('/')}}/contact/">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->


<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#3d94fb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#3d94fb",
                "warning": "#ffb822",
                "danger": "#fd27eb"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->

<!--begin:: Vendor Plugins -->
<script src="{{url('/')}}/cms/plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js"
        type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/quill/dist/quill.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/markdown/lib/markdown.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/raphael/raphael.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/morris.js/morris.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js"
        type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/general/dompurify/dist/purify.js" type="text/javascript"></script>

<!--end:: Vendor Plugins -->
<script src="{{url('/')}}/cms/js/scripts.bundle.js" type="text/javascript"></script>

<!--begin:: Vendor Plugins for custom pages -->
<script src="{{url('/')}}/cms/plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/datatables.net-select/js/dataTables.select.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jstree/dist/jstree.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="{{url('/')}}/cms/plugins/custom/uppy/dist/uppy.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/cms/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
<!--end:: Vendor Plugins for custom pages -->

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->

<!--end::Page Scripts

<script src="{{url('/')}}/js/jquery.form.min.js"></script>
<script src="{{url('/')}}/js/jquery.validate.min.js"></script>
<script src="{{url('/')}}/js/messages_tr.min.js"></script>
-->
<style>
    div.dataTables_wrapper div.dataTables_filter input {
        width: 450px;
    }
</style>
<script>
    $('.summernote').summernote({
        dom: 'frtip',
        "pagingType": "full_numbers",
        tabsize: 3,
        maxHeight: null,             // set maximum height of editor
        minHeight: 250,             // set minimum height of editor
        airMode: false
    });

    $('#kt_table_1').DataTable({
        "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
        dom: 'Bfrtip',
        "order": [[0, 'desc']],
        buttons: [
            'excel', 'copy', 'pdf', 'pageLength'
        ]
    });

    $("#kt_datetimepicker_2").datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });
</script>


<script src="https://cdn.jsdelivr.net/gh/alnorris/file-dialog/index.js"></script>
<script src="https://cdn.jsdelivr.net/gh/buraktamturk/upload-controller-factory/index.js"></script>
<script src="{{url('/')}}/js/prettysize.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/buraktamturk/file-upload-component/index.js"></script>

<script src="{{url('/')}}/js/multipleUpload.js" type="text/javascript"></script>

<script>
    var UploadController = UploadControllerFactory({
        uploader: function (name, blob, contentType, abort, progress) {
            var token = $('meta[name="csrf-token"]').attr('content');

            var form = new FormData();
            form.append("dosya", blob);
            form.append("_token", token);

            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();

                abort.onabort = function () {
                    xhr.onreadystatechange = null;
                    xhr.abort();
                    reject(new Error('Aborted!'));
                };

                xhr.upload.onprogress = xhr.upload.onloadstart = function (e) {
                    progress(e.loaded / e.total);
                };

                xhr.onreadystatechange = function (e) {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            resolve(JSON.parse(this.responseText));
                        } else {
                            reject(this);
                        }
                    }
                };

                xhr.open("POST", "/upload", true);
                xhr.send(form);
            });
        }
    });

    console.log("asdasdas");

    window.FileUploadComponent.register("file-picker", UploadController);
    window.MultipleFileUploadComponent.register("multi-file-upload", UploadController);
</script>


<script type="application/ld+json" data-type="WebSite">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "iseser.com",
        "url": "https://iseser.com/",
        "image": "https://iseser.com/doc/logo/v6_telifsiz-300x72.png",
        "sameAs": [
            "https://www.facebook.com/isesercom/",
            "https://iseser.com/",
        ]
    }


</script>
<script type="application/ld+json" data-type="Organization">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "https://iseser.com/",
        "logo":  "https://iseser.com/doc/logo/v6_telifsiz-300x72.png",
        "name": "iseser.com",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+90 554 867 56 60",
                "email":"iseser@iseser.com",
                "contactType": "customer"
            }
        ]
    }


</script>
@yield('js')
</body>
</html>
