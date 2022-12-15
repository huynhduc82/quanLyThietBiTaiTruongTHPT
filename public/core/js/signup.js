let Name;
let PhoneNumber;
let DateOfBirth;
let Address;
let Email;
let Password;
let PasswordConfirmation;

let inputName = $("#name");
let inputPhoneNumber = $("#phone_number");
let inputDateOfBirth = $("#date_of_birth");
let inputAddress = $("#address");
let inputEmail = $('#email');
let inputPassword = $("#password");
let inputPasswordConfirmation = $("#password_confirmation");

let data = {}

$(document).ready(function(){
    $('#frm-signup').on('submit', function (e) {
        e.preventDefault();

        Name = inputName.val();
        PhoneNumber = inputPhoneNumber.val();
        DateOfBirth = inputDateOfBirth.val();
        Address = inputAddress.val();
        Email = inputEmail.val();
        Password = inputPassword.val();
        PasswordConfirmation = inputPasswordConfirmation.val()

        if (!Name) {
            $('#submit_error').text('Bạn chưa nhập Họ tên');
            return false;
        }
        if (!PhoneNumber) {
            $('#submit_error').text('Bạn chưa nhập số điện thoại');
            return false;
        }
        if (!DateOfBirth) {
            $('#submit_error').text('Bạn chưa nhập ngày sinh');
            return false;
        }
        // if (!Address) {
        //     $('#submit_error').text('Bạn chưa nhập Địa chỉ');
        //     return false;
        // }
        if (!Email) {
            $('#submit_error').text('Bạn chưa nhập Email');
            return false;
        }
        if (!Password) {
            $('#submit_error').text('Bạn chưa nhập Mật khẩu');
            return false;
        }
        if (!PasswordConfirmation) {
            $('#submit_error').text('Bạn chưa nhập Nhập lại mật khẩu');
            return false;
        }
        $('#submit_error').text('');
    });
});

