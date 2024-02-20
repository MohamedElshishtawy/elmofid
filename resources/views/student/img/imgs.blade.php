@extends('student.layout')

@section('title', 'صور الحصص')
@section('content')


    <table class="table  table-striped">
        <thead>
        <tr>
            <th colspan="4" class="text-center h4 cover">صور متاحة</th>
        </tr>
        <tr>
            <th class="text-center">عنوان الصورة</th>
            <th class="text-center">تحميل</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($aveleble_imgs as $aveleble_img)
            <tr>
                <td class="text-center">


                        <a href="{{ asset('storage/' . $aveleble_img['link']) }}">{{ $aveleble_img->name }}</a>


                </td>
                <td class="text-center">


                        <a class="btn btn-success btn-sm" href="{{ asset('storage/' . $aveleble_img['link']) }}">تحميل الصورة</a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">لا يوجد صور لك الآن</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <br>
    <br>
    <br>


@endsection
