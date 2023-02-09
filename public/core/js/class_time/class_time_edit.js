let Lesson;
let StartTime
let EndTime;
let ID;

let InputLesson = $("#lesson");
let InputEndTime = $("#end");
let InputStartTime = $("#start");
let inputID = $("#id");


let data = {}

$(document).ready(function(){
    $('#frm-class-time').on('submit', function (e) {
        e.preventDefault();
        Lesson = InputLesson.val();
        EndTime = InputEndTime.val();
        StartTime = InputStartTime.val();
        ID = inputID.val();
        if (!EndTime) {
            $('#label-error').text('Bạn chưa chọn thời gian ');
            return false;
        }
        if (!StartTime) {
            $('#label-error').text('Bạn chưa chọn thời gian ');
            return false;
        }
        $('#label-error').text('');

        data.start = StartTime;
        data.lesson = Lesson;
        data.end = EndTime;

        let back_page = '/class/time/index';

        $.ajax({
            url: '/class/time/edit/' + ID,
            data: JSON.stringify(data),
            dataType: 'json',
            enctype: "multipart/form-data",
            contentType: 'application/json',
            cache: false,
            processData: false,
            success: function () {
                document.location.href = back_page;
            },
            error: function (error) {
                $('#label-error').text(error.responseJSON.message);
            },
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
});
