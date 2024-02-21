


@extends('educator.layout.dashboard')

@php($active = 'whitelists')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?5")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?5")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>


        <section>


            <h2>التقيمات</h2>



            <div class="exam-section">
                <div class="exams-header">
                    <h3>تقيمات الصف الأول</h3>
                </div>
                <div class="exams">
                    <div class="card-container">
                        <a href="{{route("whitelist_page", 1)}}" class="exam-card">
                            <span><img src="{{asset('images/icon/cup.png')}}" alt=""></span>
                            <span>أوائل الصف</span>
                        </a>
                    </div>
                </div>
            </div>



            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>تقيمات الصف الثانى</h3>
                </div>
                <div class="exams">
                    <div class="card-container">
                        <a href="{{route("whitelist_page", 2)}}" class="exam-card">
                            <span><img src="{{asset('images/icon/cup.png')}}" alt=""></span>
                            <span>أوائل الصف</span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>تقيمات الصف الثالث</h3>
                </div>
                <div class="exams">
                    <div class="card-container">
                        <a href="{{route("whitelist_page", 3)}}" class="exam-card">
                            <span><img src="{{asset('images/icon/cup.png')}}" alt=""></span>
                            <span>أوائل الصف</span>
                        </a>
                    </div>
                </div>
            </div>


        </section>


    </div>
@endsection
