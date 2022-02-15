<?php
//Abrimos la conexion y guardamos los datos de post en variables
include_once("../funciones/sesiones.php");
include_once("../funciones/funciones.php");
$CategoriaNombre = isset($_POST["CategoriaNombre"]) ? $_POST["CategoriaNombre"] : "";
$CategoriaDescripcion = isset($_POST["CategoriaDescripcion"]) ? $_POST["CategoriaDescripcion"] : "";
$IdCategoria = isset($_POST["IdCategoria"]) ? $_POST["IdCategoria"] : "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($action == "insert") {

    $CategoriaInsertUsu = $_SESSION['IdUsuario'];
    try {

        $stmt = $conn->prepare(" INSERT INTO categorias (CategoriaNombre, CategoriaDescripcion, CategoriaInsertFec, CategoriaInsertUsu) VALUE (?, ?, NOW(), ?) ");
        $stmt->bind_param("ssi", $CategoriaNombre, $CategoriaDescripcion, $CategoriaInsertUsu);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if ($id_registro > 0) {
            $respuesta = array(
                "respuesta" => "ok"
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
} elseif ($action == "update") {
    $CategoriaUpdateUsu = $_SESSION["IdUsuario"];

    try {
        //En el caso que no actualice el password
        $stmt = $conn->prepare(" UPDATE categorias SET CategoriaNombre = ?, CategoriaDescripcion = ?, CategoriaUpdateFec = NOW(), CategoriaUpdateUsu = ? WHERE IdCategoria= ? ");
        $stmt->bind_param("ssii", $CategoriaNombre, $CategoriaDescripcion, $CategoriaUpdateUsu, $IdCategoria);

        $stmt->execute();
        if ($stmt->affected_rows) {
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
} elseif ($action == "delete") {
    $IdCategoria = $_REQUEST["IdCategoria"];

    try {
        $stmt = $conn->prepare(" DELETE FROM categorias WHERE IdCategoria = ? ");
        $stmt->bind_param("i", $IdCategoria);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "ok",
                "id_eliminado" => $IdCategoria
            );
        } else {
            $respuesta = array(
                "respuesta" => "error"
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
