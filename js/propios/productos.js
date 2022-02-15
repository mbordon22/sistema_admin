const formProductos = document.querySelector("#form-productos");
const ProductoNombre = document.querySelector("#ProductoNombre");
const ProductoPrecio = document.querySelector("#ProductoPrecio");
const editado = document.querySelector("#editado");
const IdProducto = document.querySelector("#IdProducto");
const opcion = document.querySelector("#opcion");

document.addEventListener("DOMContentLoaded", function () {
    if (formProductos) {
        formProductos.addEventListener("submit", guardarProducto);
    }
})

//Funcion que guarda los datos en la bd
function guardarProducto(e) {
    e.preventDefault();
    console.log("Entro");

    /* if (cantidadProducto.value <= 0 || precioUnitario.value <= 0 || fechaVenta.value === "" || IdProducto.value <= 0) {
        //Mensaje de error en caso de que vengan los campos vacios
        Swal.fire({
            title: "Error!",
            text: "Los campos deben ser llenados",
            icon: "error",
        });
    } else {
        //Los campos son correctos. Mandamos a ejecutar AJAX.

        //Datos que se envian al servidor.
        var datos = new FormData();
        datos.append("ProductoNombre", ProductoNombre.value);
        datos.append("IdProducto", IdProducto.value);
        datos.append("ProductoPrecio", ProductoPrecio.valueAsNumber);
        datos.append("editado", editado.value);
        datos.append("opcion", opcion.value);

        //Crear el llamado a ajax
        var xhr = new XMLHttpRequest();

        //Abrir la conexion.
        xhr.open("POST", "controladores/modelo-productos.php", true);

        //Retorno de datos
        xhr.onload = function () {
            if (this.status === 200) {

                //retorno de datos en formato json
                var respuesta = JSON.parse(xhr.responseText);
                console.log(respuesta);
                //Si la respuesta es correcta
                if (respuesta.respuesta === "exito" || respuesta.respuesta === "nuevo") {

                    Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Producto registrado correctamente'
                        })
                        .then(resultado => {
                            if (resultado.value) {
                                location.reload();
                            }
                        })
                }
                if (respuesta.respuesta === "exito" || respuesta.respuesta === "actualizar") {

                    Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Producto editado correctamente'
                        })
                        .then(resultado => {
                            if (resultado.value) {
                                window.location.href = "lista-productos.php";
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
        //Enviar peticion
        xhr.send(datos);
    } */
}