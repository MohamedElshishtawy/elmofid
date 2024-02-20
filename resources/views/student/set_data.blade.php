<!DOCTYPE html>
<html lang="ar">
<head>
    <link rel="icon" href="{{asset('images/logo.jpg')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الطلاب</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}">
    <link href="{{asset("vendor/fontawesome-free-6.5.1-web/css/all.min.css")}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('css/student/form.css')}}">
    @yield('css')
</head>
<body dir="rtl" style="background-image: linear-gradient(64deg, #000, #1600d0);">
    <h1 class="text-center mt-5" style="color: white">منصة المفيد فى الفيزياء</h1>

    <form action="{{route('save_data',$student_id)}}" class="my-4" method="post">
        @csrf
        <h2 class="text-center mt-4">بيانات الطالب</h2>
        <div class="mt-4">
            <span>كود الطالب: </span><span>{{$student_code}}</span>
        </div>

        <div class="mt-4">
            <span>مجموعة الطالب: </span><span>{{$student_group}}</span>
        </div>



        <div class="filed mt-4">
            <label for="name">الاسم ثلاثى</label>
            <input type="text" name="name" placeholder="الاسم باللغة العربية" value="{{old('name', $student_name)}}" class="form-control mt-1" required>
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="filed mt-4">
            <label for="phone">التليفون</label>
            <input type="text" name="phone" placeholder="رقم تلفون الخاص بك بالإنجليزية" value="{{old('phone')}}" class="form-control mt-1" required>
            @error('phone')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="filed mt-4">
            <label for="parent_phone">تلفون ولى الأمر</label>
            <input type="text" name="parent_phone" placeholder="رقم ولى الأمر بالإنجليزية" value="{{old('parent_phone')}}" class="form-control mt-1">
            @error('parent_phone')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="filed mt-4">
            <label for="email">الإميل (إختيارى)</label>
            <input type="text" name="email" placeholder="إيميل جوجل أو الموحد (إختيارى)" value="{{old('email')}}" class="form-control mt-1">
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        <br>
        <br>

        <h3>تعليمات: </h3>
        <ol>
          <li>تأكد من كتابة اسمك باللغة العربية</li>
          <li>تأكد من كتابة رقمك ورقم ولى الأمر بالإنجليزية و  دون مسافات ودون نسخ</li>
          <li>تأكد من كتابة بياناتك بصورة صحيحة</li>
          <li>فى حالة وجود اى مشكلة (خد اسكين) و توجه للدعم الفنى</li>
        </ol>

        <div class="text-center mt-5">
            <button class="btn btn-success btn-lg" type="submit">حفظ</button>
        </div>
    </form>


</body>
</html>
