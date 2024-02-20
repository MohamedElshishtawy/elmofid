


@extends('educator.layout.dashboard')

@php($active = 'imgs')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?3")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        <section>
            <h2>صور الحصص</h2>

            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>صور حصص الصف الأول</h3>
                    <a href="{{route('add_img', [1])}}" class="btn btn-success">إضافة صورة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($imgs_1   as $img)
                    <div class="card-container">

                      @if (Str::startsWith($img['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $img['link'] }}" class="exam-card">
                            <span>{{$img['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $img['link']) }}" class="exam-card">
                              <span>{{$img['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_img', [1, $img['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>
                            <a href="{{route('edit_img', [1,$img['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد صور حصص بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>صور حصص الصف الثانى</h3>
                    <a href="{{route('add_img', [2])}}" class="btn btn-success">إضافة صورة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($imgs_2 as $img)
                    <div class="card-container">
                      @if (Str::startsWith($img['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $img['link'] }}" class="exam-card">
                            <span>{{$img['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $img['link']) }}" class="exam-card">
                              <span>{{$img['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_img', [2, $img['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>

                            <a href="{{route('edit_img', [1,$img['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد صور حصص بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>صور حصص الصف الثالث</h3>
                    <a href="{{route('add_img', [3])}}" class="btn btn-success">إضافة صورة <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($imgs_3 as $img)
                    <div class="card-container">
                      @if (Str::startsWith($img['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $img['link'] }}" class="exam-card">
                            <span>{{$img['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $img['link']) }}" class="exam-card">
                              <span>{{$img['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_img', [1, $img['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>
                            <a href="{{route('edit_img', [1,$img['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد صور الحصص بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
