let ID;
let Name;
let Room;

let inputID = $("#id");
let inputName = $("#name");
let inputRoom = $("#room");

let data = {}

$(document).ready(function(){
    $('#frm-equipment').on('submit', function (e) {
        e.preventDefault();

        ID = inputID.val();
        Name = inputName.val();
        Room = inputRoom.val();

        data.name = Name;
        data.room_id = Room;

        let back_page = '/equipment/index';

        $.ajax({
            url: '/api/equip/' + ID,
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
                $('#submit_error').text(error.responseJSON.message);
            },
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
});

