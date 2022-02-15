<?php 
    //Abrimos la conexion y guardamos los datos de post en variables
    include_once("funciones/funciones.php");
    $nombre_invitado = isset($_POST["nombre_invitado"]) ? $_POST["nombre_invitado"] : " ";
    $apellido_invitado = isset($_POST["apellido_invitado"]) ? $_POST["apellido_invitado"] : " ";
    $biografia_invitado = isset($_POST["biografia_invitado"]) ? $_POST["biografia_invitado"] : " ";
    $id_registro = isset($_POST["id_registro"]) ? $_POST["id_registro"] : " ";

if($_POST["registro"] == "nuevo"){

    /*$respuesta = array(
        "post" => $_POST,
        "archivo" => $_FILES
    );

    die(json_encode($respuesta));*/

    //Direccion en donde vamos a guardar las imagenes.
    $directorio = "../img/invitados/";

    //Verificar que el directorio exista, de no ser así crearlo.
    if(!is_dir($directorio)){
        mkdir($directorio, 0755, true);
    }


    //Movemos el archivo de al ubicación temporal al directorio especificado
    if(move_uploaded_file($_FILES["archivo_invitado"]["tmp_name"], $directorio . $_FILES["archivo_invitado"]["name"])){
        
        $imagen_url = $_FILES["archivo_invitado"]["name"];
        $imagen_resultado = "Se subio correctamente";

    }else{
        
        $respuesta = array(
            "respuesta" => error_get_last()
        );
    }
    

    try {
        $stmt = $conn->prepare(" INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUE (?, ?, ?, ?) ");
        $stmt->bind_param("ssss", $nombre_invitado, $apellido_invitado, $biografia_invitado, $imagen_url);
        $stmt->execute();

        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "exito",
                "respuesta_imagen" => $imagen_resultado
            );

        }else{
            $respuesta = array(
                "respuesta" => "error"
            );
        }

        $stmt->close();
        $conn->close();

    }   catch(Exception $e){
            echo "Error: " .$e->getMessage();
    }

    die(json_encode($respuesta));

    
}
elseif($_POST["registro"] == "actualizar"){

    //Direccion en donde vamos a guardar las imagenes.
    $directorio = "../img/invitados/";

    //Verificar que el directorio exista, de no ser así crearlo.
    if(!is_dir($directorio)){
        mkdir($directorio, 0755, true);
    }


    //Movemos el archivo de al ubicación temporal al directorio especificado
    if(move_uploaded_file($_FILES["archivo_invitado"]["tmp_name"], $directorio . $_FILES["archivo_invitado"]["name"])){
        
        $imagen_url = $_FILES["archivo_invitado"]["name"];
        $imagen_resultado = "Se subio correctamente";

    }else{
        
        $respuesta = array(
            "respuesta" => error_get_last()
        );
    }

    try {
        if($_FILES["archivo_invitado"]["size"] > 0){
            //Con imagen
            $stmt = $conn->prepare(" UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ? WHERE invitado_id = ? ");
            $stmt->bind_param("ssssi", $nombre_invitado, $apellido_invitado, $biografia_invitado, $imagen_url, $id_registro);
            
        }else{
            //Cuando la imagen no cambia
            $stmt = $conn->prepare(" UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ? WHERE invitado_id = ? ");
            $stmt->bind_param("sssi", $nombre_invitado, $apellido_invitado, $biografia_invitado, $id_registro);

        }
        
        
        $estado = $stmt->execute();
        if($estado){
            $respuesta = array(
                "respuesta" => "exito",
                "id" => $id_registro
            );
        }
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => "Error!! " . $e->getMessage()
        );
    }

    die(json_encode($respuesta));

}
elseif($_POST["registro"] == "eliminar"){
    $id_borrar = $_POST["id"];

    try{
        $stmt = $conn->prepare(" DELETE FROM invitados WHERE invitado_id = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "exito",
                "id_eliminado" => $id_borrar
            );
        }else {
            $respuesta = array(
                "respuesta" => "error"
            );
        }

        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $respuesta = array(
            "respuesta" => $e->getMessage()
        );
    }
    
    die(json_encode($respuesta));
}

?>