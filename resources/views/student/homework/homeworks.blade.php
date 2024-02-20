@extends('student.layout')

@section('title', 'الواجبات')

@section('content')

    <table class="table  table-striped">
        <thead>
        <tr>
            <th colspan="4" class="text-center h4 cover">الواجبات</th>
        </tr>
        <tr>
            <th class="text-center">عنوان الواجب</th>
            <th class="text-center">مشاهدة الواجب</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($aveleble_homeworks as $aveleble_homeworks)
            <tr>
                <td class="text-center">


                    <a href="{{route('show_homework' , $aveleble_homeworks['id'])}}">{{ $aveleble_homeworks->name }}</a>


                </td>
                <td class="text-center">


                    <a class="btn btn-success btn-sm"
                       href="{{route('show_homework' , $aveleble_homeworks['id'])}}">مشاهدة الواجب</a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">لا يوجد واجبات لك الآن</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <br>
    <br>
    <br>

@endsection

