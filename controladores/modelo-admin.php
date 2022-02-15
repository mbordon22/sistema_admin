<?php
    //Abrimos la conexion y guardamos los datos de post en variables
    include_once("../funciones/sesiones.php");
    include_once("../funciones/funciones.php");
    $UsuarioNombre = isset($_POST["UsuarioNombre"]) ? $_POST["UsuarioNombre"]: "";
    $UsuarioApellido = isset($_POST["UsuarioApellido"]) ? $_POST["UsuarioApellido"]: "";
    $UsuarioUser = isset($_POST["UsuarioUser"]) ? $_POST["UsuarioUser"]: "";
    $UsuarioClave = isset($_POST["UsuarioClave"]) ? $_POST["UsuarioClave"]: "";
    $IdUsuario = isset($_POST["IdUsuario"]) ? $_POST["IdUsuario"]: "";
    $UsuarioRol = isset($_REQUEST["UsuarioRol"]) ? $_REQUEST["UsuarioRol"] : "";
    $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if($action == "insert"){

    $opciones = array(
        "cost" => 12
    );

    $password_hasheado = password_hash($UsuarioClave, PASSWORD_BCRYPT, $opciones);
    $UsuarioInsertUsu = $_SESSION['IdUsuario'];
    try {
        
        $stmt = $conn->prepare(" INSERT INTO usuarios (UsuarioUser, UsuarioNombre, UsuarioApellido, UsuarioClave, IdRol, UsuarioInsertFec, UsuarioInsertUsu) VALUE (?, ?, ?, ?, ?, NOW(), ?) ");
        $stmt->bind_param("ssssi", $UsuarioUser, $UsuarioNombre, $UsuarioApellido, $password_hasheado, $UsuarioRol, $UsuarioInsertUsu);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if($id_registro > 0){
            $respuesta = array(
                "respuesta" => "ok"
            );
        }

        $stmt->close();
        $conn->close();

    }   catch(Exception $e){
            echo "Error: " .$e->getMessage();
    }

    die(json_encode($respuesta));
}
elseif($action == "update"){
    $UsuarioUpdateUsu = $_SESSION["IdUsuario"];

    try {
        if(empty($UsuarioClave)){
            //En el caso que no actualice el password
            $stmt = $conn->prepare(" UPDATE usuarios SET UsuarioUser = ?, UsuarioNombre = ?, UsuarioApellido = ?, IdRol = ?, UsuarioUpdateFec = NOW(), UsuarioUpdateUsu = ? WHERE IdUsuario= ? ");
            $stmt->bind_param("sssisi", $UsuarioUser, $UsuarioNombre, $UsuarioApellido, $UsuarioRol, $UsuarioUpdateUsu, $IdUsuario);

        }else{
            //Si actualiza el password
            $opciones = array(
                "cost" => 12
            );
            $password_hasheado = password_hash($UsuarioClave, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare(" UPDATE usuarios SET UsuarioUser = ?, UsuarioNombre = ?, UsuarioApellido = ?,  UsuarioClave = ?, IdRol = ?, UsuarioUpdateFec = NOW(), UsuarioUpdateUsu = ? WHERE IdUsuario= ? ");
            $stmt->bind_param("sssisi", $UsuarioUser, $UsuarioNombre, $UsuarioApellido, $password_hasheado, $UsuarioRol, $UsuarioUpdateUsu, $IdUsuario);
        }
        
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "ok"
            );
        } else {
            echo $stmt->error;
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
elseif($action == "delete"){
    $IdUsuario = $_REQUEST["IdUsuario"];

    try{
        $stmt = $conn->prepare(" DELETE FROM usuarios WHERE IdUsuario = ? ");
        $stmt->bind_param("i", $IdUsuario);
        $stmt->execute();
        
        if($stmt->affected_rows){
            $respuesta = array(
                "respuesta" => "ok",
                "id_eliminado" => $IdUsuario
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