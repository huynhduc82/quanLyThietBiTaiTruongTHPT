const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

Echo.channel('toast').listen('ShowToast', (data) => {
    Toast.fire({
        icon: 'success',
        title: 'data'
    }).then(r => {})
})

