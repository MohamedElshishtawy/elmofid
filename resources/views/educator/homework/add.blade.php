@extends('educator.layout.dashboard')

@php($active = 'homework')
@section('title', 'إدارة الطلاب')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css?6")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection

@section('content')
    <form action="{{route('store_homework', [$class])}}"  class="form" method="post" enctype="multipart/form-data">
        @csrf

        <h2>إضافة واجب</h2>

        <div class="form-group mt-5">
            <label for="name">العنوان</label>
            <input type="text" class="form-control" id="code" name="name" placeholder="عنوان ليتمكن الطالب من تمييز الواجبات" value="{{old('name')}}" required>
            @error('name')
            <small class="form-text text-muted text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="form-group mt-5">
            <label for="description">الوصف</label>
            <textarea type="text" class="form-control" id="description" name="description" placeholder="الواجب المطلوب">{{old('description')}}</textarea>
            @error('description')
            <small class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="col-md">
            <div class="form-floating">
                <input type="file" name="homework" class="form-control" id="img">
                <label for="floatingSelectGrid">ملف على الجهاز</label>
            </div>
            @error('img')
            <small class="form-text text-muted text-danger">{{$message}}</small>
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



        <div class="text-center text-lg mt-5">
            <div class="switch-container">
                <div class="switch">
                    <input class="switch-input" name="availability" type="checkbox" id="degree_show" {{ old('availability') == 'on' ? 'checked' : '' }}>
                    <label class="switch-label" for="degree_show">مرئي للطلاب</label>
                    <br>

                </div>
                <label for="degree_show">مرئي للطلاب</label>
                @error('availability')
                <small class="txt-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>




        <button type="submit" class="btn btn-primary mt-5">تحميل</button>
    </form>



@endsection
