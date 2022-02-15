const formCategorias = document.querySelector('#formCategorias');
const urlAction = formCategorias.getAttribute('action');

document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('#formCategorias')) {
        formCategorias.addEventListener('submit', guardarCategoria);
    }
});

function guardarCategoria(e) {
    e.preventDefault();

    const data = new FormData(formCategorias);
    const accion = data.get('action');
    const mensaje = (accion == 'insert') ? 'La categoría fue creado con éxito' : 'La categoría fue actualizado con éxito';

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
                            window.location.href = "categorias.php";
                        }
                    })
            }
        }
    }

    xhr.send(data);
}


function eliminarCategoria(IdCategoria, CategoriaNombre) {
    const data = new FormData();
    data.append('IdCategoria', IdCategoria);
    data.append('action', 'delete');

    Swal.fire({
        title: 'Estas Seguro?',
        text: "Vas a eliminar la categoría " + CategoriaNombre,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {

            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'controladores/modelo-categorias.php');

            xhr.onload = function () {
                if (xhr.status == 200) {
                    const respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta == 'ok') {
                        Swal.fire({
                                icon: 'success',
                                title: 'Listo',
                                text: 'La categoría ' + CategoriaNombre + ' fue eliminado',
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