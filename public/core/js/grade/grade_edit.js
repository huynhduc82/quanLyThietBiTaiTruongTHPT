let Name;
let ID;

let InputName = $("#name");
let inputID = $("#id");
let data = {}

$(document).ready(function(){
    $('#frm-grade').on('submit', function (e) {
        e.preventDefault();
        Name = InputName.val();
        ID = inputID.val();
        if (!Name) {
            $('#label-error').text('Bạn chưa nhập thông tin ');
            return false;
        }
        $('#label-error').text('');

        data.name = Name;

        let back_page = '/grade/index';

        $.ajax({
            url: '/grade/edit/' + ID,
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
