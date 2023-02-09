let Name;
let Course;

let InputName = $("#name");
let InputCourse = $("#course");


let data = {}

$(document).ready(function(){
    $('#frm-number').on('submit', function (e) {
        e.preventDefault();
        Name = InputName.val();
        Course = InputCourse.val();
        if (!Course) {
            $('#label-error').text('Bạn chưa chọn  ');
            return false;
        }
        $('#label-error').text('');

        data.course_details_id = Course;
        data.name = Name;

        let back_page = '/number/index';

        $.ajax({
            url: '/number',
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
