
let currentDate = new Date();

let timeTaken = (currentDate - Sdate) / (60 * 1000); // Convert milliseconds to minutes

let alertShown = false; // Variable to track if the alert has been shown
let alertShown2 = false; // Variable to track if the alert has been shown

function updateTimer() {

    let currentDate = new Date();

    timeTaken = (currentDate - Sdate) / (60 * 1000); // Convert milliseconds to minutes

    let timeDifference = durationInMinutes - timeTaken; // Calculate remaining time in minutes

    if (timeTaken >= durationInMinutes) {

        // Exam duration exceeded, submit
        clearInterval(timerInterval);

        $("form").submit();

    } else {

        let hours = Math.floor(timeDifference / 60);
        let minutes = Math.floor(timeDifference % 60);
        let seconds = Math.floor((timeDifference % 1) * 60); // Convert remaining seconds

        // Update the HTML elements
        $('#h').text(hours.toString().padStart(2, '0'));
        $('#m').text(minutes.toString().padStart(2, '0'));
        $('#s').text(seconds.toString().padStart(2, '0'));

        // Change color based on conditions
        let timerElement = $('.time-counter div:nth-child(2)');
        if ( timeDifference < 10) {

            timerElement.css('color', 'red');
                if (!alertShown) {
                    alert('قارب الوقت على الإنتهاء');
                    alertShown = true; // Mark that the alert has been shown
                }

        } else if (timeDifference < durationInMinutes / 2 ) {
            timerElement.css('color', 'orange');
            if (!alertShown2) {
                alert('متبقى ' + minutes + ' دقيقة')
                alertShown2 = true
            }
        } else {
            // Reset color to default
            timerElement.css('color', 'black');
        }
    }
}

// Update the timer every second
var timerInterval = setInterval(function () {
    updateTimer();
}, 1000);

// Initial update to set the timer
updateTimer();

/*var myEvent = window.attachEvent || window.addEventListener;
var chkevent = window.attachEvent ? 'onbeforeunload' : 'beforeunload';

myEvent(chkevent, function(e) { // For >=IE7, Chrome, Firefox
    var confirmationMessage = ' ';
    (e || window.event).returnValue = confirmationMessage;
    return confirmationMessage;
});*/
