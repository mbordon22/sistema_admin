if (document.querySelector('#formEmpleado')) {
    const formEmpleado = document.querySelector('#formEmpleado');
    const urlAction = formEmpleado.getAttribute('action');
}

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#formEmpleado')) {
        formEmpleado.addEventListener('submit', guardarEmpleado);
    }
});

function guardarEmpleado(e) {
    e.preventDefault();

    const data = new FormData(formEmpleado);
    const accion = data.get('action');
    const mensaje = (accion == 'insert') ? 'El empleado fue creado con éxito' : 'El empleado fue actualizado con éxito';

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
                            window.location.href = "empleados.php";
                        }
                    })
            }
        }
    }

    xhr.send(data);
}


function eliminarUsuario(IdEmpleado, EmpleadoNombre) {
    const data = new FormData();
    data.append('IdEmpleado', IdEmpleado);
    data.append('action', 'delete');

    Swal.fire({
        title: 'Estas Seguro?',
        text: "Vas a eliminar al empleado " + EmpleadoNombre,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {

            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'controladores/modelo-empleados.php');

            xhr.onload = function () {
                if (xhr.status == 200) {
                    const respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta == 'ok') {
                        Swal.fire({
                                icon: 'success',
                                title: 'Listo',
                                text: 'El empleado ' + EmpleadoNombre + ' fue eliminado',
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