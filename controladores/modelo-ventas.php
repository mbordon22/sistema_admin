<?php
//Abrimos la conexion y guardamos los datos de post en variables
include_once("../funciones/funciones.php");

$VentaFechaVenta = isset($_POST["VentaFechaVenta"]) ? $_POST["VentaFechaVenta"] : "";
$VentaHoraVenta = isset($_POST["VentaHoraVenta"]) ? $_POST["VentaHoraVenta"] : "";
$IdProducto = isset($_POST["IdProducto"]) ? $_POST["IdProducto"] : "";
$VentaCantidadProducto = isset($_POST["VentaCantidadProducto"]) ? $_POST["VentaCantidadProducto"] : "";
$VentaTotal = isset($_POST["VentaTotal"]) ? $_POST["VentaTotal"] : "";
$VentaPagado = isset($_POST["VentaPagado"]) ? $_POST["VentaPagado"] : "";
$VentaDebe = isset($_REQUEST["VentaDebe"]) ? $_REQUEST["VentaDebe"] : "";
$VentaObservaciones = isset($_REQUEST["VentaObservaciones"]) ? $_REQUEST["VentaObservaciones"] : "";
$VentaFechaPagoTotal = isset($_REQUEST["VentaFechaPagoTotal"]) ? $_REQUEST["VentaFechaPagoTotal"] : "";
$VentaPrecioUnitario = isset($_REQUEST["VentaPrecioUnitario"]) ? $_REQUEST["VentaPrecioUnitario"] : "";
$IdVenta = isset($_REQUEST["IdVenta"]) ? $_REQUEST["IdVenta"] : "";
$opcion = isset($_REQUEST["opcion"]) ? $_REQUEST["opcion"] : "";
$editado = isset($_REQUEST["editado"]) ? $_REQUEST["editado"] : "";

if ($opcion == "nuevo") {       /* INSERT DE GATOS */
    /* die(json_encode($_REQUEST)); */
    try {

        $stmt = $conn->prepare(" INSERT INTO ventas (VentaFechaVenta, VentaHoraVenta, IdProducto, VentaCantidadProducto, VentaTotal, VentaPagado, VentaDebe, VentaObservaciones, VentaPrecioUnitario, VentaFechaPagoTotal) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("ssiidddsds", $VentaFechaVenta, $VentaHoraVenta, $IdProducto, $VentaCantidadProducto, $VentaTotal, $VentaPagado, $VentaDebe, $VentaObservaciones, $VentaPrecioUnitario, $VentaFechaPagoTotal);
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
elseif ($opcion == "actualizar") {      /* UPDATE DE GATOS */

    /* die(json_encode($_REQUEST)); */

    try {
        $stmt = $conn->prepare(" UPDATE ventas SET VentaFechaVenta = ?, VentaHoraVenta = ?, IdProducto = ?, VentaCantidadProducto = ?, VentaTotal = ?, VentaPagado = ?, VentaDebe = ?, VentaObservaciones = ?, VentaPrecioUnitario = ?, VentaFechaPagoTotal = ?, editado = ?  WHERE IdVenta= ? ");
        $stmt->bind_param("ssiidddsdssi", $VentaFechaVenta, $VentaHoraVenta, $IdProducto, $VentaCantidadProducto, $VentaTotal, $VentaPagado, $VentaDebe, $VentaObservaciones, $VentaPrecioUnitario, $VentaFechaPagoTotal, $editado, $IdVenta);
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
elseif ($opcion == "eliminar") {       /* DELETE DE GATOS */
    /* die(json_encode($_REQUEST)); */
    $IdVenta = $_REQUEST["id"];

    try {
        $stmt = $conn->prepare(" DELETE FROM ventas WHERE IdVenta = ? ");
        $stmt->bind_param("i", $IdVenta);
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
