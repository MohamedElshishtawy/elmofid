$(document).ready(function() {
    $(".has-list").on('click', function () {
        $(this).children("ul").slideToggle(500);
    });

    $('.has-list > ul').click(function(e) {
        e.stopPropagation();
    });

    $('#menu').on('click', function() {
        var menuSidebar = $('.menu-sidebar');
        var currentRight = parseInt(menuSidebar.css('right'));

        if (currentRight < 0) {
            // If the right value is less than 0, animate to right: 0 and set width to 100%
            menuSidebar.animate({ right: 0}, 500);
            $('#menu').html('<i class="fa fa-xmark"></i>')
        }else{
            menuSidebar.animate({ right: '-300px'}, 500);
            $('#menu').html('<i class="fa-solid fa-bars"></i>')
        }
    });

    $('.money').on('click', function() {
        // Check if checkbox is checked
        // Get the value of the checked checkbox
        let student_id = $(this).val();
        let isChecked = $(this).prop('checked');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location.href+'/student/'+student_id+'/money',
            type: 'POST',
            data: {
                student_id: student_id,
                money: isChecked
            },
            success: function(response) {
                // Handle the response if needed
                alert('تم تعديل الإشتراك')
            },
            error: function(error) {
                // Handle the error if needed
                alert("لم تنجح العملية")
            }
        });
    });

  //   $('#search-2').on('keyup', function () {
  //   var value = $(this).val().toLowerCase();
  //
  //   // Filter only the first td in each row
  //   $('#table-1 tr').each(function () {
  //     var firstTd = $(this).find('td:nth-child(2)');
  //     var rowText = firstTd.text().toLowerCase();
  //     firstTd.closest('tr').toggle(rowText.indexOf(value) > -1);
  //   });
  //
  //   // Show the first two rows
  //   $('#table-1 tr:first, #table-1 tr:nth-child(2)').show();
  // });
  //
  $('#search-2').on('keyup', function () {
    var value = $(this).val().toLowerCase();

    // Filter only the first td in each row
    $('#table-1 tr').each(function () {
      var firstTd = $(this).find('td:nth-child(2)');
      var rowText = firstTd.text().toLowerCase();
      firstTd.closest('tr').toggle(rowText.indexOf(value) > -1);
    });

    // Show the first two rows
    $('#table-1 tr:first').show();
  });


});
