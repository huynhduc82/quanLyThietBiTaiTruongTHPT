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
        ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
        let ListEquipmentId = getListEquipmentId(ListEquipment)
        if (ListEquipmentId.length <= 0) {
            $('#label-error').text('Bạn chưa chọn thiết bị mượn');
            return false;
        }
        $('#label-error').text('');

        data.room_id = Room;
        data.equipment = ListEquipmentId;

        let back_page = '/maintenance/index';

        $.ajax({
            url: '/maintenance',
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
        EquipmentId.id = item.id
        listEquipmentId.push(EquipmentId);
    }
    return listEquipmentId
}
