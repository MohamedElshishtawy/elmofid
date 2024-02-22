@extends('student.layout')

@section('title', 'الواجبات')

@section('css')
    <link href="{{asset("css/student/video.css")}}" rel="stylesheet" media="all">
@endsection
@section('content')


    <div class="video-container mt-5">
        <div class="video-div">
            <h2 class="text-right">{{$homework['name']}}</h2>
            <p class="text-right">{{$homework['description']}}</p>

            @if($homework['link'])
                @php
                    $extension = pathinfo($homework['link'], PATHINFO_EXTENSION);
                @endphp

                @if(strtolower($extension) === 'pdf')
                    {{-- If it's a PDF, use iframe --}}
                    <iframe src="{{asset('storage/'.$homework['link'])}}" frameborder="0"></iframe>
                @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                    {{-- If it's an image, use img tag --}}
                    <img src="{{asset('storage/'.$homework['link']) }}" alt="Homework Image" style="border-radius: 10px">
                @else
                    {{-- Add more conditions for other file types if needed --}}
                    <p>Unsupported file type</p>
                @endif
            @endif
        </div>
    </div>


@endsection
