
@extends('student.layout')

@section('title', 'المذكرات')
@section('css')
<style>
    .input--file {
        position: relative;
        color: #7f7f7f;
    }



    .img img{
        width: 120px;
        height: 120px;
        border-radius: 10px;
        border: 1px dashed black;
        padding: 5px;
    }
    .img{
        text-align: center;
        margin: 30px;
        position: relative;
    }
    form {
        width: 80%;
        position: relative;
        right: 10%;
    }
</style>
@endsection
@section('content')


    <form action="{{route('save_account')}}" method="post" enctype="multipart/form-data" class="text-right my-5">
        @csrf

        <h2 class="text-center mt-4">حسابى</h2>

        <div class="img">

            @php( $img = \App\Models\Student::student_image(Auth::user()->id) ?? null )

            <img id="imgShow" src="{{ $img ? asset('storage/'.\App\Models\Student::student_image(Auth::user()->id) ) . '?'.time()  :  asset('images/icon/student.png')}}" alt="">
        </div>

        <div class="form-group">
            <label for="email">حدد صورة جيديدة</label>
            <input type="file" name="img" class="form-control" id="email">
        </div>

        <div class="form-group">
            <label for="email">الاسم</label>
            <input type="text" class="form-control" id="email" value="{{$student['name']}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">الكود</label>
            <input type="text" class="form-control" id="pwd" value="{{$student['code']}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">الرمز السري</label>
            <input type="text" class="form-control" id="pwd" value="{{$student['password']}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">رقم التليفون</label>
            <input type="text" class="form-control" id="pwd" value="{{$student['phone']}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">رقم ولى الأمر</label>
            <input type="text" class="form-control" id="pwd"  value="{{$student['parent_phone']}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">الصف الدراسى</label>
            <input type="text" class="form-control" id="pwd" value="{{\App\Models\Educater::class_human_read($student->groups->class)}}" disabled>
        </div>

        <div class="form-group">
            <label for="pwd">المجموعة</label>
            <input type="text" class="form-control" id="pwd" value="{{$student->groups->name}}" disabled>
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-success">حفظ الصورة</button>
        </div>


        <div class="text-left mt-5">
            <a href="{{route('logout')}}" class="btn btn-danger mt-3">تسجيل الخروج</a>
        </div>
    </form>



    <br>
    <br>
    <br>



@endsection

@section('js')

    <script src="{{asset("vendor/jquery-3.2.1.min.js")}}"></script>
    <script>
        $(document).on('change', 'input[type=file]', function () {
            // Use $(this) to refer to the specific file input that triggered the event
            const $this = $(this);


            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    $('#imgShow').attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

@endsection

