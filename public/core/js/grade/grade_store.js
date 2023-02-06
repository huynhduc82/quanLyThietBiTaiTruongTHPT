
let Name;

let InputTeacherName = $("name");


let data = {}

$(document).ready(function(){
    let myVar = setInterval(myTimer ,1000);
    function myTimer() {
        const d = new Date();
        document.getElementById("timeLend").value = d.toLocaleTimeString();
    }
    $('#frm-lend-return').on('submit', function (e) {
        e.preventDefault();
        Name = InputName.val();
        // ListEquipment = $("#listEquipment").DataTable({
        //     destroy: true,
        //     paging: false,
        //     searching: false,
        //     info: false,}).rows().data().toArray();
        ListEquipment = $("#listEquipment").DataTable().rows().data().toArray();
        console.log(ListEquipment)
        let ListEquipmentId = getListEquipmentId(ListEquipment)

        if (!Name) {
            $('#label-error').text('Bạn chưa nhập Tên Giáo Viên');
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

        data.name = Name;

        let back_page = '/grade/index';

        $.ajax({
            url: '/grade',
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
