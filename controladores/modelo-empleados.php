<?php
//Abrimos la conexion y guardamos los datos de post en variables
include_once("../funciones/sesiones.php");
include_once("../funciones/funciones.php");
$EmpleadoNombre = isset($_POST["EmpleadoNombre"]) ? $_POST["EmpleadoNombre"] : "";
$EmpleadoApellido = isset($_POST["EmpleadoApellido"]) ? $_POST["EmpleadoApellido"] : "";
$EmpleadoDNI = isset($_POST["EmpleadoDNI"]) ? $_POST["EmpleadoDNI"] : "";
$EmpleadoFecNac = isset($_POST["EmpleadoFecNac"]) ? $_POST["EmpleadoFecNac"] : "";
$EmpleadoTel = isset($_POST["EmpleadoTel"]) ? $_POST["EmpleadoTel"] : "";
$EmpleadoDomicilio = isset($_REQUEST["EmpleadoDomicilio"]) ? $_REQUEST["EmpleadoDomicilio"] : "";
$EmpleadoMail = isset($_REQUEST["EmpleadoMail"]) ? $_REQUEST["EmpleadoMail"] : "";
$IdRol = isset($_REQUEST["IdRol"]) ? $_REQUEST["IdRol"] : "";
$IdEmpleado = isset($_REQUEST["IdEmpleado"]) ? $_REQUEST["IdEmpleado"] : "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($action == "insert") {

    $EmpleadoInsertUsu = $_SESSION['IdUsuario'];
    try {

        $stmt = $conn->prepare(" INSERT INTO empleados (EmpleadoNombre, EmpleadoApellido, EmpleadoDNI, EmpleadoFecNac, EmpleadoTel, EmpleadoDomicilio, EmpleadoMail, IdRol, EmpleadoInsertFec, EmpleadoInsertUsu) VALUE (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?) ");
        $stmt->bind_param("sssssssii", $EmpleadoNombre, $EmpleadoApellido, $EmpleadoDNI, $EmpleadoFecNac, $EmpleadoTel, $EmpleadoDomicilio, $EmpleadoMail, $IdRol, $EmpleadoInsertUsu);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if ($id_registro > 0) {
            $respuesta = array(
                "respuesta" => "ok"
            );

            //------------------- Sube el Archivo ---------------------
            $nombre = $_FILES['imagen']['name'];
            $tam = $_FILES['imagen']['size'];
            $pedazos = explode(".", $nombre);

            $pedazo1 = trim($pedazos[0]);
            $pedazo2 = trim($pedazos[1]);

            //*************** Upload del imagen ************

            if ($tam < 1048576) {

                if ($pedazo2 == "jpg" or $pedazo2 == "JPG" or $pedazo2 == "png" or $pedazo2 == "PNG") {

                    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {    //cho "entroiooo";

                        chdir("../img/empleados");

                        copy($_FILES['imagen']['tmp_name'], $_FILES['imagen']['name']);

                        $filename = $nombre;

                        $bUploaded = move_uploaded_file($_FILES['imagen']['tmp_name'], $filename);

                        //$sThumbCrop = imageCrop($nombre,$filename,600,600,TRUE,"");

                        $ancho = 128;

                        $alto = 128;


                        // Obtener las nuevas dimensiones

                        list($ancho_orig, $alto_orig) = getimagesize($filename);


                        // Redimensionar

                        $image_p = imagecreatetruecolor($ancho, $alto);

                        $image = imagecreatefromjpeg($filename);

                        imagecopyresized($image_p, $image, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

                        $nombre2 = $EmpleadoDNI . ".jpg";

                        rename($nombre, $nombre2);

                        imagejpeg($image_p, $nombre2);
                    }
                }
            }
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
} elseif ($action == "update") {
    $EmpleadoUpdateUsu = $_SESSION["IdUsuario"];

    try {
        //En el caso que no actualice el password
        $stmt = $conn->prepare(" UPDATE empleados SET EmpleadoNombre = ?, EmpleadoApellido = ?, EmpleadoDNI = ?, EmpleadoFecNac = ?, EmpleadoTel = ?, EmpleadoDomicilio = ?, EmpleadoMail = ?, IdRol = ?, EmpleadoUpdateFec = NOW(), EmpleadoUpdateUsu = ? WHERE IdEmpleado= ? ");
        $stmt->bind_param("sssssssiii", $EmpleadoNombre, $EmpleadoApellido, $EmpleadoDNI, $EmpleadoFecNac, $EmpleadoTel, $EmpleadoDomicilio, $EmpleadoMail, $IdRol, $EmpleadoUpdateUsu, $IdEmpleado);

        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "ok"
            );

            if (empty($_FILES['imagen'])) {
                //------------------- Sube el Archivo ---------------------
                $nombre = $_FILES['imagen']['name'];
                $tam = $_FILES['imagen']['size'];
                $pedazos = explode(".", $nombre);

                $pedazo1 = trim($pedazos[0]);
                $pedazo2 = trim($pedazos[1]);

                //*************** Upload del imagen ************
                if ($tam < 1048576) {

                    if ($pedazo2 == "jpg" or $pedazo2 == "JPG" or $pedazo2 == "png" or $pedazo2 == "PNG") {

                        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {    //cho "entroioooo        xxxx";

                            chdir("../img/empleados");

                            copy($_FILES['imagen']['tmp_name'], $_FILES['imagen']['name']);

                            $filename = $nombre;

                            $bUploaded = move_uploaded_file($_FILES['imagen']['tmp_name'], $filename);

                            //$sThumbCrop = imageCrop($nombre,$filename,600,600,TRUE,"");

                            $ancho = 128;

                            $alto = 128;


                            // Obtener las nuevas dimensiones

                            list($ancho_orig, $alto_orig) = getimagesize($filename);


                            // Redimensionar

                            $image_p = imagecreatetruecolor($ancho, $alto);

                            $image = imagecreatefromjpeg($filename);

                            imagecopyresized($image_p, $image, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);

                            $nombre2 = $EmpleadoDNI . ".jpg";

                            rename($nombre, $nombre2);

                            imagejpeg($image_p, $nombre2);
                        }
                    }
                }
            }
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
    $IdEmpleado = $_REQUEST["IdEmpleado"];

    try {
        $stmt = $conn->prepare(" DELETE FROM empleados WHERE IdEmpleado = ? ");
        $stmt->bind_param("i", $IdEmpleado);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "ok",
                "id_eliminado" => $IdEmpleado
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
