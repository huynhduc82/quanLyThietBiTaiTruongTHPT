let ID;
let Name;
let Phone;
let DateOfBirth;
let Identification;
let Address;
let Email;
let Information;
let Avatar;
let Background;
let Facebook;
let Twitter;
let Instagram;

let inputID = $("#id");
let inputName = $("#name");
let inputPhone = $("#phone");
let inputDateOfBirth = $("#dateOfBirth");
let inputIdentification = $("#identification");
let inputAddress = $("#address");
let inputEmail = $("#email");
let inputInformation = $("#information");
let inputAvatar = $("#avatar");
let inputBackground = $("#background");
let inputFacebook = $("#facebook");
let inputTwitter = $("#twitter");
let inputInstagram = $("#instagram");

$(document).ready(function(){
    $('#frm-user').on('submit', function (e) {
        e.preventDefault();
        ID = inputID.val();
        Name = inputName.val();
        Phone = inputPhone.val();
        DateOfBirth = inputDateOfBirth.val();
        Identification = inputIdentification.val();
        Address = inputAddress.val();
        Email = inputEmail.val();
        Information = inputInformation.val();
        Avatar = inputAvatar[0] ? inputAvatar[0].files[0] : null;
        Background = inputBackground[0] ? inputBackground[0].files[0] : null;
        Facebook = inputFacebook.val();
        Twitter = inputTwitter.val();
        Instagram = inputInstagram.val();


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
        formData.append('phone_number', Phone);
        formData.append('date_of_birth', DateOfBirth);
        formData.append('identification', Identification)
        formData.append('address', Address)
        formData.append('email', Email)
        formData.append('information', Information)
        formData.append('facebook', Facebook);
        formData.append('twitter', Twitter);
        formData.append('instagram', Instagram);
        if (Avatar)
        {
            formData.append('avatar', Avatar)
        }
        if (Background)
        {
            formData.append('background', Background)
        }

        let back_page = '/user/index';

        $.ajax({
            url: '/api/user/edit-profile/' + ID,
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

