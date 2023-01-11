let ID;
let Room;
let LenderId;
let TeacherName;
let TimeLend;
let Course;
let CourseDetails;
let ReturnAppointmentTime;
let Grade;
let ListEquipment;

let InputID = $("#ID");
let InputRoom = $("#room");
let InputLenderId = $("#teacherId");
let InputTeacherName = $("#teacherName");
let InputTimeLend = $("#timeLend");
let InputCourse = $("#course");
let InputCourseDetails = $("#courseDetails");
let InputReturnAppointmentTime = $("#returnAppointmentTime");
let InputGrade = $("#grade");


let data = {}

$(document).ready(function(){
    $('#frm-lend-return').on('submit', function (e) {
        e.preventDefault();
        ID = InputID.val();
        Room = InputRoom.val();
        LenderId = InputLenderId.val();
        TeacherName = InputTeacherName.val();
        TimeLend = InputTimeLend.val();
        Course = InputCourse.val();
        CourseDetails = InputCourseDetails.val();
        ReturnAppointmentTime = InputReturnAppointmentTime.val();
        Grade = InputGrade.val();
        // ListEquipment = $("#listEquipment").DataTable().rows({ selected: true }).data().toArray();
        ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
        let ListEquipmentId = getListEquipmentId(ListEquipment)

        if (!LenderId) {
            $('#label-error').text('Bạn chưa nhập Mã Giáo Viên');
            return false;
        }
        if (!TeacherName) {
            $('#label-error').text('Bạn chưa nhập Tên Giáo Viên');
            return false;
        }
        if (!ReturnAppointmentTime) {
            $('#label-error').text('Bạn chưa chọn thời gian trả dự kiến');
            return false;
        }
        if (ListEquipmentId.length <= 0) {
            $('#label-error').text('Bạn chưa xác nhận tình trạng thiết bị');
            return false;
        }
        // if (!Email) {
        //     $('#submit_error').text('Bạn chưa nhập Email');
        //     return false;
        // }
        // if (!Password) {
        //     $('#submit_error').text('Bạn chưa nhập Mật khẩu');
        //     return false;
        // }
        // if (!PasswordConfirmation) {
        //     $('#submit_error').text('Bạn chưa nhập Nhập lại mật khẩu');
        //     return false;
        // }
        $('#label-error').text('');


        data.equipment = ListEquipmentId;

        let back_page = '/lend_return/index';

        $.ajax({
            url: '/lend_return/return/' + ID,
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

function getListEquipmentId(ListEquipment)
{
    let listEquipmentId = []
    ListEquipment.forEach(myFunction);
    function myFunction(item) {
        let EquipmentId = {}
        EquipmentId.type_of_equipment_id = item.type_of_equipment_id
        EquipmentId.quantity = item.quantity
        listEquipmentId.push(EquipmentId);
    }
    return listEquipmentId
}
