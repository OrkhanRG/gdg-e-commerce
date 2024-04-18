let btnRegister = document.querySelector('.btnRegister');
let formRegister = document.querySelector('.formRegister');

btnRegister.addEventListener('click', function (target) {
    formRegister.submit();

    // Swal.fire({
    //     title: "Good job!",
    //     text: "You clicked the button!",
    //     icon: "success"
    // });
})

