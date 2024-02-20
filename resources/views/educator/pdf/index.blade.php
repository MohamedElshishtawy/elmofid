


@extends('educator.layout.dashboard')

@php($active = 'pdf')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?3")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        <section>
            <h2>الكتب الإلكترونية</h2>

            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>مذكرات الصف الأول</h3>
                    <a href="{{route('add_pdf', [1])}}" class="btn btn-success">إضافة كتاب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($pdfs_1   as $pdf)
                    <div class="card-container">

                      @if (Str::startsWith($pdf['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $pdf['link'] }}" class="exam-card">
                            <span>{{$pdf['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $pdf['link']) }}" class="exam-card">
                              <span>{{$pdf['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_pdf', [1, $pdf['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>
                            <a href="{{route('edit_pdf', [1,$pdf['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد مذكرات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>مذكرات الصف الثانى</h3>
                    <a href="{{route('add_pdf', [2])}}" class="btn btn-success">إضافة كتاب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($pdfs_2 as $pdf)
                    <div class="card-container">
                      @if (Str::startsWith($pdf['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $pdf['link'] }}" class="exam-card">
                            <span>{{$pdf['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $pdf['link']) }}" class="exam-card">
                              <span>{{$pdf['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_pdf', [2, $pdf['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>

                            <a href="{{route('edit_pdf', [1,$pdf['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد مذكرات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>مذكرات الصف الثالث</h3>
                    <a href="{{route('add_pdf', [3])}}" class="btn btn-success">إضافة كتاب <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($pdfs_3 as $pdf)
                    <div class="card-container">
                      @if (Str::startsWith($pdf['link'], 'http'))
                        {{-- External URL --}}
                        <a href="{{ $pdf['link'] }}" class="exam-card">
                            <span>{{$pdf['name']}}</span>
                        </a>
                      @else
                          {{-- URL from storage --}}
                          <a href="{{ asset('storage/' . $pdf['link']) }}" class="exam-card">
                              <span>{{$pdf['name']}}</span>
                          </a>
                      @endif

                        <div class="f-icons">
                          <form  action="{{route('delete_pdf', [1, $pdf['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>
                            <a href="{{route('edit_pdf', [1,$pdf['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="#"><i class="fa-solid fa-chart-line fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد مذكرات بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
