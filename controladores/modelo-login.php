<?php
//Llamamos a la conexion a la base de datos
include_once("../funciones/funciones.php");

//Variables que recibo
$Usuario = $_REQUEST["Usuario"];
$Password = $_REQUEST["Password"];
$Opcion = $_REQUEST["Opcion"];

//Login
if($Opcion == 1){
    
    try {
        $sql = " SELECT * FROM usuarios WHERE UsuarioUser = '$Usuario' ";
        $resultado = $conn->query($sql);
        $fila = $resultado->fetch_assoc();

        //Validamos que haya traido un usuario
        if ($fila["IdUsuario"] > 0) {
            //Validamos que el password sea el correcto
            if (password_verify($Password, $fila["UsuarioClave"])) {
                session_start();
                //Guardamos la información en las variables de sesión
                $_SESSION["IdUsuario"] = $fila["IdUsuario"];
                $_SESSION["Usuario"] = $fila["UsuarioUser"];
                $_SESSION["Nombre"] = $fila["UsuarioNombre"];;
                $_SESSION["Rol"] = $fila["IdRol"];
                
                //Respuesta al JS
                $respuesta = array(
                    "respuesta" => "exito"
                );

            } else {
                //Respuesta al JS
                $respuesta = array(
                    "respuesta" => "errorClave" //Error en la verifiación de la clave
                );
            }
        }
        else {
            //Respuesta al JS
            $respuesta = array(
                "respuesta" => "errorUsuario" //Error en el usuario
            );
        }

        //Cerramos la conexion
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "errorBD" //Error en la conexion a la bd
        );
    }

    die(json_encode($respuesta));
    
}

?>