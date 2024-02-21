@extends('student.layout')

@section('title', 'التقيمات')

@section('css')
    <link rel="stylesheet" href="{{asset('css/student/rank.css?1')}}">
@endsection
@section('content')

    <div class="rank-container">
        <div class="img-container">
            <x-account_img />
        </div>
        <table class="table text-center">
            <tbody>
            <tr>
                <td>اسم الطالب</td>
                <td>{{$student->name}}</td>
            </tr>
            <tr>
                <td>عدد الإمتحانات</td>
                <td>{{$student->exams}}</td>
            </tr>
            <tr>
                <td>عدد النقاط</td>
                <td>{{$student->points}}</td>
            </tr>
            <tr>
                <td>الترتيبك</td>
                <td>{{$student->student_order}}</td>
            </tr>
            </tbody>
        </table>
        <img src="{{asset('images/icon/cup.png')}}" alt="">
    </div>
    <table class="table  table-striped">
        <thead>
            <tr>
                <th colspan="4" class="text-center h4 cover">إختبارات مجتازة</th>
            </tr>
            <tr>
                <th class="text-center">اسم الإختبار</th>
                <th class="text-center">الدرجة</th>
                <th class="text-center">مدة الحل</th>
                <th class="text-center">مراجعة</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($exams as $exam)
                <tr>
                    <td class="text-center">
                        <span>{{ $exam->exams->name }}</span>
                    </td>
                    <td class="text-center">
                        {{$exam->exams->show_deg == 1 ? $exam->degree : 'ليس متاح'}}
                    </td>
                    <td class="text-center">
                        @if ($exam->exams->show_deg == 1 )
                            {{$exam->duration}} دقيقة
                        @else
                            <span>ليس متاح</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($exam->exams->show_deg == 1 )
                            <a href="{{route('show_exam',$exam->exams_id)}}">مراجعة</a>
                        @else
                            <span>ليس متاح</span>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">إجتهد وحل إمتحانات اكثر لتقيم نفسك</td>
                </tr>
            @endforelse


        </tbody>
    </table>

    <br>
    <br>
    <br>


@endsection
