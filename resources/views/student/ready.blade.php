<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بدء الإمتحان</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}">
    <link href="{{asset("vendor/fontawesome-free-6.5.1-web/css/all.min.css")}}" rel="stylesheet" media="all">
</head>
<body >


<div style="display: grid;gap:10px;
    justify-content: center;
    align-items: center;
    align-content: center;
    min-height: 100vh;">
    <img src="{{asset('images/ready.jpg')}}" alt="" style="width: 80%;
                                                            max-height: 84vh;
                                                            position: relative;
                                                            left: 10%;">

    <div class="text-center">
        <a href="{{route('do_exam', $exam['id'])}}" class="btn btn-primary">بدء</a>
    </div>
</div>



</body>
</html>
