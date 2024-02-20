@extends('educator.layout.dashboard')

@php($active = 'groups')
@section('title', 'إدارة الطلاب')
@section('css_files')
    <link rel="stylesheet" href="{{ asset('css/educator/exams.css') }}">
    <link rel="stylesheet" href="{{ asset('css/educator/groups.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="window">
        <h1>الإدارة</h1>
        <section>
            <h2>تقارير المجموعة</h2>
            <table class="table mt-5">
                <tbody>
                    <tr>
                        <td>اسم المجموعة</td>
                        <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td>الصف</td>
                        <td>{{ $data['class'] }}</td>
                    </tr>
                    <tr>
                        <td>عدد المشتركين</td>
                        <td>{{ $data['payed'] }}</td>
                    </tr>
                    <tr>
                        <td>عدد غير المشتركين</td>
                        <td>{{ $data['n_payed'] }}</td>
                    </tr>
                    <tr>
                        <td>الإجمالى</td>
                        <td>{{ $data['total'] }}</td>
                    </tr>

                </tbody>
            </table>
        </section>
        <section>
            <h2>الطلاب</h2>
            <div>
                {{-- <button type="button" class="btn btn-primary print-btn print-2" id='printSecoundSeStudent'><i class="fa fa-print"></i> طباعة</button> --}}
            </div>
            <div class="mt-3 text-left">
                <a href="{{route('add_student_page', $data['group_id'])}}" class="btn btn-success btn-sm">إضافة طالب للمجموعة <i class="fa-solid fa-user-plus mr-1"></i> </a>
            </div>
            <div class="input-group mt-3">
                <input type="text" class="form-control search-2" id="search-2" placeholder="ابحث عما تريد في طلابك"aria-label="Recipient's username" aria-describedby="basic-addon2">
              </div>
            <table id="table-1" class="table mt-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الكود</th>
                        <th>الأسم</th>
                        <th>هاتف الطالب</th>
                        <th>هاتف ولى الأمر</th>
                        <th>الرمز</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                        <th>الأشتراك</th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)
                    @forelse ($students as $student)
                        <tr>
                            <td>{{$count++}}</td>
                            <td>{{ $student['code'] }}</td>
                            <td>{{ $student['name'] }}</td>
                            <td>{{ $student['phone'] }}</td>
                            <td>{{ $student['parent_phone'] }}</td>
                            <td>{{ $student['password'] }}</td>
                            <td><a class="btn btn-info" href="{{route('edit_student', [$data['group_id'],$student['id']])}}"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <form action="{{route('delete_student',[$data['group_id'],$student['id']])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" ><i class="fa fa-eraser"></i></button>
                                </form>
                            </td>
                            <td><input type="checkbox" {{$student['money']=='1'?'checked':''}} value="{{$student['id']}}" class="money" ></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                لا توجد طلاب بعد فى هذه المجموعة
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>



        </section>
    </div>

@endsection
