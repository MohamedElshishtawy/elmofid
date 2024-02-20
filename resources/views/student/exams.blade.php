@extends('student.layout')

@section('title', 'الإختبارات')
@section('content')


    <table class="table  table-striped">
        <thead>
            <tr>
                <th colspan="4" class="text-center h4 cover">إختبارات متاحة</th>
            </tr>
            <tr>
                <th class="text-center">اسم الإختبار</th>
                <th class="text-center">دخول</th>
                <th class="text-center">متاح من</th>
                <th class="text-center">الى</th>
            </tr>
        </thead>
        <tbody>


            @forelse ($aveleble_exams as $aveleble_exam)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('ready', $aveleble_exam->id) }}">{{ $aveleble_exam->name }}</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-success btn-sm" href="{{ route('ready', $aveleble_exam->id) }}">بدء الإختبار</a>
                    </td>
                    <td class="text-center">{{ $aveleble_exam->start_date }}</td>
                    <td class="text-center">{{ $aveleble_exam->end_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">لا يوجد امتحانات لك الآن</td>
                </tr>
            @endforelse


        </tbody>
    </table>

    <table class="table  table-striped my-5">
        <thead>
            <tr>
                <th colspan="4" class="text-center h4 cover">إختبارات سابقة</th>
            </tr>
            <tr>
                <th class="text-center">اسم الإختبار</th>
                <th class="text-center">دخول</th>
            </tr>
        </thead>
        <tbody>


            @forelse ($pased_exams as $pased_exam)
                <tr>
                    <td class="text-center"><a class="" href="{{route('study_exam' ,$pased_exam->id)}}">{{$pased_exam->name}}</a>
                    </td>
                    <td class="text-center"><a class="btn btn-success btn-sm" href="{{route('study_exam' ,$pased_exam->id)}}">مذاكرة</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">' . 'لا يوجد امتحانات سابقة' . '</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <br>
    <br>


@endsection
