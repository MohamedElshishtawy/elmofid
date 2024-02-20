


@extends('educator.layout.dashboard')

@php($active = 'exams')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?5")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?5")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        {{-- <section>
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
        </section> --}}

        <section>
            <h2>الإختبارات</h2>

            <div class="exam-section">
                <div class="exams-header">
                    <h3>إختبارات الصف الأول</h3>
                    <a href="{{route('add_exam', [1])}}" class="btn btn-success">إضافة إختبار <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($exams_1   as $exam)
                    <div class="card-container">
                        <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}" class="exam-card">
                            <span><img src="{{asset('images/icon/exam_icon.png')}}" alt=""></span>
                            <span>{{$exam['name']}}</span>
                            <span><i class="fa fa-eye fa-fw"></i> {{\App\Models\Degree::where('exams_id', $exam['id'])->count()}}</span>
                        </a>
                        <div class="f-icons">
                            <form action="{{ route('delete_exam', [1, $exam['id']] ) }}" method="post">
                                @csrf
                                <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                            </form>
                            <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="{{route('degrees_page', $exam['id'])}}"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد إختبارات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>إختبارات الصف الثانى</h3>
                    <a href="{{route('add_exam', [2])}}" class="btn btn-success">إضافة إختبار <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($exams_2 as $exam)
                    <div class="card-container">
                        <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}" class="exam-card">
                            <span><img src="{{asset('images/icon/exam_icon.png')}}" alt=""></span>
                            <span>{{$exam['name']}}</span>
                            <span><i class="fa fa-eye fa-fw"></i> {{\App\Models\Degree::where('exams_id', $exam['id'])->count()}}</span>
                        </a>
                        <div class="f-icons">
                            <form action="{{ route('delete_exam', [2, $exam['id']] ) }}" method="post">
                                @csrf
                                <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                            </form>
                            <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="{{route('degrees_page', $exam['id'])}}"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد إختبارات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>إختبارات الصف الثالث</h3>
                    <a href="{{route('add_exam', [3])}}" class="btn btn-success">إضافة إختبار <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($exams_3 as $exam)
                    <div class="card-container">
                        <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}" class="exam-card">
                            <span><img src="{{asset('images/icon/exam_icon.png')}}" alt=""></span>
                            <span>{{$exam['name']}}</span>
                            <span><i class="fa fa-eye fa-fw"></i> {{\App\Models\Degree::where('exams_id', $exam['id'])->count()}}</span>
                        </a>
                        <div class="f-icons">
                            <form action="{{ route('delete_exam', [3, $exam['id']] ) }}" method="post">
                                @csrf
                                <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                            </form>
                            <a href="{{route("edit_exam_page", [$exam['class'], $exam['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="{{route('degrees_page', $exam['id'])}}"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد إختبارات بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection


