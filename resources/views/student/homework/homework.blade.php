@extends('student.layout')

@section('title', 'الواجبات')

@section('css')
    <link href="{{asset("css/student/video.css")}}" rel="stylesheet" media="all">
@endsection
@section('content')


    <div class="video-container">
        <div class="video-div">
            <h2 class="text-right">{{$homework['name']}}</h2>
            <p class="text-right">{{$homework['description']}}</p>
        </div>
    </div>

@endsection
