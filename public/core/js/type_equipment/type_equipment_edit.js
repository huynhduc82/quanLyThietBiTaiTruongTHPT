let ID;
let Name;
let Describe;
let Unit;
let Price;
let Image;

let inputID = $("#id");
let inputName = $("#name");
let inputDescribe = $("#describe");
let inputUnit = $("#unit");
let inputPrice = $("#price");
let inputImage = $('#image');

$(document).ready(function(){
    $('#frm-equipment').on('submit', function (e) {
        e.preventDefault();

        ID = inputID.val();
        Name = inputName.val();
        Describe = inputDescribe.val();
        Unit = inputUnit.val();
        Price = inputPrice.val();
        Image = inputImage[0].files[0] ?? null;

        // if (!Name) {
        //     $('#submit_error').text('Bạn chưa nhập Họ tên');
        //     return false;
        // }
        // if (!PhoneNumber) {
        //     $('#submit_error').text('Bạn chưa nhập số điện thoại');
        //     return false;
        // }
        // if (!DateOfBirth) {
        //     $('#submit_error').text('Bạn chưa nhập ngày sinh');
        //     return false;
        // }
        // // if (!Address) {
        // //     $('#submit_error').text('Bạn chưa nhập Địa chỉ');
        // //     return false;
        // // }
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
        // $('#submit_error').text('');

        let formData = new FormData();
        formData.append('name', Name);
        formData.append('describe', Describe);
        formData.append('unit', Unit);
        formData.append('price', Price);
        if (Image)
        {
            formData.append('images', Image);
        }

        let back_page = '/equipment/index';

        $.ajax({
            url: '/api/type/equip/' + ID,
            data: formData,
            // dataType: 'json',
            enctype: "multipart/form-data",
            contentType: false,
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

