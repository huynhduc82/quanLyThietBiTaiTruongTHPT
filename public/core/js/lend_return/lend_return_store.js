let Class;
let Room;
let UserId;
let TeacherName;
let TimeLend;
let Course;
let CourseDetails;
let ReturnAppointmentTime;
let Grade;
let ListEquipment;

let InputClass = $("#class");
let InputRoom = $("#room");
let InputUserId = $("#teacherId");
let InputTeacherName = $("#teacherName");
let InputTimeLend = $("#timeLend");
let InputCourse = $("#course");
let InputCourseDetails = $("#courseDetails");
let InputReturnAppointmentTime = $("#returnAppointmentTime");
let InputGrade = $("#grade");


let data = {}

$(document).ready(function(){
    let myVar = setInterval(myTimer ,1000);
    function myTimer() {
        const d = new Date();
        document.getElementById("timeLend").value = d.toLocaleTimeString();
    }
    $('#frm-lend-return').on('submit', function (e) {
        e.preventDefault();
        Class = InputClass.val();
        Room = InputRoom.val();
        UserId = InputUserId.val();
        TeacherName = InputTeacherName.val();
        TimeLend = InputTimeLend.val();
        Course = InputCourse.val();
        CourseDetails = InputCourseDetails.val();
        ReturnAppointmentTime = InputReturnAppointmentTime.val();
        Grade = InputGrade.val();
        // ListEquipment = $("#listEquipment").DataTable({
        //     destroy: true,
        //     paging: false,
        //     searching: false,
        //     info: false,}).rows().data().toArray();
        ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
        console.log(ListEquipment)
        let ListEquipmentId = getListEquipmentId(ListEquipment)

        if (!UserId) {
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
            $('#label-error').text('Bạn chưa chọn thiết bị mượn');
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


        data.class = Class;
        data.room = Room;
        data.user_id = UserId;
        data.return_appointment_time = ReturnAppointmentTime;
        data.equipment = ListEquipmentId;

        let back_page = '/lend_return/index';

        $.ajax({
            url: '/lend_return',
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
        EquipmentId.type_of_equipment_id = item.id
        EquipmentId.quantity = item.quantity
        listEquipmentId.push(EquipmentId);
    }
    return listEquipmentId
}
