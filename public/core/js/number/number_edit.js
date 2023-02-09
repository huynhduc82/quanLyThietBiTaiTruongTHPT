
let Quantity;
let ID;

let inputID = $("#id");
let InputQuantity = $("#quantity");


let data = {}

$(document).ready(function(){
    $('#frm-number').on('submit', function (e) {
        e.preventDefault();
        ID = inputID.val();
        Quantity = InputQuantity.val();

        $('#label-error').text('');

        data.quantity = Quantity;

        let back_page = '/number/index';

        $.ajax({
            url: '/api/number-equipment/' + ID,
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
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
});
