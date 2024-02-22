@extends('educator.layout.dashboard')

@php($active = 'groups')
@section('title', 'إدارة المجموعات')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?6")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection
@section('content')
    <form action="{{route('add_group_store', [$class])}}" class="form" method="post">
        @csrf
        <h2>إضافة مجموعة</h2>

        <div class="form-group">
            <label for="name">اسم المجموعة</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أكتب الاسم">
          @error('name')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>

        <div class="form-group">
            <label for="name">صف المجموعة</label>
            <select name="class" class="form-control form-select" id="class">
                <option value="0">حدد الصف</option>
                <option value="1" {{$class==1 ?'selected':''}}>الصف الأول</option>
                <option value="2" {{$class==2 ?'selected':''}}>الصف الثانى</option>
                <option value="3" {{$class==3 ?'selected':''}}>الصف الثالث</option>
            </select>
          @error('class')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">إضافة</button>
      </form>
@endsection
