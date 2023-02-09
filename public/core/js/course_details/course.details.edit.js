let Name;
let Lesson;
let ID;

let InputName = $("#name");
let InputLesson = $("#lesson");
let InputID = $("#id");

let data = {}

$(document).ready(function(){
    $('#frm-course-details').on('submit', function (e) {
        e.preventDefault();
        Name = InputName.val();
        Lesson = InputLesson.val();
        ID = InputID.val();
        if (!Name) {
            $('#label-error').text('Bạn chưa nhập thông tin ');
            return false;
        }
        $('#label-error').text('');

        data.lesson = Lesson;
        data.describe = Name;

        if (document.getElementById('need_equipment').checked) {
            data.need_equipment = true
        }
        else {
            data.need_equipment = false
        }


        let back_page = '/course/index';

        $.ajax({
            url: '/api/course-details/' + ID,
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
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
});
