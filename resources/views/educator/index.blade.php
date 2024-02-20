
@extends('educator.layout.dashboard')

@php($active = 'groups')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>
        <section class="d-grid">
            <img height="210" class="m-auto" src="{{asset('images/welcome.png')}}" alt="">
        </section>
        <section class="mt-4">
            <h2>تقارير</h2>

            <div class="cards">
                <div class="card">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div>عدد الطلاب</div>
                    <div>{{$students_count}}</div>
                </div>
                <div class="card">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div>عدد المجموعات</div>
                    <div>{{$groups_count}}</div>
                </div>
                <div class="card">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div>عدد الإمتحانات</div>
                    <div>{{$exams_count}}</div>
                </div>
            </div>
        </section>

        <section class="mt-4">
            <h2>المجموعات</h2>

            <div class="exam-section">
                <div class="exams-header">
                    <h3>مجوعات الصف الأول</h3>
                    <a href="{{route('add_group_page', [1])}}" class="btn btn-success">إضافة مجموعة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($groups_1 as $group)
                    <a href="{{route("group", $group['id'])}}" class="exam-card">
                        <span>{{$group['name']}}</span>
                    </a>
                    @empty
                        <div>لا توجد مجموعات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section">
                <div class="exams-header">
                    <h3>مجوعات الصف الثانى</h3>
                    <a href="{{route('add_group_page', [2])}}" class="btn btn-success">إضافة مجموعة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($groups_2 as $group)
                    <a href="{{route("group", $group['id'])}}" class="exam-card">
                        <span>{{$group['name']}}</span>
                    </a>
                    @empty
                        <div>لا توجد مجموعات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section">
                <div class="exams-header">
                    <h3>مجوعات الصف الثالث</h3>
                    <a href="{{route('add_group_page', [3])}}" class="btn btn-success">إضافة مجموعة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($groups_3 as $group)
                    <a href="{{route("group", $group['id'])}}" class="exam-card">
                        <span>{{$group['name']}}</span>
                    </a>
                    @empty
                        <div>لا توجد مجموعات بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection


