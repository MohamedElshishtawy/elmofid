@extends('educator.layout.dashboard')

@php($active = 'exams')
@section('title', 'إدارة')
@section('css_files')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/educator/add_exam.css?9') }}">
    <link rel="stylesheet" href="{{ asset('css/educator/exams.css?1') }}">
    <link rel="stylesheet" href="{{ asset('css/educator/groups.css?2') }}">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')

    <div class="window">
        <h1 class="text-center">إدراج إختبار</h1>
        <section>
            <form action="{{ route('save_exam', [$class, $exam_id]) }}" method="post">
                @csrf

                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <h2>معلومات عن الإختبار</h2>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="class"><i class="fa-solid fa-people-group"></i>الصف</label></td>
                            {{-- <td>
                            <select class="form-control" id="class" name="class">
                                <option value="0" {{old('class', $exam['class'])==0?'selected':''}}>حدد</option>
                                <option value="1" {{old('class', $exam['class'])==1?'selected':''}}>الصف الأول الثانوى</option>
                                <option value="2" {{old('class', $exam['class'])==2?'selected':''}}>الصف الثانى الثانوى</option>
                                <option value="3" {{old('class', $exam['class'])==3?'selected':''}}>الصف الثالث الثانوى</option>
                            </select>
                            @error('class')
                                <small class="txt-danger">{{$message}}</small>
                            @enderror
                        </td> --}}
                            <td>
                                {{ $class_human }}
                            </td>
                        </tr>

                        <tr>
                            <td><label class="exam-txt"> <i class="fa fa-stopwatch "></i> عدد الدقائق</label></td>
                            <td>
                                <input type="number" min="0" name="duration" id="exam_time"
                                    class="input input-num form-control" value="{{ old('duration', $exam['duration']) }}">
                                @error('duration')
                                    <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label class="exam-txt"> <i class="fa fa-stopwatch "></i> الفترة المتاحة</label>
                            </td>
                            <td>
                                <label for="start_date">من</label>
                                <input type="datetime-local" name="start_date" id="start_date"
                                    class="date-input form-control" value="{{ old('start_date', $exam['start_date']) }}">
                                @error('start_date')
                                    <small class="txt-danger">{{ $message }}</small>
                                @enderror
                                <label for="end_date">الى</label>
                                <input type="datetime-local" name="end_date" id="end_date" class="date-input form-control"
                                    value="{{ old('end_date', $exam['end_date']) }}">
                                @error('end_date')
                                    <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="exam-txt"> <i class="fa fa-edit"></i> عنوان الامتحان</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="exam_name" class="input form-control"
                                    placeholder="عنوان ليتمكن طلابك من معرفة محتوي الامتحان"
                                    value="{{ old('name', $exam['name']) }}">
                                @error('name')
                                    <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            {{-- <td>
                                <input type="checkbox" name="random_order" id="randomOrder" class="from-control"
                                    {{ old('random_order', $exam['random_order']) == '1' ? 'checked' : '' }}>
                                <label for="randomOrder">ترتيب الأسئلة عشوائى</label>
                                <br>
                                @error('random_order')
                                    <small class="txt-danger">{{ $message }}</small>
                                @enderror
                            </td> --}}
                            <td colspan="2" class="text-center text-lg">
                                <div class="switch-container">
                                    <div class="switch">
                                        <input type="checkbox" name="show_deg" id="degree_show" class="switch-input"
                                            {{ old('show_deg', $exam['show_deg']) == '1' ? 'checked' : '' }}>
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
                                            {{ old('availability', $exam['availability']) == '1' ? 'checked' : '' }}>
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
                    </tbody>
                </table>
                <button type="submit" class="btn btn-info add-ex-btn">
                    <i class="fa fa-edit"></i> تعديل
                </button>
            </form>
        </section>


        <section>
            <form action="{{ route('new_save', [$class, $exam_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h2 class="mt-4">الإختبار</h2>
                <ol class="counter-ol mt-4" id="ExamOL">
                    @if ($exam_questions)
                        @php($n = 0)
                        @foreach ($exam_questions as $q)
                            <li class="q-num" id="h{{ $n }}">
                                <div class="qus-div" id="qusDiv{{ $n }}">

                                    <div id="degDiv{{$n}}" class="deg-container">
                                        <label for="degInput{{$n}}" class="deg-label">درجة السؤال: </label>
                                        <input type="number" class="form-control" id="degInput{{$n}}" value="{{ $q['deg'] ?? 1 }}" name="deg[]" />
                                    </div>

                                    <textarea type="text" class="form-control q-input" id="exInput{{ $n }}" placeholder="ضع هنا السؤال"
                                        name="q[]">{{ $q['q'] }}</textarea>

                                    <div class="img-div">
                                        @if ($q['img'])
                                            <input type="hidden" class="file-input form-control"
                                                id="imgH{{ $n }}" value="{{ $q['img'] }}"
                                                name="img[]">

                                            <input type="file" class="file-input form-control d-none"
                                                id="img{{ $n }}" value="" name="img[]">

                                            <img id="img_{{ $n }}"
                                                src="{{ asset('storage/' . $q['img'] . '?' . microtime(true)) }}"
                                                alt="question">
                                        @else
                                            <input type="file" class="file-input form-control"
                                                id="img{{ $n }}" name="img[]">

                                            <input type="hidden" class="file-input form-control"
                                                id="imgH{{ $n }}" value="" name="img[]">
                                        @endif

                                        <div class="btn btn-danger btn-sm remove-img" id="removeImg{{ $n }}"
                                            for-img="img_{{ $n }}"><i class="fa-solid fa-xmark"></i></div>

                                    </div>

                                    <div id="ansDiv{{ $n }}0" class="ans-div">
                                        <input type="radio" class="rd-input" usage="trueAns"
                                            id="radio{{ $n }}0" name="at[{{ $n }}]"
                                            value="a0" {{ $q['at'] == 'a0' ? 'checked' : '' }}>
                                        <input type="text" class="form-control a-input"
                                            id="exInput{{ $n }}_ans0" name="a0[]"
                                            value="{{ $q['a0'] }}">
                                    </div>

                                    <div id="ansDiv{{ $n }}1" class="ans-div">
                                        <input type="radio" class="rd-input" usage="trueAns"
                                            id="radio{{ $n }}1" name="at[{{ $n }}]"
                                            value="a1" {{ $q['at'] == 'a1' ? 'checked' : '' }}>
                                        <input type="text" class="form-control a-input"
                                            id="exInput{{ $n }}_ans1" name="a1[]"
                                            value="{{ $q['a1'] }}">
                                    </div>

                                    <div id="ansDiv{{ $n }}2" class="ans-div">
                                        <input type="radio" class="rd-input" usage="trueAns"
                                            id="radio{{ $n }}2" name="at[{{ $n }}]"
                                            value="a2" {{ $q['at'] == 'a2' ? 'checked' : '' }}>
                                        <input type="text" class="form-control a-input"
                                            id="exInput{{ $n }}_ans2" name="a2[]"
                                            value="{{ $q['a2'] }}">
                                    </div>

                                    <div id="ansDiv{{ $n }}3" class="ans-div">
                                        <input type="radio" class="rd-input" usage="trueAns"
                                            id="radio{{ $n }}3" name="at[{{ $n }}]"
                                            value="a3" {{ $q['at'] == 'a3' ? 'checked' : '' }}>
                                        <input type="text" class="form-control a-input"
                                            id="exInput{{ $n }}_ans3" name="a3[]"
                                            value="{{ $q['a3'] }}">
                                    </div>

                                    <textarea type="text" class="form-control observ-input" id="observInput{{ $n }}"
                                        placeholder="ضع ملحوظتك علي السؤال" name="obs[]">{{ $q['obs'] }}</textarea>



                                    <div class="img-div">

                                        @if ($q['obsImg'])
                                            <input type="hidden" class="file-input form-control"
                                                id="obsImgH{{ $n }}" value="{{ $q['obsImg'] }}"
                                                name="obsImg[]">

                                            <input type="file" class="file-input form-control d-none"
                                                id="obsImg{{ $n }}" value="" name="obsImg[]">

                                            <img id="obs_{{ $n }}"
                                                src="{{ asset('storage/' . $q['obsImg'] . '?' . microtime(true)) }}"
                                                alt="question">
                                        @else
                                            <input type="file" class="file-input form-control"
                                                id="obsImg{{ $n }}" name="obsImg[]">

                                            <input type="hidden" class="file-input form-control"
                                                id="obsImgH{{ $n }}" value="" name="obsImg[]">
                                        @endif

                                        <div class="btn btn-danger btn-sm remove-img" id="removeObs{{ $n }}"
                                            for-img="obs_{{ $n }}"><i class="fa-solid fa-xmark"></i></div>

                                    </div>

                                    <button class="btn btn-danger delete-question" type="button" id="delete0"
                                        for-question="{{ $n }}">delete</button>

                                </div>
                            </li>
                            @php($n++)
                        @endforeach
                    @endif
                </ol>
                <div class="btn-div">
                    <div class="btn btn-success add-qustion" id="addQustion">
                        <i class="fa fa-plus"></i>
                        أضف سؤالا
                    </div>
                    <span class="badge"><input type="number" min="0" value="1" class="num-of-qus-inp"
                            id="numOFq"></span>
                </div>

                <button type="submit" class="btn btn-primary add-ex-btn mt-5 " id="end" name="images_uplaod">
                    <i class="fa fa-upload"></i> حفظ
                </button>
            </form>
        </section>

    </div>
    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/educator/add_exam.js?29') }}"></script>
    <script src="{{ asset('js/educator/save_exam.js?29') }}"></script>
@endsection
