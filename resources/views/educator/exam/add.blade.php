

@extends('educator.layout.dashboard')

@php($active = 'exams')
@section('title', 'إدارة')
@section('css_files')


    <link rel="stylesheet" href="{{asset("css/educator/groups.css?6")}}">


@endsection
@section('content')

<div class="window">
    <h1 class="text-center">إدراج إختبار</h1>
    <section>
        <form action="{{route('saveData', $class)}}" method="POST">
            @csrf
            <h2>معلومات عن الإختبار</h2>
            <table class="table">
                <tbody>

                    <tr>
                        <td><label for="class" ><i class="fa-solid fa-people-group"></i>  حدد الصف</label></td>
                        {{-- <td>
                            <select class="form-control" id="class" name="class">
                                <option value="0" {{old('class')==0?'selected':''}}>حدد</option>
                                <option value="1" {{old('class')==1?'selected':''}}>الصف الأول الثانوى</option>
                                <option value="2" {{old('class')==2?'selected':''}}>الصف الثانى الثانوى</option>
                                <option value="3" {{old('class')==3?'selected':''}}>الصف الثالث الثانوى</option>
                            </select>
                            @error('class')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                        </td> --}}
                        <td>
                            {{$class_human}}
                        </td>
                    </tr>

                    <tr>
                        <td><label class="exam-txt"> <i class="fa fa-stopwatch "></i> عدد الدقائق</label></td>
                        <td>
                            <input type="number" min="0" name="duration" id="exam_time" class="input input-num form-control" value="{{old('duration', 0)}}">
                            @error('duration')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="exam-txt"> <i class="fa fa-stopwatch "></i> الفترة المتاحة</label>
                        </td>
                        <td>
                            <label for="start_date">من</label>
                            <input type="datetime-local" name="start_date" id="start_date" class="date-input form-control" value="{{old('start_date')}}">
                            @error('start_date')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                            <label for="end_date">الى</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="date-input form-control" value="{{old('end_date')}}">
                            @error('end_date')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="exam-txt"> <i class="fa fa-edit"></i> عنوان الامتحان</label>
                        </td>
                        <td>
                            <input type="text" name="name" id="exam_name" class="input form-control" placeholder="عنوان ليتمكن طلابك من معرفة محتوي الامتحان" value="{{old('name')}}">
                            @error('name')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        {{-- <td>
                            <input type="checkbox" name="random_order" id="randomOrder" class="from-control"
                            {{ old('random_order') == 'on' ? 'checked' : '' }}>
                            <label for="randomOrder">ترتيب الأسئلة عشوائى</label >
                            <br>
                            @error('random_order')
                            <small class="txt-danger">{{ $message }}</small>
                            @enderror
                        </td> --}}
                        <td colspan="2" class="text-center text-lg">
                            <div class="switch-container">
                                <div class="switch">
                                    <input type="checkbox" name="show_deg" id="degree_show" class="switch-input"
                                        {{ old('show_deg') == '1' ? 'checked' : '' }}>
                                    <label class="switch-label" for="degree_show">ظهور الدرجات</label>
                                    <br>

                                </div>
                                <label for="degree_show">ظهور الدرجات</label>
                                @error('show_deg')
                                <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center text-lg">
                            <div class="switch-container">
                                <div class="switch">
                                    <input type="checkbox" name="availability" id="availability" class="switch-input"
                                        {{ old('availability') == '1' ? 'checked' : '' }}>
                                    <label class="switch-label" for="availability">مرئى للطلاب</label>
                                    <br>

                                </div>
                                <label for="availability">مرئى للطلاب</label>
                                @error('availability')
                                <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-success">إدراج إختبار</button>
            </div>
        </form>
    </section>

</div>
@endsection
