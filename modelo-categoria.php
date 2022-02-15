<?php 
    //Abrimos la conexion y guardamos los datos de post en variables
    include_once("funciones/funciones.php");
    $nombre_categoria = isset($_POST["nombre_categoria"]) ? $_POST["nombre_categoria"] : "";
    $icono = isset($_POST["icono"]) ? $_POST["icono"] : "";
    $id_registro = isset($_POST["id_registro"]) ? $_POST["id_registro"] : "";

if($_POST["registro"] == "nuevo"){

    try {
        $stmt = $conn->prepare(" INSERT INTO categoria_evento (cat_evento, icono) VALUE (?, ?) ");
        $stmt->bind_param("ss", $nombre_categoria, $icono);
        $stmt->execute();

        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "exito"
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
        
        $stmt = $conn->prepare(" UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ? ");
        $stmt->bind_param("ssi", $nombre_categoria, $icono, $id_registro);
        
        
        $stmt->execute();
        if($stmt->affected_rows){
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
        $stmt = $conn->prepare(" DELETE FROM categoria_evento WHERE id_categoria = ? ");
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