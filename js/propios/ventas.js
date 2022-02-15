//Guardo los datos en variables
const cantidadProducto = document.querySelector("#VentaCantidadProducto");
const precioUnitario = document.querySelector("#VentaPrecioUnitario");
const precioTotal = document.querySelector("#VentaTotal");
const montoPagado = document.querySelector("#VentaPagado");
const montoDebe = document.querySelector("#VentaDebe");
const fechaVenta = document.querySelector("#VentaFechaVenta");
const horaVenta = document.querySelector("#VentaHoraVenta");
const fechaPagoTotal = document.querySelector("#VentaFechaPagoTotal");
const IdProducto = document.querySelector("#IdProducto");
const IdVenta = document.querySelector("#IdVenta");
const editado = document.querySelector("#editado");
const opcion = document.querySelector("#opcion");
const formVentas = document.querySelector("#form-ventas");
const VentaObservaciones = document.querySelector("#VentaObservaciones");
const tabla = document.querySelector("#registro");

document.addEventListener("DOMContentLoaded", function () {
    if (formVentas) {
        formVentas.addEventListener("submit", guardarVenta);
    }
    if (cantidadProducto || precioUnitario || montoPagado) {
        cantidadProducto.addEventListener("input", calcularMontoTotal);
        precioUnitario.addEventListener("input", calcularMontoTotal);
        montoPagado.addEventListener("input", validarMontoPagado);
    }
    if (tabla) {
        tabla.addEventListener("click", eliminarRegistro);
    }
})

//Funcion que guarda los datos en la bd
function guardarVenta(e) {
    e.preventDefault();

    if (cantidadProducto.value <= 0 || precioUnitario.value <= 0 || fechaVenta.value === "" || IdProducto.value <= 0) {
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
        datos.append("VentaFechaVenta", fechaVenta.value);
        datos.append("VentaHoraVenta", horaVenta.value);
        datos.append("IdProducto", IdProducto.value);
        datos.append("VentaPrecioUnitario", precioUnitario.valueAsNumber);
        datos.append("VentaCantidadProducto", cantidadProducto.valueAsNumber);
        datos.append("VentaTotal", precioTotal.valueAsNumber);
        datos.append("VentaPagado", montoPagado.valueAsNumber);
        datos.append("VentaDebe", montoDebe.valueAsNumber);
        datos.append("VentaObservaciones", VentaObservaciones.value);
        datos.append("IdVenta", IdVenta.value);
        datos.append("VentaFechaPagoTotal", fechaPagoTotal.value);
        datos.append("editado", editado.value);
        datos.append("opcion", opcion.value);

        //Crear el llamado a ajax
        var xhr = new XMLHttpRequest();

        //Abrir la conexion.
        xhr.open("POST", "controladores/modelo-ventas.php", true);

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
                            text: 'Venta registrada correctamente'
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
                            text: 'Venta editada correctamente'
                        })
                        .then(resultado => {
                            if (resultado.value) {
                                window.location.href = "lista-ventas.php";
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
    }
}

//Función que elimina un dato de la bd
function eliminarRegistro(e) {
    const btnEliminar = document.querySelectorAll(".borrar-registro");
    const icoEliminar = document.querySelectorAll(".fa-trash");

    for (let i = 0; i < btnEliminar.length; i++) {
        const cantidadRegistros = btnEliminar.length;

        if (e.target === btnEliminar[i] || e.target === icoEliminar[i]) {
            const id = btnEliminar[i].getAttribute("data-id");
            const tipoModelo = btnEliminar[i].getAttribute("data-tipo");

            const datos = new FormData;
            datos.append("id", id);
            datos.append("opcion", "eliminar");

            Swal.fire({
                title: 'Estas Seguro?',
                text: "Una vez eliminado no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Crear el llamado a ajax
                    var xhr = new XMLHttpRequest();

                    //Abrir la conexion.
                    xhr.open("POST", "controladores/modelo-"+tipoModelo+".php", true);

                    //Retorno de datos
                    xhr.onload = function () {
                        if (this.status === 200) {

                            //retorno de datos en formato json
                            var respuesta = JSON.parse(xhr.responseText);
                            console.log(respuesta);
                            //Si la respuesta es correcta
                            if (respuesta.respuesta === "exito" || respuesta.respuesta === "eliminado") {

                                Swal.fire(
                                    'Borrado!',
                                    'El registro fue eliminado con exito.',
                                    'success'
                                    )
                                
                                if(cantidadRegistros > 1){
                                    btnEliminar[i].parentElement.parentElement.remove();
                                } else {
                                    location.reload();
                                }
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
                }
            })


        }
    }
}

function calcularMontoTotal() {
    if (precioUnitario.valueAsNumber > 0 && cantidadProducto.valueAsNumber > 0) {
        precioTotal.value = (precioUnitario.valueAsNumber * cantidadProducto.valueAsNumber).toFixed(2);
        validarMontoPagado();
        calcularMontoDebe();
    }
}

function validarMontoPagado() {
    const mensajeMontoPagado = document.querySelector("#mensajeMontoPagado");
    if (montoPagado.valueAsNumber > precioTotal.valueAsNumber) {
        mensajeMontoPagado.textContent = "El monto pagado no puede superar el total";
        mensajeMontoPagado.style.color = "red";
    } else {
        mensajeMontoPagado.textContent = "";
        calcularMontoDebe();

        if (montoPagado.valueAsNumber === precioTotal.valueAsNumber) {
            validarFechaPagoTotal();
        }
    }
}

function calcularMontoDebe() {

    if (precioTotal.valueAsNumber > 0 && montoPagado.valueAsNumber > 0) {
        let restante = (precioTotal.valueAsNumber - montoPagado.valueAsNumber).toFixed(2);
        montoDebe.value = restante;
    }

}

function validarFechaPagoTotal() {
    fechaPagoTotal.value = fechaVenta.value;
}
