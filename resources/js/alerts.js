window.addEventListener("status:error", (e) => {
    Swal.fire({
        title: e.detail.title ?? "Error !",
        text: e.detail.message ?? "somthing went wrong !",
        icon: 'error',
        confirmButtonText: 'OK'
    })
})

window.addEventListener("status:success", (e) => {
    Swal.fire({
        title: e.detail.title ?? "Success.",
        text: e.detail.message,
        icon: 'success',
        confirmButtonText: 'OK'
    })
})

window.addEventListener("status:info", (e) => {
    Swal.fire({
        title: e.detail.title ?? "Info.",
        text: e.detail.message,
        icon: 'info',
        confirmButtonText: 'OK'
    })
})
