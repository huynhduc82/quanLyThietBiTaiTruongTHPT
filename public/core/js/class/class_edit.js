let Grade;
let Name
let Number;
let ID

let InputGrade = $("#grade");
let InputName = $("#name");
let InputNumber = $("#number");
let InputID = $("#id")


let data = {}

$(document).ready(function(){
    $('#frm-class').on('submit', function (e) {
        e.preventDefault();
        Grade = InputGrade.val();
        Name = InputName.val();
        Number = InputNumber.val();
        ID = InputID.val();
        // if (!EndTime) {
        //     $('#label-error').text('Bạn chưa chọn thời gian ');
        //     return false;
        // }
        // if (!StartTime) {
        //     $('#label-error').text('Bạn chưa chọn thời gian ');
        //     return false;
        // }
        $('#label-error').text('');

        data.grade_id = Grade;
        data.name = Name;
        data.number_of_pupils = Number;

        let back_page = '/class/index';

        $.ajax({
            url: '/class/edit/' + ID,
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
