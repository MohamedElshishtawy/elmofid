<!DOCTYPE html>
<html lang="ar">
<head>
    <link rel="icon" href="{{asset('images/logo.jpg')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الطلاب</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}">
    <link href="{{asset("vendor/fontawesome-free-6.5.1-web/css/all.min.css")}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('css/student/index.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/content/contacts.css?1')}}">
    @yield('css')
</head>
<body dir="rtl">

    <nav style="top:0">
        <div> <i class="fa-solid fa-angle-left fa-xl"></i> @yield('title', 'الرئيسية')</div>
        <div>
            <a href="{{route('account_page')}}">
                @php( $img = \App\Models\Student::student_image(Auth::user()->id) ?? null )

                <img src="{{ $img ? asset('storage/'.\App\Models\Student::student_image(Auth::user()->id) ) . '?'.time()  :  asset('images/icon/student.png')}}" alt="">

                <span>حسابى</span>
            </a>
        </div>
    </nav>


    <div class="window">

        <h1 class="mb-4">منصة {{config('constants.Title')}}</h1>

        <x-messages />

        {{-- <section class="welcome">
            <img src="{{asset('images/goals-bro.png')}}" alt="">
            <span>هانت يا بطل</span>
        </section>--}}

        <img class="welcome" src="http://localhost/elmofid/public/images/phy.jpg" alt="" style="
    width: 80%;
    border-radius: 10px;
    left: 10%;
    position: relative;
">


        @yield('content')



    </div>

    <div class="button-nav">
        <a href="{{route('student_exams')}}">
            <img src="{{asset('images/icon/exam_icon.png')}}" alt="">
            <span>الإختبارات</span>
        </a>
        <a href="{{route('show_pdfs')}}">
            <img src="{{asset('images/icon/pdf_icon.png')}}" alt="">
            <span>الكتب الإلكترونية</span>
        </a>
        <a href="{{route('index')}}">
            <img src="{{asset('images/icon/home.png')}}" alt="">
            <span>الرئيسية</span>
        </a>
        <a href="{{route('show_videos')}}">
            <img src="{{asset('images/icon/video_icon.png')}}" alt="">
            <span>الفيديوهات</span>
        </a>
        <a href="{{route('analysis_page')}}">
            <img src="{{asset('images/icon/analysis_icon.png')}}" alt="">
            <span>التقييم</span>
        </a>
    </div>
    <x-contacts />

    <script src="{{asset("vendor/jquery-3.2.1.min.js")}}"></script>
    @yield('js')
    <script src="{{asset('js/content/contacts.js')}}"></script>

</body>
</html>
