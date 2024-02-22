


@extends('educator.layout.dashboard')

@php($active = 'homework')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?3")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?6")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        <section>
            <h2>الواجبات</h2>

            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>واجبات الصف الأول</h3>
                    <a href="{{route('add_homework', [1])}}" class="btn btn-success">إضافة واجب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($homeworks_1   as $homework)
                        <div class="card-container">
                            @php( $path = Str::startsWith($homework['link'], 'http') ? $homework['link'] : asset('storage/' . $homework['link']))

                                <div  class="exam-card">
                                    <img src="{{asset("images/icon/homework.png")}}">
                                    <span>{{$homework['name']}}</span>
                                </div>

                            <div class="f-icons">
                                <form  action="{{route('delete_homework', [1, $homework['id'] ] )}}" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                                </form>
                                <a href="{{route('edit_homework', [1,$homework['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                                <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                            </div>


                        </div>
                    @empty
                        <div>لا توجد واجبات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>واجبات الصف الثانى</h3>
                    <a href="{{route('add_homework', [2])}}" class="btn btn-success">إضافة واجب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($homeworks_2 as $homework)
                        <div class="card-container">
                           @php( $path = Str::startsWith($homework['link'], 'http') ? $homework['link'] : asset('storage/' . $homework['link']))

                                <div  class="exam-card">
                                    <img src="{{asset("images/icon/homework.png")}}">
                                    <span>{{$homework['name']}}</span>
                                </div>

                            <div class="f-icons">
                                <form  action="{{route('delete_homework', [2, $homework['id'] ] )}}" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                                </form>

                                <a href="{{route('edit_homework', [2,$homework['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                                <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                            </div>
                        </div>
                    @empty
                        <div>لا توجد واجبات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>واجبات الصف الثالث</h3>
                    <a href="{{route('add_homework', [3])}}" class="btn btn-success">إضافة واجب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($homeworks_3 as $homework)
                        <div class="card-container">
                          @php( $path = Str::startsWith($homework['link'], 'http') ? $homework['link'] : asset('storage/' . $homework['link']))

                                <div  class="exam-card">
                                    <img src="{{asset("images/icon/homework.png")}}">
                                    <span>{{$homework['name']}}</span>
                                </div>

                            <div class="f-icons">
                                <form  action="{{route('delete_homework', [1, $homework['id'] ] )}}" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                                </form>
                                <a href="{{route('edit_homework', [3,$homework['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                                <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                            </div>
                        </div>
                    @empty
                        <div>لا توجد واجبات بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
