@extends('educator.layout.dashboard')

@php($active = 'whitelists')
@section('title', 'التقيمات')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection
@section('content')

<div class="window">
    <h1>الإدارة</h1>

        <section>
            <h2>التقيمات</h2>
            <table class="table text-center mt-5">
                <thead>
                <tr>
                    <td>الترتيب</td>
                    <td>كود الطالب</td>
                    <td>اسم الطالب</td>
                    <td>المجموع</td>
                    <td>المجموعة</td>
                </tr>
                </thead>
                <tbody>
                @php($n=0)
                @forelse($students as $student)
                    <tr>
                        <td>{{++$n}}</td>
                        <td>{{$student->code}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->Total}}</td>
                        <td>{{$student->groupname}}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">لا توجد تقمات بعد</td></tr>
                @endforelse
                </tbody>
            </table>
        </section>

</div>


@endsection
