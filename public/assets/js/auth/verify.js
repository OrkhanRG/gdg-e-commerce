let brnVerify = document.querySelector('.brnVerify');
let formVerify = document.querySelector('.formVerify');
let email = document.querySelector('#email');

brnVerify.addEventListener('click', function () {
    if (!validateEmail(email.value))
    {
        Swal.fire({
            title: "Diqqət!",
            text: "Zəhmət olmasa keçərli mail ünvan daxil edin.",
            icon: "warning"
        });
    }
    else {
        formVerify.submit();
    }
})

function validateEmail(email)
{
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
