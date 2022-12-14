let Name;
let Email;
let Password;

let inputName = document.getElementById("#name");
let inputEmail = $('#email');
let inputPassword = $("#password");

$(document).ready(function(){
    let back_page = "/signup/index";
    $('#frm-signup').on('submit', function (e) {
        // window.location.href = back_page;
        Name = inputName.val()
        Email = inputEmail.val()
        Password = inputPassword.val()
        console.log(Name, Email, Password)
    });
});

if (inputName) {
    inputName.addEventListener("change", function (event) {
        console.log(111111)
    });
}
