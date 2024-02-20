@extends('student.layout')

@section('title', 'التقيمات')
@section('content')


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
