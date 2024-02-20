@extends('student.layout')

@section('content')
    <div class="sections">
        <h3 class="text-center">جاهز ؟!</h3>
        <a href="{{route('student_exams')}}">
            <img src="{{asset('images/icon/exam_icon.png')}}" alt="">
            <span>الإختبارات</span>
        </a>
        <a href="{{route('show_pdfs')}}">
            <img src="{{asset('images/icon/pdf_icon.png')}}" alt="">
            <span>الكتب الإلكترونية</span>
        </a>
        <a href="{{route('show_videos')}}">
            <img src="{{asset('images/icon/video_icon.png')}}" alt="">
            <span>الفيديوهات</span>
        </a>
        <a href="{{route('analysis_page')}}">
            <img src="{{asset('images/icon/analysis_icon.png')}}" alt="">
            <span>التقييم</span>
        </a>
        <a href="{{route('show_images')}}">
            <img src="{{asset('images/icon/board.png')}}" alt="">
            <span>صور الحصص</span>
        </a>

        <a href="{{route('show_homeworks')}}">
            <img src="{{asset('images/icon/homework.png')}}" alt="">
            <span>الواجبات</span>
        </a>
    </div>

    <div>
        <img width="100%" src="{{asset('images/cot.png')}}" alt="">
    </div>
    <br>
    <br>
    <br>


@endsection
