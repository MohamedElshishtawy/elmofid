<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exams</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/exam.css?13') }}">
    <script>
        let Sdate = new Date("{{ \Carbon\Carbon::parse($start_time)->toISOString() }}")
        let durationInMinutes = @json($exam['duration'])
    </script>
</head>

<body dir="rtl">
    <form action="{{ route('save_answers', $exam['id']) }}" method="post">
        @csrf
        <input type="hidden" id="examId" value="{{$exam['id']}}">
        <div class="exam">
            {{-- START NAVIGATION --}}
            <nav>
                <div>{{ $exam['name'] }}</div>
                <div class="time-counter">
                    <div><span id="questionCounter">1</span>/{{ count($questions) }}</div>
                    <div>
                        <i class="fa fa-clock"></i>
                        <div>
                            <span id="h">00</span>:<span id="m">00</span>:<span id="s">00</span>
                        </div>
                    </div>
                </div>
            </nav>
            {{-- END NAVIGATION --}}

            {{-- START PROGRESS --}}
            <div class="progress">
                <div class="full">
                    <div class="bar"></div>
                </div>
            </div>
            {{-- END PROGRESS --}}

            {{-- START SIDEBAR --}}
            <div class="sidebar">
                <div class="questions">
                    <ul>
                        @for ($x = 1; $x <= count($questions); $x++)
                            <li link-question="{{ $x - 1 }}" class="question_link"><a href="#"
                                    class="" style="color: black; text-decoration: none;font-size: 16px;">السؤال
                                    {{ $x }}</a></li>
                        @endfor
                    </ul>
                </div>
                <div class="icons">
                    <ul>
                        <li><i class="fa-solid fa-maximize"></i></li>
                        <li><i class="fa-regular fa-calendar-days"></i></li>
                        <li><i class="fa-solid fa-compass"></i></li>
                    </ul>
                </div>
            </div>
            {{-- END SIDEBAR --}}

            {{-- START QUESTION --}}
            <div class="questions">
                @php($n = 0) {{-- Counter --}}
                @foreach ($questions as $question)
                    <div class="q-container" qustion-index="{{ $n }}">
                        <div class="deg">
                            <span>درجة السؤال: </span>
                            <span> {{$question['deg'] ?? 1}} </span>
                        </div>
                        <div class="question">{{ $question['q'] }}</div>

                        @if ($question['img'])
                            <div class="img-div">
                                <img src="{{ asset('storage/'.$question['img'].'?'.microtime(true)) }}"
                                alt="question">
                            </div>

                        @endif


                        <div class="answers">
                            <div class="answer answer1">
                                <input type="radio" value="a0" name="answers[{{ $n }}]"
                                    question-index="{{ $n }}" id="q1{{ $n }}">
                                <label for="q1{{ $n }}">{{ $question['a0'] }}</label>
                            </div>
                            <div class="answer answer1">
                                <input type="radio" value="a1" name="answers[{{ $n }}]"
                                    question-index="{{ $n }}" id="q2{{ $n }}">
                                <label for="q2{{ $n }}">{{ $question['a1'] }}</label>
                            </div>
                            <div class="answer answer1">
                                <input type="radio" value="a2" name="answers[{{ $n }}]"
                                    question-index="{{ $n }}" id="q3{{ $n }}">
                                <label for="q3{{ $n }}">{{ $question['a2'] }}</label>
                            </div>
                            <div class="answer answer1">
                                <input type="radio" value="a3" name="answers[{{ $n }}]"
                                    question-index="{{ $n }}" id="q4{{ $n }}">
                                <label for="q4{{ $n }}">{{ $question['a3'] }}</label>
                            </div>
                        </div>
                    </div>
                    @php($n++)
                @endforeach
            </div>
            {{-- END QUESTION --}}

            {{-- START BUTTONS --}}
            <div class="buttons">
                <div>
                    <div class="back" id="back"><i class="fa-solid fa-caret-right"></i></div>
                    <div class="next" id="next">التالى <i class="fa-solid fa-caret-left"></i></div>
                    <button type="submit" class="next" id="end" style="display: none" id="next">إنهاء الإمتحان
                    </button>

                </div>
            </div>
            {{-- END BUTTONS --}}
        </div>
    </form>

    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/student/exam.js?9') }}"></script>
    <script src="{{ asset('js/student/storage.js?8') }}"></script>
    <script src="{{ asset('js/student/timer.js?11') }}"></script>




</body>

</html>
