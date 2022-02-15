document.addEventListener("DOMContentLoaded", () => {
    if(document.querySelector("#login-admin")){
        document.querySelector("#login-admin").addEventListener("submit", iniciarSesion);
    }
})

function iniciarSesion(e) {
    e.preventDefault();
    const usuario = document.querySelector("#usuario").value,
        password = document.querySelector("#password").value,
        opcion = document.querySelector("#opcion").value;

    if (usuario === "" || password === "" || opcion === "") {
        //Mensaje de error en caso de que vengan los campos vacios
        Swal.fire({
            title: "Error!",
            text: "Los campos deben ser llenados",
            icon: "error",
        });
    } else {
        //Ambos campos son correctos. Mandamos a ejecutar AJAX.

        //Datos que se envian al servidor.
        var datos = new FormData();
        datos.append("Usuario", usuario);
        datos.append("Password", password);
        datos.append("Opcion", opcion);

        //Crear el llamado a ajax
        var xhr = new XMLHttpRequest();

        //Abrir la conexion.
        xhr.open("POST", "controladores/modelo-login.php", true);

        //Retorno de datos
        xhr.onload = function () {
            if (this.status === 200) {

                //retorno de datos en formato json
                var respuesta = JSON.parse(xhr.responseText);

                //Si la respuesta es correcta
                if (respuesta.respuesta === "exito") {

                    Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido',
                            text: 'Bienvenido ' + usuario,
                        })
                        .then(resultado => {
                            if (resultado.value) {
                                window.location.href = "index.php";
                            }
                        })
                } else if(respuesta.respuesta === "errorUsuario" || respuesta.respuesta === "errorClave"){

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'Clave o Usuario Incorrecto, intentelo de nuevo',
                    });

                } else {
                    //Hubo un error en la bd
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: 'Hubo un error, intentelo de nuevo',
                    });
                }
            }
        }

        //Enviar peticion
        xhr.send(datos);
    }


}