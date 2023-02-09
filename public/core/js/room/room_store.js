let Name;
let Rent;

let InputName = $("#name");
let InputRent = $("#rent");

let data = {}

$(document).ready(function(){
    $('#frm-room').on('submit', function (e) {
        e.preventDefault();
        Name = InputName.val();
        if (!Name) {
            $('#label-error').text('Bạn chưa nhập thông tin ');
            return false;
        }
        if($("#rent").val()==="on"){
            Rent=true;
        } else {
            Rent=false;
        }
        $('#label-error').text('');

        data.name = Name;
        data.can_rent = Rent;
        let back_page = '/room/index';

        $.ajax({
            url: '/room',
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
