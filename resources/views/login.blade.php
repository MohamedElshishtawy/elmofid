<!DOCTYPE html>
<html lang="ar">
<head>
    <link rel="icon" href="{{asset('images/logo.jpg')}}">
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>المفيد فى الفيزياء | تسجيل الدخول</title>
    <link rel="stylesheet" href="{{asset("css/content/log.css?11")}}">
</head>
<body>

    <div class="container">
        <form action="{{route('auth')}}" method="post">

            @csrf
            <section>
                {{-- <img src="{{asset('images/logo.jpg')}}" alt=""> --}}
                <h1>المــفـيــد فــــي الفيــزيــــاء</h1>
                <small>أحمد حامد النمر</small>
                <div style="margin-top: -27px;">
                    <input type="text" name="code" id="code" placeholder="الكود" value="{{old('code')}}" autofocus>
                    @error('code')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="الرمز السرى" value="{{old('password')}}">
                    @error('password')
                        <div class="error">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <button>
                        تسجيل الدخول
                    </button>
                </div>
            </section>
        </form>

    </div>

</body>
</html>
