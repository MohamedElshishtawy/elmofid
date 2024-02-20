

$(document).ready(function () {
    // Initial index
    let currentIndex = 0;

    // Show the initial question container
    showQuestionContainer(currentIndex);

    // Next button click event
    let questionsCount = $('.q-container').length;

    // Next button click event
    $('#next').on('click', function () {
        console.log('currentIndex ' + currentIndex + ' questionsCount ' + questionsCount )
        if (currentIndex < questionsCount - 1) {
            currentIndex++;
            showQuestionContainer(currentIndex);
            $('#back').prop('disabled', false); // Re-enable the Back button
            if (currentIndex == questionsCount - 1){
                $(this).hide();
                $('#end').show();
            }
        }
    });

    // Back button click event
    $('#back').on('click', function () {
        if (currentIndex > 0) {
            currentIndex--;
            showQuestionContainer(currentIndex);
            $('#next').show(); // Show the Next button
            $('#end').hide();
        } else {
            $(this).prop('disabled', true); // Disable the Back button when at the first question
        }
    });

    function showQuestionContainer(index) {
        // Hide all question containers
        $('.q-container').hide();

        // Show the question container at the specified index
        $('.q-container').eq(index).show();

        // Question sidebar
        $('.question_link').removeClass('active_link')
        $('.question_link').eq(index).addClass('active_link')

        // Question Cunter
        $('#questionCounter').html(parseInt(index) + 1)

        // progress
        let totalContainers = $('.q-container').length;

        let percentage = ((parseInt(index) + 1) / totalContainers) * 100;


        // Use jQuery's css method to set the width
        $('.bar').css('width', `${percentage}%`);
        // Disable/Enable Next and Back buttons based on index
        $('#next').prop('disabled', currentIndex === $('.q-container').length - 1);
        $('#back').prop('disabled', currentIndex === 0);

        //edit buttons

        if ( index == $('.q-container').length -1){
            $('#next').hide();
            $('#end').show();
        }else{
            $('#next').show();
            $('#end').hide();
        }
    }

    $('input[type="radio"]').on('change', function () {
        let questionIndex = $(this).attr('question-index');

        $(`li[link-question="${questionIndex}"]`).addClass('answered');
    });

    $('[link-question]').on('click', function () {

        let linkQuestionValue = $(this).attr('link-question');


        currentIndex = linkQuestionValue

        showQuestionContainer(currentIndex);

    });


    $(document).ready(function () {

        $('#end').on('click', function (event) {
            // Check if all radio inputs are checked
            let allChecked = $('input[type="radio"]').filter(':checked').length === $('.q-container').length;

            // Log the result (you can modify this part as needed)

            if (allChecked) {

            } else {
                event.preventDefault();
                alert('تأكد من حل جميع الأسئلة');
            }
        });
    });

    // timer

    // let timerInterval; // Variable to store the setInterval ID

    // clearInterval(timerInterval); // Clear any existing timer


    // let startTime = new Date(startTime);
    // // let endDate = new Date(startTime * 1000 + durationInMinutes * 60000); // Convert startTime to milliseconds
    // console.log(startTime);

    // // Start the timer
    // timerInterval = setInterval(function () {
    //     let now = new Date();
    //     let remainingTime = Math.max(0, (endDate - now) / 1000); // Remaining time in seconds

    //     let hours = Math.floor(remainingTime / 3600);
    //     let minutes = Math.floor((remainingTime % 3600) / 60);
    //     let seconds = Math.floor(remainingTime % 60);

    //     // Update the elements
    //     $('#h').text(hours.toString().padStart(2, '0'));
    //     $('#m').text(minutes.toString().padStart(2, '0'));
    //     $('#s').text(seconds.toString().padStart(2, '0'));

    //     if (remainingTime <= 0) {
    //         clearInterval(timerInterval); // Stop the timer when the time is up
    //     }
    // }, 1000);// Update every second

});

