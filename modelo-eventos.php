<?php 
    //Abrimos la conexion y guardamos los datos de post en variables
    include_once("funciones/funciones.php");
    $titulo = isset($_POST["titulo-evento"]) ? $_POST["titulo-evento"]: "";
    $categoria_id = isset($_POST["categoria_evento"]) ? $_POST["categoria_evento"]: "";
    $invitado_id = isset($_POST["invitado_evento"]) ? $_POST["invitado_evento"]: "";
    $fecha = isset($_POST["fecha_evento"]) ? $_POST["fecha_evento"]: "";
    $hora = isset($_POST["hora_evento"]) ? $_POST["hora_evento"]: "";
    $id_registro = isset($_POST["id_registro"]) ? $_POST["id_registro"] : "";

if($_POST["registro"] == "nuevo"){

    try {
        
        $stmt = $conn->prepare(" INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv, editado) VALUE (?, ?, ?, ?, ?, NOW()) ");
        $stmt->bind_param("sssii", $titulo, $fecha, $hora, $categoria_id, $invitado_id);
        $stmt->execute();

        $id_registro = $stmt->insert_id;
        if($id_registro > 0){
            $respuesta = array(
                "respuesta" => "exito",
                "id_admin" => $id_registro
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

    try {
        
        $stmt = $conn->prepare(" UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE evento_id = ? ");
        $stmt->bind_param("sssiii", $titulo, $fecha, $hora, $categoria_id, $invitado_id, $id_registro);
        
        
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "exito",
                "id" => $stmt->insert_id
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
        $stmt = $conn->prepare(" DELETE FROM eventos WHERE evento_id = ? ");
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