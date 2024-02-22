


@extends('educator.layout.dashboard')

@php($active = 'videos')
@section('title', 'إدارة')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css?3")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?6")}}">
@endsection
@section('content')

    <div class="window">
        <h1>الإدارة</h1>

        <section>
            <h2>مقاطع الفيديو</h2>

            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>فيديوهات الصف الأول</h3>
                    <a href="{{route('add_video', [1])}}" class="btn btn-success">إضافة فيديو <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($videos_1   as $video)
                    <div class="card-container">
                        @php( $path = Str::startsWith($video['link'], 'http') ? $video['link'] : asset('storage/' . $video['link']))

                        <div  class="exam-card">
                            <img src="{{asset("images/icon/video_icon.png")}}">
                            <span>{{$video['name']}}</span>
                        </div>

                        <div class="f-icons">
                          <form  action="{{route('delete_video', [1, $video['id'] ] )}}" method="post">
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                          </form>
                            <a href="{{route('edit_video', [1,$video['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                            <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                        </div>
                    </div>
                    @empty
                        <div>لا توجد فيديوهات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>فيديوهات الصف الثانى</h3>
                    <a href="{{route('add_video', [2])}}" class="btn btn-success">إضافة فيديو <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($videos_2 as $video)
                        <div class="card-container">
                            @php( $path = Str::startsWith($video['link'], 'http') ? $video['link'] : asset('storage/' . $video['link']))

                            <div  class="exam-card">
                                <img src="{{asset("images/icon/video_icon.png")}}">
                                <span>{{$video['name']}}</span>
                            </div>

                            <div class="f-icons">
                                <form  action="{{route('delete_video', [2, $video['id'] ] )}}" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                                </form>
                                <a href="{{route('edit_video', [2,$video['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                                <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                            </div>
                        </div>
                    @empty
                        <div>لا توجد فيديوهات بعد</div>
                    @endforelse
                </div>
            </div>
            <div class="exam-section mt-5">
                <div class="exams-header">
                    <h3>فيديوهات الصف الثالث</h3>
                    <a href="{{route('add_video', [3])}}" class="btn btn-success">إضافة فيديو <i class="fa fa-plus"></i></a>
                </div>
                <div class="exams">
                    @forelse ($videos_3 as $video)
                        <div class="card-container">
                            @php( $path = Str::startsWith($video['link'], 'http') ? $video['link'] : asset('storage/' . $video['link']))

                            <div  class="exam-card">
                                <img src="{{asset("images/icon/video_icon.png")}}">
                                <span>{{$video['name']}}</span>
                            </div>

                            <div class="f-icons">
                                <form  action="{{route('delete_video', [3, $video['id'] ] )}}" method="post">
                                    @csrf
                                    <button type="submit"><i class="fa-solid fa-trash fa-lg fa-fw"></i></button>
                                </form>
                                <a href="{{route('edit_video', [3,$video['id']])}}"><i class="fa-solid fa-pen-to-square fa-fw fa-lg"></i></a>
                                <a href="{{$path}}"><i class="fa-solid fa-eye fa-fw fa-lg"></i></a>
                            </div>
                        </div>
                    @empty
                        <div>لا توجد فيديوهات بعد</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
