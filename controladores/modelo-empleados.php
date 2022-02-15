<?php
    //Abrimos la conexion y guardamos los datos de post en variables
    include_once("../funciones/sesiones.php");
    include_once("../funciones/funciones.php");
    $EmpleadooNombre = isset($_POST["EmpleadooNombre"]) ? $_POST["EmpleadooNombre"]: "";
    $EmpleadooApellido = isset($_POST["EmpleadooApellido"]) ? $_POST["EmpleadooApellido"]: "";
    $EmpleadoDNI = isset($_POST["EmpleadoDNI"]) ? $_POST["EmpleadoDNI"]: "";
    $EmpleadoFecNac = isset($_POST["EmpleadoFecNac"]) ? $_POST["EmpleadoFecNac"]: "";
    $EmpleadoTel = isset($_POST["EmpleadoTel"]) ? $_POST["EmpleadoTel"]: "";
    $EmpleadoDomicilio = isset($_REQUEST["EmpleadoDomicilio"]) ? $_REQUEST["EmpleadoDomicilio"] : "";
    $EmpleadoMail = isset($_REQUEST["EmpleadoMail"]) ? $_REQUEST["EmpleadoMail"] : "";
    $IdRol = isset($_REQUEST["IdRol"]) ? $_REQUEST["IdRol"] : "";
    $action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if($action == "insert"){

    $EmpleadoInsertUsu = $_SESSION['IdUsuario'];
    try {
        
        $stmt = $conn->prepare(" INSERT INTO empleados (EmpleadoNombre, EmpleadoApellido, EmpleadoDNI, EmpleadoFecNac, EmpleadoTel, EmpleadoDomicilio, EmpleadoMail, IdRol, EmpleadoInsertFec, EmpleadoInsertUsu) VALUE (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?) ");
        $stmt->bind_param("sssssssii", $EmpleadoNombre, $EmpleadoApellido, $EmpleadoDNI, $EmpleadoFecNac, $EmpleadoTel, $EmpleadoDomicilio, $EmpleadoMail, $IdRol, $EmpleadoInsertUsu);
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
    $EmpleadoUpdateUsu = $_SESSION["IdUsuario"];

    try {
        //En el caso que no actualice el password
        $stmt = $conn->prepare(" UPDATE empleados SET EmpleadoNombre = ?, EmpleadoApellido = ?, EmpleadoDNI = ?, EmpleadoFecNac = ?, EmpleadoTel = ?, IdRol = ?, UsuarioUpdateFec = NOW(), EmpleadoUpdateUsu = ? WHERE IdUsuario= ? ");
        $stmt->bind_param("sssisi", $EmpleadoNombre, $EmpleadoApellido, $EmpleadoDNI, $UsuarioRol, $EmpleadoUpdateUsu, $IdUsuario);

        
        
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