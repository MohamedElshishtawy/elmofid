<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exams</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student/exam.css?7') }}">

</head>

<body dir="rtl">
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
                        <li link-question="{{ $x - 1 }}" class="question_link"><a href="#" class=""
                                style="color: black; text-decoration: none;font-size: 16px;">السؤال
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

                    @if ( $question['img'] )

                            <div class="img-div">
                                <img
                                    src="{{ asset('storage/'.$question['img'].'?'.microtime(true)) }}"
                                    alt="question">
                            </div>
                    @endif

                    @if ($question['at'] == ( $answers[$n] ?? $answers[$n] = 0 ))
                        <div class="answers">
                            <div class="answer answer1 {{ $answers[$n] == 'a0' ? 'true' : '' }}">

                                <label for="q1{{ $n }}">{{ $question['a0'] }}</label>
                            </div>
                            <div class="answer answer1 {{ $answers[$n] == 'a1' ? 'true' : '' }}">

                                <label for="q2{{ $n }}">{{ $question['a1'] }}</label>
                            </div>
                            <div class="answer answer1 {{ $answers[$n] == 'a2' ? 'true' : '' }}">

                                <label for="q3{{ $n }}">{{ $question['a2'] }}</label>
                            </div>
                            <div class="answer answer1 {{ $answers[$n] == 'a3' ? 'true' : '' }}">

                                <label for="q4{{ $n }}">{{ $question['a3'] }}</label>
                            </div>
                        </div>
                    @else
                        <div class="answers">
                            <div
                                class="answer answer1 {{ $answers[$n] == 'a0' ? 'false' : '' }} {{ $question['at'] == 'a0' ? 'thetrue' : '' }}">

                                <label for="q1{{ $n }}">{{ $question['a0'] }}</label>
                            </div>
                            <div
                                class="answer answer1 {{ $answers[$n] == 'a1' ? 'false' : '' }} {{ $question['at'] == 'a1' ? 'thetrue' : '' }}">

                                <label for="q2{{ $n }}">{{ $question['a1'] }}</label>
                            </div>
                            <div
                                class="answer answer1 {{ $answers[$n] == 'a2' ? 'false' : '' }} {{ $question['at'] == 'a2' ? 'thetrue' : '' }}">

                                <label for="q3{{ $n }}">{{ $question['a2'] }}</label>
                            </div>
                            <div
                                class="answer answer1 {{ $answers[$n] == 'a3' ? 'false' : '' }} {{ $question['at'] == 'a3' ? 'thetrue' : '' }}">

                                <label for="q4{{ $n }}">{{ $question['a3'] }}</label>
                            </div>
                        </div>
                    @endif

                    <div class="obs">
                        <p class="obs-txt">{{$question['obs']}}</p>
                        @if ($question['obsImg'])
                            @php($index = array_search('q_obs_' . $n, $obs_names))
                            <div class="img-div">
                                <img src="{{ asset('storage/'.$question['obsImg'].'?'.microtime(true)) }}"
                                    alt="question">
                            </div>
                        @endif
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
                {{-- <button type="submit" class="next" id="end" style="display: none" id="next">End
                    </button> --}}

            </div>
        </div>
        {{-- END BUTTONS --}}
    </div>

    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/student/exam.js?4') }}"></script>
    <script>
        // Get the exam start time from wherever you have it
        var examStartTime = startTime; // Replace this with your start time

        // Get the exam duration in minutes
        var examDurationInMinutes = durationInMinutes; // Replace this with your exam duration

        // Calculate the end time of the exam
        var examEndTime = new Date(examStartTime.getTime() + examDurationInMinutes * 60000)


        // Calculate the end time of the exam
        var examEndTime = new Date(examStartTime.getTime() + examDurationInMinutes * 60000);

        // Function to update the timer
        function updateTimer() {
            var now = new Date();
            var timeDifference = examEndTime - now;

            if (timeDifference <= 0) {
                // Exam time is over
                clearInterval(timerInterval);
                alert("Time's up! Submit your exam.");
                endExam();
            } else {
                var hours = Math.floor(timeDifference / (1000 * 60 * 60));
                var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                // Update the HTML elements
                document.getElementById('h').textContent = hours.toString().padStart(2, '0');
                document.getElementById('m').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('s').textContent = seconds.toString().padStart(2, '0');
            }
        }

        // Function to end the exam
        function endExam() {
            // Perform actions to end the exam (e.g., submit form)
            alert("Exam ended. Submitting...");
        }

        // Update the timer every second
        var timerInterval = setInterval(updateTimer, 1000);

        // Initial update to set the timer
        updateTimer();
    </script>

</body>

</html>
