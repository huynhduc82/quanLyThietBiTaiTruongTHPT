let ID;
let Role

let InputId = $("#id");

let data = {}

$(document).ready(function(){
    $('#frm-role').on('submit', function (e) {
        e.preventDefault();
        ID = InputId.val();
        if ($("#admin").is(":checked"))
        {
            Role = 'admin';
        }
        if ($("#manage").is(":checked"))
        {
            Role = 'manage';
        }
        if ($("#teacher").is(":checked"))
        {
            Role = 'teacher';
        }
        if ($("#maintainer").is(":checked"))
        {
            Role = 'maintainer';
        }


        $('#label-error').text('');

        data.role = Role;

        let back_page = '/role';

        $.ajax({
            url: '/role/ass-role/' + ID,
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
                $('#lbl-error').text(error.responseJSON.message);
            },
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
});
