@extends('student.layout')

@section('title', 'المذكرات')
@section('content')

    <table class="table  table-striped">
        <thead>
        <tr>
            <th colspan="4" class="text-center h4 cover">مذكرات متاحة</th>
        </tr>
        <tr>
            <th class="text-center">عنوان الكتاب</th>
            <th class="text-center">تحميل</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($aveleble_pdfs as $aveleble_pfd)
            <tr>

                <td class="text-center">

                    @if (Str::startsWith($aveleble_pfd->link, 'http'))
                        {{-- External URL --}}
                        <a href="{{ $aveleble_pfd->link }}">{{ $aveleble_pfd->name }}</a>
                    @else
                        {{-- URL from storage --}}
                        <a href="{{ asset('storage/' . $aveleble_pfd->link) }}">{{ $aveleble_pfd->name }}</a>
                    @endif

                </td>
                <td class="text-center">

                    @if (Str::startsWith($aveleble_pfd->link, 'http'))
                        {{-- External URL --}}
                        <a class="btn btn-success btn-sm" href="{{ $aveleble_pfd->link }}">تحميل الكتاب</a>
                    @else
                        {{-- URL from storage --}}
                        <a class="btn btn-success btn-sm" href="{{ asset('storage/' . $aveleble_pfd->link) }}">تحميل الكتاب</a>
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">لا يوجد كتب لك الآن</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <br>
    <br>
    <br>

@endsection
