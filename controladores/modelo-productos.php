<?php
//Abrimos la conexion y guardamos los datos de post en variables
include_once("../funciones/funciones.php");
include_once("../funciones/sesiones.php");

$ProductoNombre = isset($_REQUEST["ProductoNombre"]) ? $_REQUEST["ProductoNombre"] : "";
$ProductoPrecio = isset($_REQUEST["ProductoPrecio"]) ? $_REQUEST["ProductoPrecio"] : "";
$IdProducto = isset($_REQUEST["IdProducto"]) ? $_REQUEST["IdProducto"] : "";
$opcion = isset($_REQUEST["opcion"]) ? $_REQUEST["opcion"] : "";
$editado = isset($_REQUEST["editado"]) ? $_REQUEST["editado"] : "";

/* INSERT DE Productos */
if ($opcion == "nuevo") {
    $ProductoInsertUsu = $_SESSION['IdUsuario'];
    
    try {

        $stmt = $conn->prepare(" INSERT INTO productos (ProductoNombre, ProductoPrecio, ProductoInsertUsu, ProductoInsertFec) VALUE (?, ?, ?, NOW()) ");
        $stmt->bind_param("sdi", $ProductoNombre, $ProductoPrecio, $ProductoInsertUsu);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if ($id_registro > 0) {
            $respuesta = array(
                "respuesta" => "exito",
                "opcion" => "nuevo"
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
} 
/* UPDATE DE Productos */
elseif ($opcion == "actualizar") {      

    /* die(json_encode($_REQUEST)); */
    $ProductoUpdateUsu = $_SESSION['IdUsuario'];

    try {
        $stmt = $conn->prepare(" UPDATE productos SET  ProductoNombre = ?, ProductoPrecio = ?, ProductoUpdateFec = NOW(), ProductoUpdateUsu = ?  WHERE IdProducto= ? ");
        $stmt->bind_param("sdii", $ProductoNombre, $ProductoPrecio, $ProductoUpdateUsu, $IdProducto);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "exito",
                "opcion" => "actualizar"
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
/* DELETE DE Productos */
elseif ($opcion == "eliminar") {      
    /* die(json_encode($_REQUEST)); */
    $IdProducto = $_REQUEST["id"];

    try {
        $stmt = $conn->prepare(" DELETE FROM productos WHERE IdProducto = ? ");
        $stmt->bind_param("i", $IdProducto);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "exito",
                "opcion" => "eliminar"
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            "respuesta" => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}
