@extends('educator.layout.dashboard')

@php($active = 'homework')
@section('title', 'إدارة الطلاب')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection
@section('content')
    <form action="{{route('save_edit_homework', [$class, $homework['id']])}}"  class="form" method="post" enctype="multipart/form-data">
        @csrf

        <h2>تعديل الواجب</h2>

        <div class="form-group mt-5">
            <label for="name">العنوان</label>
            <input type="text" class="form-control" id="code" name="name" placeholder="عنوان ليتمكن الطالب من تمييز المذكرات" value="{{old('name', $homework['name'])}}" required>
            @error('name')
            <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group mt-5">
            <label for="description">الوصف</label>
            <textarea type="text" class="form-control" id="description" name="description" placeholder="الواجب المطلوب">{{old('description', $homework['description'])}}</textarea>
            @error('description')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>


        <div class="form-group">
            <label for="name">صف المجموعة</label>
            <select name="class" class="form-control form-select" id="class" disabled>
                <option value="0">حدد الصف</option>
                <option value="1" {{old('class', $class)==1 ?'selected':''}}>الصف الأول</option>
                <option value="2" {{old('class', $class)==2 ?'selected':''}}>الصف الثانى</option>
                <option value="3" {{old('class', $class)==3 ?'selected':''}}>الصف الثالث</option>
            </select>
            @error('class')
            <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
        </div>


        <div class="form-check form-switch mt-3">
            <input class="form-check-input" name="availability" type="checkbox" id="flexSwitchCheckDefault" {{ old('avilability', $homework['availability']) == 'on' || old('avilability', $homework['availability']) == 1 ? 'checked' : '' }}>
            <label class="form-check-label mr-3" for="flexSwitchCheckDefault">مرئي للطلاب</label>
            @error('availability')
            <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary mt-5">تعديل</button>
    </form>



@endsection
