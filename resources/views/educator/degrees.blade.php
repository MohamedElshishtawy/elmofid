


@extends('educator.layout.dashboard')

@php($active = 'exams')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?2")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        <section>
            <h2>{{$exam_name}}</h2>
            <div class="text-left mb-4">
                <a href="{{route('download_excel', [$exam_id ])}}" class="btn btn-success">Excel</a>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الكود</th>
                        <th>اسم الطالب</th>
                        <th>الدرجة</th>
                        <th>مدة الإختبار</th>
                        <th>إنتهاء</th>
                        <th>الحل</th>
                    </tr>
                </thead>
                <tbody>
                    @php($n=0)
                    @forelse ($degrees as $degree)
                        <tr>
                            <td>{{++$n}}</td>
                            <td>{{$degree->code}}</td>
                            <td>{{$degree->name}}</td>
                            <td>{{$degree->degree}}</td>
                            <td>{{$degree->duration}} دقيقة </td>
                            <td>{{$degree->created_at}}</td>
                            <td><a href="{{route('educater_show_exam',[$exam_id ,$degree->students_id])}}"><i class="fa-solid fa-file-circle-check fa-xl fa-fw"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">لم يمتحن احد بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection


