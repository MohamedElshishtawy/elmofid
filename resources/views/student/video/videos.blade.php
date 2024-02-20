@extends('student.layout')

@section('title', 'مقاطع الفيديو')

@section('content')

    <table class="table  table-striped">
        <thead>
        <tr>
            <th colspan="4" class="text-center h4 cover">فيديوهات متاحة</th>
        </tr>
        <tr>
            <th class="text-center">عنوان الفيديو</th>
            <th class="text-center">مشاهدة</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($aveleble_videos as $aveleble_videos)
            <tr>
                <td class="text-center">


                    <a href="{{route('show_video' , $aveleble_videos['id'])}}">{{ $aveleble_videos->name }}</a>


                </td>
                <td class="text-center">


                    <a class="btn btn-success btn-sm"
                       href="{{route('show_video' , $aveleble_videos['id'])}}">مشاهدة</a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">لا يوجد فيديوهات لك الآن</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <br>
    <br>
    <br>

@endsection

