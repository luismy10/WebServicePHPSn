<?php

/**
 * Representa el la estructura de las Clientes
 * almacenadas en la base de datos
 */
require_once __DIR__ . './../database/DataBaseConexion.php';

class MovimientoADO
{

    function __construct()
    {
    }

    public static function ListarInventario($ajuste, $all)
    {
        $consulta = "SELECT IdTipoMovimiento,Nombre,Predeterminado,Sistema,Ajuste FROM TipoMovimientoTB";
        $query = $all === "true" ? $consulta : $consulta . " WHERE Ajuste = ?";
        $array = array();
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($query);
            if ($all === "false") {
                $comando->bindParam(1, $ajuste, PDO::PARAM_BOOL);
            }
            // Ejecutar sentencia preparada
            $comando->execute();
            $count = 0;
            while ($row = $comando->fetch()) {
                $count++;
                array_push($array, array(
                    "IdTipoMovimiento" => $row["IdTipoMovimiento"],
                    "Nombre" => $row["Nombre"],
                    "Predeterminado" => $row["Predeterminado"],
                    "Sistema" => $row["Sistema"],
                    "Ajuste" => $row["Ajuste"]
                ));
            }
            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function RegistrarMovimientoInventario($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $queryCodigoMovimiento = "SELECT dbo.Fc_MovimientoInventario_Codigo_Alfanumerico();";
            $codigoMovimiento = Database::getInstance()->getDb()->prepare($queryCodigoMovimiento);
            $codigoMovimiento->execute();
            $idMovimiento = $codigoMovimiento->fetchColumn();

            $movimiento = Database::getInstance()->getDb()->prepare("INSERT INTO MovimientoInventarioTB
            (IdMovimientoInventario,
            Fecha,
            Hora,
            TipoAjuste,
            TipoMovimiento,
            Observacion,
            Suministro,
            Estado,
            CodigoVerificacion)
            VALUES(?,?,?,?,?,?,?,?,?)");
            $movimiento->execute(array(
                $idMovimiento,
                $body["fecha"],
                $body["hora"],
                $body["tipoAjuste"],
                $body["tipoMovimiento"],
                $body["observacion"],
                $body["suministro"],
                $body["estado"],
                $body["codigoVerificacion"]
            ));

            $movimientoDetalle = Database::getInstance()->getDb()->prepare("INSERT INTO MovimientoInventarioDetalleTB
            (IdMovimientoInventario,
            IdSuministro,
            Cantidad,
            Costo,
            Precio)
            VALUES(?,?,?,?,?)");

            $suministroUpdate = $body["tipoAjuste"]
                ? Database::getInstance()->getDb()->prepare("UPDATE SuministroTB SET Cantidad = Cantidad + ? WHERE IdSuministro = ?")
                : Database::getInstance()->getDb()->prepare("UPDATE SuministroTB SET Cantidad = Cantidad - ? WHERE IdSuministro = ?");

            $suministroKardex = Database::getInstance()->getDb()->prepare("INSERT INTO KardexSuministroTB
            (IdSuministro,
            Fecha,
            Hora,
            Tipo,
            Movimiento,
            Detalle,
            Cantidad,
            Costo,
            Total)
            VALUES(?,?,?,?,?,?,?,?,?)");

            foreach ($body["lista"] as $result) {
                $movimientoDetalle->execute(array(
                    $idMovimiento,
                    $result["IdSuministro"],
                    $result["Movimiento"],
                    $result["PrecioCompra"],
                    $result["PrecioVentaGeneral"],
                ));

                if ($body["estado"] == 1) {
                    $suministroUpdate->execute(array(
                        $result["Movimiento"],
                        $result["IdSuministro"],
                    ));

                    $suministroKardex->execute(array(
                        $result["IdSuministro"],
                        $body["fecha"],
                        $body["hora"],
                        $body["tipoAjuste"] ? 1 : 2,
                        $body["tipoMovimiento"],
                        $body["observacion"],
                        $result["Movimiento"],
                        $result["PrecioCompra"],
                        $result["PrecioCompra"] * $result["Movimiento"]
                    ));
                }
            }

            Database::getInstance()->getDb()->commit();
            return "inserted";
        } catch (PDOException $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    public static function ObtenerMovimientoInventarioById($idMovimiento)
    {
        try {
            $array = array();

            $comandoMovimiento = Database::getInstance()->getDb()->prepare("{call Sp_Get_Movimiento_Inventario_By_Id(?)}");
            $comandoMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
            $comandoMovimiento->execute();
            $resultMovimiento = $comandoMovimiento->fetchObject();
          
            $comandoMovimientoDetalle = Database::getInstance()->getDb()->prepare("{call Sp_Listar_Movimiento_Inventario_Detalle_By_Id(?)}");
            $comandoMovimientoDetalle->bindParam(1, $idMovimiento, PDO::PARAM_STR);
            $comandoMovimientoDetalle->execute();
            $resultMovimientoDetalle = array();
            $count = 0;
            while ($row = $comandoMovimientoDetalle->fetch()) {
                $count++;
                array_push($resultMovimientoDetalle, array(
                    "Id" => $count,
                    "IdMovimientoInventario" => $row["IdMovimientoInventario"],
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Cantidad" => $row["Cantidad"],
                    "Costo" => $row["Costo"],
                    "Precio" => $row["Precio"]
                ));
            }
            array_push($array, $resultMovimiento, $resultMovimientoDetalle);

            return $array;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function CancelarMovimientoById($idMovimiento)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("SELECT * FROM MovimientoInventarioTB WHERE IdMovimientoInventario = ? AND Estado = 2");
            $comando->bindParam(1, $idMovimiento, PDO::PARAM_STR);
            $comando->execute();
            if ($comando->fetch()) {
                Database::getInstance()->getDb()->rollback();
                return "exists";
            } else {
                $cmdMovimiento = Database::getInstance()->getDb()->prepare("SELECT TipoAjuste FROM MovimientoInventarioTB WHERE IdMovimientoInventario = ?");
                $cmdMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
                $cmdMovimiento->execute();
                $tipoMovimiento = $cmdMovimiento->fetchColumn();

                if ($tipoMovimiento == 0) {

                    $cmdDetalleMovimiento = Database::getInstance()->getDb()->prepare("SELECT IdSuministro,Cantidad,Costo FROM MovimientoInventarioDetalleTB WHERE IdMovimientoInventario = ?");
                    $cmdDetalleMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
                    $cmdDetalleMovimiento->execute();
                    $arrayDetalleMovimiento = array();
                    while ($row = $cmdDetalleMovimiento->fetch()) {
                        array_push($arrayDetalleMovimiento, array(
                            "IdSuministro" => $row["IdSuministro"],
                            "Cantidad" => $row["Cantidad"],
                            "Costo" => $row["Costo"],
                        ));
                    }

                    $cmdKardex = Database::getInstance()->getDb()->prepare("INSERT INTO 
                    KardexSuministroTB(
                    IdSuministro,
                    Fecha,
                    Hora,
                    Tipo,
                    Movimiento,
                    Detalle,
                    Cantidad, 
                    Costo, 
                    Total) 
                    VALUES(?,CAST(GETDATE() AS DATE),CAST(GETDATE() AS TIME),?,?,?,?,?,?)");

                    $cmdSuministro = Database::getInstance()->getDb()->prepare("UPDATE SuministroTB SET Cantidad = Cantidad + ? WHERE IdSuministro = ?");
                    foreach ($arrayDetalleMovimiento as $value) {
                        $cmdKardex->execute(array(
                            $value["IdSuministro"],
                            1,
                            2,
                            "CANCELAR MOVIMIENTO",
                            $value["Cantidad"],
                            $value["Costo"],
                            $value["Cantidad"] * $value["Costo"]
                        ));
                        $cmdSuministro->execute(array(
                            $value["Cantidad"],
                            $value["IdSuministro"]
                        ));
                    }

                    $cmdMovimiento = Database::getInstance()->getDb()->prepare("UPDATE MovimientoInventarioTB SET Estado = 2  WHERE IdMovimientoInventario = ?");
                    $cmdMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
                    $cmdMovimiento->execute();
                    Database::getInstance()->getDb()->commit();
                    return "deleted";
                } else {
                    $cmdDetalleMovimiento = Database::getInstance()->getDb()->prepare("SELECT IdSuministro,Cantidad,Costo FROM MovimientoInventarioDetalleTB WHERE IdMovimientoInventario = ?");
                    $cmdDetalleMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
                    $cmdDetalleMovimiento->execute();
                    $arrayDetalleMovimiento = array();
                    while ($row = $cmdDetalleMovimiento->fetch()) {
                        array_push($arrayDetalleMovimiento, array(
                            "IdSuministro" => $row["IdSuministro"],
                            "Cantidad" => $row["Cantidad"],
                            "Costo" => $row["Costo"],
                        ));
                    }

                    $cmdKardex = Database::getInstance()->getDb()->prepare("INSERT INTO 
                        KardexSuministroTB(
                        IdSuministro,
                        Fecha,
                        Hora,
                        Tipo,
                        Movimiento,
                        Detalle,
                        Cantidad, 
                        Costo, 
                        Total) 
                        VALUES(?,CAST(GETDATE() AS DATE),CAST(GETDATE() AS TIME),?,?,?,?,?,?)");

                    $cmdSuministro = Database::getInstance()->getDb()->prepare("UPDATE SuministroTB SET Cantidad = Cantidad - ? WHERE IdSuministro = ?");
                    foreach ($arrayDetalleMovimiento as $value) {
                        $cmdKardex->execute(array(
                            $value["IdSuministro"],
                            2,
                            1,
                            "CANCELAR MOVIMIENTO",
                            $value["Cantidad"],
                            $value["Costo"],
                            $value["Cantidad"] * $value["Costo"]
                        ));
                        $cmdSuministro->execute(array(
                            $value["Cantidad"],
                            $value["IdSuministro"]
                        ));
                    }

                    $cmdMovimiento = Database::getInstance()->getDb()->prepare("UPDATE MovimientoInventarioTB SET Estado = 2  WHERE IdMovimientoInventario = ?");
                    $cmdMovimiento->bindParam(1, $idMovimiento, PDO::PARAM_STR);
                    $cmdMovimiento->execute();
                    Database::getInstance()->getDb()->commit();
                    return "deleted";
                }
            }
        } catch (PDOException $e) {
            Database::getInstance()->getDb()->rollback();
            return $e->getMessage();
        }
    }

    

}
