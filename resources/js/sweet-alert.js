import Swal from "sweetalert2";

window.addEventListener("swal:modal", (event) => {
    Swal.fire({
        position: "center",
        icon: event.detail.type,
        title: event.detail.title,
        text: event.detail.text,
        showConfirmButton: event.detail.showConfirmButton ?? true,
        timer: false,
    }).then((e) => {
        if (e.isConfirmed) {
            // window.livewire.emit('action', event.detail.id);
        }
    });
});

window.addEventListener("swal:confirm", (event) => {
    Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Lanjutkan",
        cancelButtonText: "Kembali",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            window.livewire.emit("action", event.detail.id);
        }
    });
});

window.addEventListener("swal:toast", (event) => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("click", Swal.close);
            // toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
    });

    Toast.fire({
        icon: event.detail.type,
        title: event.detail.title,
    });
});
