@extends('student.layout')

@section('title', 'مقاطع الفيديو')

@section('css')
    <link href="{{asset("css/student/video.css")}}" rel="stylesheet" media="all">
@endsection
@section('content')


    <div class="video-container">
        <div class="video-div">


            <iframe width="560" height="315" src="{{$video['link'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

            <h2>{{$video['name']}}</h2>
        </div>
    </div>

@endsection
