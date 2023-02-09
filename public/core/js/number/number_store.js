let Equipment;
let CourseDetails;
let Quantity;

let InputEquipment = $("#equipment");
let InputCourseDetails = $("#courseDetails");
let InputQuantity = $("#quantity");


let data = {}

$(document).ready(function(){
    $('#frm-number').on('submit', function (e) {
        e.preventDefault();
        Equipment = InputEquipment.val();
        CourseDetails = InputCourseDetails.val();
        Quantity = InputQuantity.val();

        $('#label-error').text('');

        data.course_details_id = CourseDetails;
        data.equipment_id = Equipment;
        data.quantity = Quantity;

        let back_page = '/number/index';

        $.ajax({
            url: '/api/number-equipment',
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
