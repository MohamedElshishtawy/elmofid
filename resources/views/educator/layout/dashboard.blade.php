<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>




    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <!--
        RTL version
    -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>




    <!-- Fontfaces CSS-->
    <link href="{{asset("css/font-face.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/font-awesome-4.7/css/font-awesome.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/font-awesome-5/css/fontawesome-all.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/fontawesome-free-6.5.1-web/css/all.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/mdi-font/css/material-design-iconic-font.min.css")}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset("vendor/bootstrap-4.1/bootstrap.min.css")}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset("vendor/animsition/animsition.min.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/wow/animate.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/css-hamburgers/hamburgers.min.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/slick/slick.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/select2/select2.min.css?1")}}" rel="stylesheet" media="all">
    <link href="{{asset("vendor/perfect-scrollbar/perfect-scrollbar.css?1")}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset("css/theme.css?5")}}" rel="stylesheet" media="all">

    <!-- Mohamed CSS -->
    <link rel="stylesheet" href="{{asset("css/content/dropdown.css?1")}}">

    @yield('css_files')

</head>

<body class="animsition" dir="rtl">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-lg-block">
        <div class="logo justify-content-center">
            <a href="https://www.5dmaty.com/">
                <img src="{{asset("images/icon/5dmaty.png")}}" alt="Elmofid" width="52" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="{{$active == 'groups' ? 'active' : ''}} has-list">
                        <a class="js-arrow"  href="{{route('groups')}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/students.png")}}">
                                <span>إدارة المجموعات</span>
                            </div>
                        </a>
                    </li>
                    <li class="{{$active == 'exams' ? 'active' : ''}} has-list">
                        <a class="js-arrow"  href="{{route('exams')}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/exam_icon.png")}}">
                                <span>الإمتحانات الإلكترونية</span>
                            </div>
                        </a>
                        {{-- <ul class="sub-list">
                            <li>
                                <a href="exams/1">الصف الأول الثانوى</a>
                            </li>
                            <li>
                                <a href="exams/2">الصف الثانى الثانوى</a>
                            </li>
                            <li>
                                <a href="exams/3">الصف الثالث الثانوى</a>
                            </li>
                        </ul> --}}
                    </li>
                    <li class="{{$active == 'pdf' ? 'active' : ''}}">
                        <a class="js-arrow"  href="{{route('pdf_index')}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/pdf_icon.png")}}">
                                <span>المذكرات الإلكترونية</span>
                            </div>
                        </a>
                    </li>

                    <li class="{{$active == 'imgs' ? 'active' : ''}}">
                        <a class="js-arrow"  href="{{route("img_index")}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/board.png")}}">
                                <span>صور السبورة</span>
                            </div>
                        </a>
                    </li>

                    <li class="{{$active == 'homework' ? 'active' : ''}}">
                        <a class="js-arrow"  href="{{route("homework_index")}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/homework.png")}}">
                                <span>الواجب اليومى</span>
                            </div>
                        </a>
                    </li>

                    <li class="{{$active == 'videos' ? 'active' : ''}}">
                        <a class="js-arrow"  href="{{route("video_index")}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/video_icon.png")}}">
                                <span> الفيديوهات التعليمية</span>
                            </div>
                        </a>
                    </li>

                    <li class="{{$active == 'whitelists' ? 'active' : ''}}">
                        <a class="js-arrow"  href="{{route("whitelists")}}">
                            <div class="side-list-row">
                                <img src="{{asset("images/icon/cup2.png")}}">
                                <span>التقارير</span>
                            </div>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- END PAGE CONTAINER-->
    <div class="page-container">

        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <div class="header-button">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="{{asset("images/logo.jpg")}}" alt="Mr. Ahmed Hamid Elnemr" />
                                    </div>
                                    <div class="content">
                                        <label class="js-acc-btn text-lg font-weight-bold" style="color: black"> <span style="color: red">مستر</span> أحمد حامد النمر </label>
                                    </div>

                                </div>
                            </div>

                            <div id="menu" class="btn">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <div class="logout-wrap">
                            <a href="{{route('logout')}}" class="btn btn-danger text-capitalize">تسجيل خروج <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <x-messages />
                    @yield('content') {{--Now You can put bootsrap row > col-whatUwant--}}
                </div>
            </div>
        </div>
        <!-- End MAIN CONTENT-->

    </div>
    <!-- END MAIN CONTENT-->


</div>
<!-- END PAGE CONTAINER-->
</div>

</div>

<!-- Jquery JS-->
<script src="{{asset("vendor/jquery-3.2.1.min.js")}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset("vendor/bootstrap-4.1/popper.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap-4.1/bootstrap.min.js")}}"></script>
<!-- Vendor JS       -->
<script src="{{asset("vendor/slick/slick.min.js")}}"></script>
<script src="{{asset("vendor/wow/wow.min.js")}}"></script>
<script src="{{asset("vendor/animsition/animsition.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
<script src="{{asset("vendor/counter-up/jquery.waypoints.min.js")}}"></script>
<script src="{{asset("vendor/counter-up/jquery.counterup.min.js")}}"></script>
<script src="{{asset("vendor/circle-progress/circle-progress.min.js")}}"></script>
<script src="{{asset("vendor/perfect-scrollbar/perfect-scrollbar.js")}}"></script>
<script src="{{asset("vendor/chartjs/Chart.bundle.min.js")}}"></script>
<script src="{{asset("vendor/select2/select2.min.js")}}"></script>


<!-- Main JS-->
<script src="{{asset("js/main.js")}}"></script>

{{--  Mohamed JS  --}}
<script src="{{asset("js/content/dropdown.js?5")}}"></script>


<script>



    $(document).ready(function(){
        $('button[type="submit"]').click(function(e){
            let action = confirm('هل انت متأكد');

            if (!action) {
                e.preventDefault();
            }
        });
    });

</script>

</body>

</html>
<!-- end document-->
