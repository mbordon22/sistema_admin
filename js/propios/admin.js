if (document.querySelector('#formAdmin')) {
    const formAdmin = document.querySelector('#formAdmin');
    const urlAction = formAdmin.getAttribute('action');
}

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#formAdmin')) {
        formAdmin.addEventListener('submit', guardarUsuario);
    }
});

function guardarUsuario(e) {
    e.preventDefault();

    const data = new FormData(formAdmin);
    const accion = data.get('action');
    const mensaje = (accion == 'insert') ? 'El usuario fue creado con éxito' : 'El usuario fue actualizado con éxito';

    const xhr = new XMLHttpRequest();

    xhr.open('POST', urlAction);

    xhr.onload = function () {
        if (xhr.status == 200) {
            const respuesta = JSON.parse(xhr.responseText);

            if (respuesta.respuesta == 'ok') {
                Swal.fire({
                        icon: 'success',
                        title: 'Listo!',
                        text: mensaje,
                    })
                    .then(resultado => {
                        if (resultado.value) {
                            window.location.href = "usuarios.php";
                        }
                    })
            }
        }
    }

    xhr.send(data);
}


function eliminarUsuario(IdUsuario, UsuarioNombre) {
    const data = new FormData();
    data.append('IdUsuario', IdUsuario);
    data.append('action', 'delete');

    Swal.fire({
        title: 'Estas Seguro?',
        text: "Vas a eliminar al usuario " + UsuarioNombre,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {

            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'controladores/modelo-admin.php');

            xhr.onload = function () {
                if (xhr.status == 200) {
                    const respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta == 'ok') {
                        Swal.fire({
                                icon: 'success',
                                title: 'Listo',
                                text: 'El usuario ' + UsuarioNombre + ' fue eliminado',
                            })
                            .then(resultado => {
                                if (resultado.value) {
                                    location.reload();
                                }
                            })
                    } else {
                        //Hubo un error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'Hubo un error',
                        });
                    }
                }
            }

            xhr.send(data);
        }
    });
}