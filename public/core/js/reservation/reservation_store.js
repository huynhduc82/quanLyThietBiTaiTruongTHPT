let Room;
let PickUpTime
let ReturnAppointmentTime;
let ListEquipment;

let InputRoom = $("#room");
let InputReturnAppointmentTime = $("#returnAppointmentTime");
let InputPickUpTime = $("#pickUpTime")


let data = {}

$(document).ready(function(){
    $('#frm-lend-return').on('submit', function (e) {
        e.preventDefault();
        Room = InputRoom.val();
        ReturnAppointmentTime = InputReturnAppointmentTime.val();
        PickUpTime = InputPickUpTime.val();
        // ListEquipment = $("#listEquipment").DataTable({
        //     destroy: true,
        //     paging: false,
        //     searching: false,
        //     info: false,}).rows().data().toArray();
        ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
        let ListEquipmentId = getListEquipmentId(ListEquipment)

        if (!ReturnAppointmentTime) {
            $('#label-error').text('Bạn chưa chọn thời gian trả dự kiến');
            return false;
        }
        if (ListEquipmentId.length <= 0) {
            $('#label-error').text('Bạn chưa chọn thiết bị mượn');
            return false;
        }
        $('#label-error').text('');

        data.pick_up_time = PickUpTime;
        data.room = Room;
        data.return_appointment_time = ReturnAppointmentTime;
        data.equipment = ListEquipmentId;

        let back_page = '/reservation/index';

        $.ajax({
            url: '/reservation',
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
