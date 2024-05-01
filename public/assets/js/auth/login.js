let btnLogin = document.querySelector('.btnLogin');
let formLogin = document.querySelector('.formLogin');
let email = document.querySelector('#email');
let password = document.querySelector('#password');

btnLogin.addEventListener('click', function () {
    if (!validateEmail(email.value))
    {
        Swal.fire({
            title: "Diqqət!",
            text: "Zəhmət olmasa keçərli mail ünvan daxil edin.",
            icon: "warning"
        });
    }
    else if (password.value.length < 8)
    {
        Swal.fire({
            title: "Diqqət!",
            text: "Şifrə ən az 8 simvol olmalıdır.",
            icon: "warning"
        });
    }
    else {
        formLogin.submit();
    }
})

function validateEmail(email)
{
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
