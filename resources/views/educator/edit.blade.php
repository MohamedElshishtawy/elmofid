@extends('educator.layout.dashboard')

@php($active = 'groups')
@section('title', 'إدارة الطلاب')
@section('css_files')
    <link rel="stylesheet" href="{{asset("css/educator/exams.css")}}">
    <link rel="stylesheet" href="{{asset("css/educator/groups.css")}}">
    <link rel="stylesheet" href="{{asset("css/content/form.css")}}">
@endsection
@section('content')
    <form action="{{route('edit_student_store', [$student['groups_id'], $student['id']])}}" class="form" method="post">
        @csrf

        <h2>إضافة طالب</h2>

        <div class="form-group">
            <label for="code">كود الطالب</label>
          <input type="text" class="form-control" id="code" name="code" placeholder="أكتب الكود" value="{{old('code' ,$student['code'])}}" required>
          @error('code')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="name">اسم الطالب</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أكتب الاسم" value="{{old('name' ,$student['name'])}}" >
          @error('name')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="phone">هاتف الطالب</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="أكتب الرقم" value="{{old('phone' ,$student['phone'])}}" >
          @error('phone')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="parent_phone">هاتف ولى لاأمر</label>
          <input type="text" class="form-control" id="parent_phone" name="parent_phone" value="{{old('parent_phone' ,$student['parent_phone'])}}" placeholder="أكتب رقم ولى الأمر (إختيارى)">
          @error('parent_phone')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="email">الإميل</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="أكتب الإميل "  value="{{old('email' ,$student['email'])}}">
          @error('email')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="password">الباسورد</label>
          <input type="text" class="form-control" id="password" name="password" placeholder="أكتب الباسورد"  value="{{old('password' ,$student['password'])}}"required>
          @error('password')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>



        {{-- <div>
            <div class="form-group">
                <label for="class">الصف</label>
                <select name="class" class="form-control form-select" id="class">
                    <option value="0">حدد الصف</option>
                    <option value="1" {{$_class == 1 ? 'selected' : ''}}>الصف الأول</option>
                    <option value="2" {{$_class == 2 ? 'selected' : ''}}>الصف الثانى</option>
                    <option value="3" {{$_class == 3 ? 'selected' : ''}}>الصف الثالث</option>
                </select>
                @error('_class')
                    <small class="form-text text-muted text-danger">{{$message}}</small>
                @enderror
            </div> --}}



            {{-- <div class="form-group">
                <label for="group">المجموعة</label>
                <select name="group" class="form-control form-select" id="group">
                    @forelse ($groups as $group_)
                        <option value="{{$group_->id}}" {{$group->id == $group_->id ? 'selected': ''}} >{{$group_->name}}</option>
                    @empty
                        <option value="0">إختر المجموعة</option>
                    @endforelse
                </select>
                @error('group')
                    <small class="form-text text-muted text-danger">{{$message}}</small>
                @enderror
            </div> --}}

            <div>
                <div class="form-group">
                    <label for="class">الصف : {{$class_human}}</label>
                </div>
            </div>






        <div class="form-group">
            <label for="money">الدفع</label>
          <input type="checkbox" class="form-control" id="money" name="money" {{$student['money'] == 1 ? 'checked' : '' }} >
          @error('money')
            <small class="form-text text-muted text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">حفظ التعديل</button>
      </form>



@endsection
