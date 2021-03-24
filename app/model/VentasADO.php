<?php

require_once __DIR__ . './../database/DataBaseConexion.php';

class VentasADO
{

    function construct()
    {
    }

    public static function ListVentas($opcion, $value, $fechaInicial, $fechaFinal, $comprobante, $estado, $usuario, $posicionPagina, $filasPorPagina, $ruc)
    {
        $array = array();
        try {
            $comandoVenta = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ventas(?,?,?,?,?,?,?,?,?)}");
            $comandoVenta->bindParam(1, $opcion, PDO::PARAM_INT);
            $comandoVenta->bindParam(2, $value, PDO::PARAM_STR);
            $comandoVenta->bindParam(3, $fechaInicial, PDO::PARAM_STR);
            $comandoVenta->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $comandoVenta->bindParam(5, $comprobante, PDO::PARAM_INT);
            $comandoVenta->bindParam(6, $estado, PDO::PARAM_INT);
            $comandoVenta->bindParam(7, $usuario, PDO::PARAM_STR);
            $comandoVenta->bindParam(8, $posicionPagina, PDO::PARAM_INT);
            $comandoVenta->bindParam(9, $filasPorPagina, PDO::PARAM_INT);
            $comandoVenta->execute();
            $arrayVenta = array();
            $count = 0;
            while ($row = $comandoVenta->fetch()) {
                $count++;
                array_push($arrayVenta, array(
                    "id" => $count + $posicionPagina,
                    "IdVenta" => $row["IdVenta"],
                    "FechaVenta" => $row["FechaVenta"],
                    "HoraVenta" => $row["HoraVenta"],
                    "ApellidosVendedor" => $row["ApellidosVendedor"],
                    "NombresVendedor" => $row["NombresVendedor"],
                    "DocumentoCliente" => $row["DocumentoCliente"],
                    "Cliente" => $row["Cliente"],
                    "Comprobante" => $row["Comprobante"],
                    "TipoComprobante" => $row['TipoComprobante'],
                    "Serie" => $row["Serie"],
                    "Numeracion" => $row["Numeracion"],
                    "Tipo" => $row["Tipo"],
                    "Estado" => $row["Estado"],
                    "Simbolo" => $row["Simbolo"],
                    "NombreMoneda" => $row["NombreMoneda"],
                    "TipoMoneda" => $row["TipoMoneda"],
                    "Total" => $row["Total"],
                    "Observaciones" => $row["Observaciones"],
                    "Xmlsunat" => $row["Xmlsunat"],
                    "Xmldescripcion" => VentasADO::limitar_cadena($row["Xmldescripcion"], 100, "..."),
                    "IdNotaCredito" => $row["IdNotaCredito"],
                    "SerieNotaCredito" => $row["SerieNotaCredito"],
                    "NumeracionNotaCredito" => $row["NumeracionNotaCredito"]
                ));
            }

            $comandoTotal = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ventas_Count(?,?,?,?,?,?,?)}");
            $comandoTotal->bindParam(1, $opcion, PDO::PARAM_INT);
            $comandoTotal->bindParam(2, $value, PDO::PARAM_STR);
            $comandoTotal->bindParam(3, $fechaInicial, PDO::PARAM_STR);
            $comandoTotal->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $comandoTotal->bindParam(5, $comprobante, PDO::PARAM_INT);
            $comandoTotal->bindParam(6, $estado, PDO::PARAM_INT);
            $comandoTotal->bindParam(7, $usuario, PDO::PARAM_STR);
            $comandoTotal->execute();
            $resultTotal = $comandoTotal->fetchColumn();

            $comandoSuma = Database::getInstance()->getDb()->prepare("SELECT ISNULL(SUM(Total),0) FROM VentaTB as v left join NotaCreditoTB as nc on nc.IdVenta = v.IdVenta
            WHERE CAST(v.FechaVenta AS DATE) BETWEEN ? AND ? AND v.Tipo = 1 AND v.Estado = 1 and nc.IdNotaCredito is null");
            $comandoSuma->bindParam(1, $fechaInicial, PDO::PARAM_STR);
            $comandoSuma->bindParam(2, $fechaFinal, PDO::PARAM_STR);
            $comandoSuma->execute();
            $resultSuma = $comandoSuma->fetchColumn();

            array_push($array, $arrayVenta, $resultTotal, $resultSuma);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    private static function limitar_cadena($cadena, $limite, $sufijo)
    {
        if (strlen($cadena) > $limite) {
            return substr($cadena, 0, $limite) . $sufijo;
        }
        return $cadena;
    }

    public static function ListVentaDetalle($idventa)
    {
        try {
            $array = array();
            $venta = null;
            $empresa = null;
            $ventadetalle = array();

            $comandoVenta = Database::getInstance()->getDb()->prepare("{CALL Sp_Obtener_Venta_ById(?)}");
            $comandoVenta->bindParam(1, $idventa, PDO::PARAM_STR);
            $comandoVenta->execute();
            $venta = $comandoVenta->fetchObject();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            e.Telefono,e.Email,e.Image
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "Email" => $rowEmpresa['Email'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            $comandoVentaDetalle = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ventas_Detalle_By_Id(?)}");
            $comandoVentaDetalle->bindParam(1, $idventa, PDO::PARAM_STR);
            $comandoVentaDetalle->execute();
            $count = 0;
            while ($row = $comandoVentaDetalle->fetch()) {
                $count++;
                array_push($ventadetalle, array(
                    "id" => $count,
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Inventario" => $row["Inventario"],
                    "ValorInventario" => $row["ValorInventario"],
                    "ClaveSat" => $row["ClaveSat"],
                    "CodigoUnidad" => $row["CodigoUnidad"],
                    "UnidadCompra" => $row["UnidadCompra"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "CostoVenta" => floatval($row["CostoVenta"]),
                    "PrecioVenta" => floatval($row["PrecioVenta"]),
                    "Descuento" => floatval($row["Descuento"]),
                    "IdImpuesto" => $row["IdImpuesto"],
                    "NombreImpuesto" => $row["NombreImpuesto"],
                    "ValorImpuesto" => floatval($row["ValorImpuesto"]),
                    "Codigo" => $row["Codigo"]
                ));
            }
            array_push($array, $venta, $ventadetalle, $empresa);
            return $array;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }


    public static function ResumenIngresoPorFechas($fechaInicio, $fechaFinal)
    {
        try {
            $array = array();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            e.Telefono,e.Email,e.Image
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "Email" => $rowEmpresa['Email'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            $arrayIngresos = array();

            $cmdIngresos = Database::getInstance()->getDb()->prepare("SELECT 
            case TipoMovimiento
            when 2 then 'VENTAS EN EFECTIVO'
            when 3 then 'VENTAS CON TARJETA'
            when 4 then 'INGRESO EN EFECTIVO'
            when 5 then 'SALIDA EN EFECTIVO'
            when 6 then 'SALIDA CON TARJETA'
            else 'APERTURA DE CAJA'
            end as Concepto,
            TipoMovimiento,
            case TipoMovimiento
            when 0 then sum(Monto)
            when 1 then sum(Monto)
            when 2 then sum(Monto)
            when 3 then sum(Monto)
            when 4 then sum(Monto)
            else 0
            end as Ingresos, 
            case TipoMovimiento
            when 5 then sum(Monto)
            when 6 then sum(Monto)
            else 0
            end as Egresos
            from MovimientoCajaTB
            where FechaMovimiento between ? and ?
            group by TipoMovimiento");
            $cmdIngresos->bindValue(1, $fechaInicio, PDO::PARAM_STR);
            $cmdIngresos->bindValue(2, $fechaFinal, PDO::PARAM_STR);
            $cmdIngresos->execute();

            while ($row = $cmdIngresos->fetch()) {
                array_push($arrayIngresos, $row);
            }

            array_push($array, $empresa, $arrayIngresos);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ResumenUtilidadPorFecha($fechaInicio, $fechaFinal)
    {
        try {
            $array = array();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            e.Telefono,e.Email,e.Image
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "Email" => $rowEmpresa['Email'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            $cmdUtilidad = Database::getInstance()->getDb()->prepare("SELECT 
            a.IdSuministro,
            a.Clave, 
            a.NombreMarca,
            v.Estado,
            dbo.Fc_Obtener_Nombre_Detalle(a.UnidadCompra,'0013') as UnidadCompraNombre,
            case
                when a.ValorInventario = 1 then dv.Cantidad
                when a.ValorInventario = 2 then dv.Cantidad
                when a.ValorInventario = 3 then dv.Cantidad
            end as Cantidad, 
            dv.CostoVenta as Costo,
            case
                when a.ValorInventario = 1 then dv.Cantidad * dv.CostoVenta
                when a.ValorInventario = 2 then dv.Cantidad * dv.CostoVenta
                when a.ValorInventario = 3 then dv.Cantidad * dv.CostoVenta
            end as CostoTotal,
            dv.PrecioVenta as Precio, 
            case 
                when a.ValorInventario = 1 then dv.Cantidad * dv.PrecioVenta
                when a.ValorInventario = 2 then dv.Cantidad * dv.PrecioVenta
                when a.ValorInventario = 3 then dv.Cantidad * dv.PrecioVenta
            end as PrecioTotal,
            case
                when a.ValorInventario = 1 then (dv.Cantidad * dv.PrecioVenta )- (dv.Cantidad * dv.CostoVenta )
                when a.ValorInventario = 2 then (dv.Cantidad * dv.PrecioVenta )- (dv.Cantidad * dv.CostoVenta )
                when a.ValorInventario = 3 then (dv.Cantidad * dv.PrecioVenta )- (dv.Cantidad * dv.CostoVenta )
            end as Utilidad,a.ValorInventario, m.Simbolo
                    from DetalleVentaTB as dv
                    inner join SuministroTB as a on dv.IdArticulo = a.IdSuministro 
                    inner join VentaTB as v on v.IdVenta = dv.IdVenta
                    left join NotaCreditoTB as nc on nc.IdVenta = v.IdVenta
                    inner join MonedaTB as m on m.IdMoneda = v.Moneda
                    where v.FechaVenta between ? and ? and v.Estado <> 3 and nc.IdNotaCredito is null	
                    order by a.NombreMarca asc");
            $cmdUtilidad->bindValue(1, $fechaInicio, PDO::PARAM_STR);
            $cmdUtilidad->bindValue(2, $fechaFinal, PDO::PARAM_STR);
            $cmdUtilidad->execute();

            $arrayUtilidad = array();
            while ($row = $cmdUtilidad->fetch()) {
                array_push($arrayUtilidad, array(
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Estado" => $row["Estado"],
                    "UnidadCompraNombre" => $row["UnidadCompraNombre"],

                    "Cantidad" => floatval($row["Cantidad"]),

                    "Costo" => floatval($row["Costo"]),
                    "CostoTotal" => floatval($row["CostoTotal"]),

                    "Precio" => floatval($row["Precio"]),
                    "PrecioTotal" => floatval($row["PrecioTotal"]),

                    "Utilidad" => floatval($row["Utilidad"])
                ));
            }

            // $arrayNuevo = array();
            // for ($i = 0; $i < count($arrayUtilidad); $i++) {
            //     if (VentasADO::ValidateDuplicate($arrayNuevo, $arrayUtilidad[$i]["IdSuministro"])) {
            //         for ($j = 0; $j < count($arrayNuevo); $j++) {
            //             if ($arrayNuevo[$j]["IdSuministro"] === $arrayUtilidad[$i]["IdSuministro"] && $arrayNuevo[$j]["Precio"] === $arrayUtilidad[$i]["Precio"]) {
            //                 $arrayNuevo[$j]["Cantidad"] += $arrayUtilidad[$i]["Cantidad"];

            //                 $arrayNuevo[$j]["Costo"] = $arrayUtilidad[$i]["Costo"];
            //                 $arrayNuevo[$j]["CostoTotal"] += $arrayUtilidad[$i]["CostoTotal"];

            //                 $arrayNuevo[$j]["Precio"] = $arrayUtilidad[$i]["Precio"];
            //                 $arrayNuevo[$j]["PrecioTotal"] += $arrayUtilidad[$i]["PrecioTotal"];

            //                 $arrayNuevo[$j]["Utilidad"] += $arrayUtilidad[$i]["Utilidad"];                     

            //             }else{
            //                 array_push($arrayNuevo,  $arrayUtilidad[$i]);
            //                 break;
            //             }
            //         }
            //     } else {
            //         array_push($arrayNuevo,  $arrayUtilidad[$i]);
            //     }
            // }

            array_push($array, $empresa, $arrayUtilidad);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ResumenProductoVendidos($fechaInicio, $fechaFinal, $marca, $categoria)
    {
        try {
            $cmdProductos = Database::getInstance()->getDb()->prepare("SELECT 
            a.IdSuministro,
            a.Clave, 
            a.NombreMarca,         
            sum(dv.Cantidad) as Cantidad, 
            sum(dv.Cantidad*dv.CostoVenta) as CostoTotal,
			sum(dv.Cantidad*dv.PrecioVenta) as PrecioTotal,
			ds.Nombre as Medida,
            sum((dv.Cantidad * dv.PrecioVenta )- (dv.Cantidad * dv.CostoVenta )) as Utilidad
                    from DetalleVentaTB as dv
                    inner join SuministroTB as a on dv.IdArticulo = a.IdSuministro 
					inner join DetalleTB as ds on ds.IdDetalle = a.UnidadCompra and ds.IdMantenimiento = '0013'
                    inner join VentaTB as v on v.IdVenta = dv.IdVenta
                    left join NotaCreditoTB as nc on nc.IdVenta = v.IdVenta
                    inner join MonedaTB as m on m.IdMoneda = v.Moneda
                    where v.FechaVenta between ? and ? and  v.Estado <> 3 and ? = 0 and ? = 0 and nc.IdNotaCredito is null
                    or v.FechaVenta between ? and ? and  v.Estado <> 3	and a.Marca = ? and  ? = 0 and nc.IdNotaCredito is null
                    or v.FechaVenta between ? and ? and  v.Estado <> 3	and ? = 0  and a.Categoria = ? and nc.IdNotaCredito is null
                    or v.FechaVenta between ? and ? and  v.Estado <> 3	and a.Marca = ? and a.Categoria = ? and nc.IdNotaCredito is null
					group by   
					a.IdSuministro,
                    a.Clave, 
                    a.NombreMarca,
			        ds.Nombre	
                    order by Utilidad desc,Cantidad desc, Medida asc");
            $cmdProductos->bindValue(1, $fechaInicio, PDO::PARAM_STR);
            $cmdProductos->bindValue(2, $fechaFinal, PDO::PARAM_STR);
            $cmdProductos->bindValue(3, $marca, PDO::PARAM_INT);
            $cmdProductos->bindValue(4, $categoria, PDO::PARAM_INT);

            $cmdProductos->bindValue(5, $fechaInicio, PDO::PARAM_STR);
            $cmdProductos->bindValue(6, $fechaFinal, PDO::PARAM_STR);
            $cmdProductos->bindValue(7, $marca, PDO::PARAM_INT);
            $cmdProductos->bindValue(8, $categoria, PDO::PARAM_INT);

            $cmdProductos->bindValue(9, $fechaInicio, PDO::PARAM_STR);
            $cmdProductos->bindValue(10, $fechaFinal, PDO::PARAM_STR);
            $cmdProductos->bindValue(11, $marca, PDO::PARAM_INT);
            $cmdProductos->bindValue(12, $categoria, PDO::PARAM_INT);

            $cmdProductos->bindValue(13, $fechaInicio, PDO::PARAM_STR);
            $cmdProductos->bindValue(14, $fechaFinal, PDO::PARAM_STR);
            $cmdProductos->bindValue(15, $marca, PDO::PARAM_INT);
            $cmdProductos->bindValue(16, $categoria, PDO::PARAM_INT);

            $cmdProductos->execute();
            $arrayDetalle = array();
            $count = 0;
            while ($row = $cmdProductos->fetch()) {
                $count++;
                array_push($arrayDetalle, array(
                    "Id"=>$count,
                    "IdSuministro" => $row["IdSuministro"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Cantidad" => floatval($row["Cantidad"]),
                    "CostoTotal" => floatval($row["CostoTotal"]),
                    "PrecioTotal" => floatval($row["PrecioTotal"]),
                    "Medida" => $row["Medida"],
                    "Utilidad" => floatval($row["Utilidad"])
                ));
            }
            return $arrayDetalle;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ResumenGeneral($fechaInicial, $fechaFinal)
    {
        try {
            $array = array();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            e.Telefono,e.Email,e.Image
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "Email" => $rowEmpresa['Email'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            array_push($array, $empresa);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function TopProductoVendidos($fechaInicial, $fechaFinal)
    {
        try {
            $array = array();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            e.Telefono,e.Email,e.Image
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $rowEmpresa = $cmdEmpresa->fetch();
            $empresa  = (object)array(
                "IdAuxiliar" => $rowEmpresa['IdAuxiliar'],
                "NumeroDocumento" => $rowEmpresa['NumeroDocumento'],
                "RazonSocial" => $rowEmpresa['RazonSocial'],
                "NombreComercial" => $rowEmpresa['NombreComercial'],
                "Domicilio" => $rowEmpresa['Domicilio'],
                "Telefono" => $rowEmpresa['Telefono'],
                "Email" => $rowEmpresa['Email'],
                "Image" => $rowEmpresa['Image'] == null ? "" : base64_encode($rowEmpresa['Image'])
            );

            $cmdTopVentas = Database::getInstance()->getDb()->prepare("SELECT 
            c.NumeroDocumento,
            c.Informacion ,
            count(v.IdVenta) as NumeroVentas ,
            sum(dv.Cantidad*dv.PrecioVenta) as MontoComprado
            from 
            ClienteTB as c 
            inner join VentaTB as v on c.IdCliente = v.Cliente
            inner join DetalleVentaTB as dv on dv.IdVenta = v.IdVenta
            where v.Estado <> 3 and v.FechaVenta between ? and ?
            group by c.NumeroDocumento,c.Informacion
            order by MontoComprado desc,NumeroVentas desc");
            $cmdTopVentas->bindValue(1, $fechaInicial, PDO::PARAM_STR);
            $cmdTopVentas->bindValue(2, $fechaFinal, PDO::PARAM_STR);
            $cmdTopVentas->execute();

            $count = 0;
            $arrayDetalle = array();
            while ($row = $cmdTopVentas->fetch()) {
                $count++;
                array_push($arrayDetalle, array(
                    "Id" => $count,
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "NumeroVentas" => $row["NumeroVentas"],
                    "MontoComprado" => floatval($row["MontoComprado"])
                ));
            }
            array_push($array, $empresa, $arrayDetalle);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ValidateDuplicate($array, $idProducto)
    {
        $ret = false;
        foreach ($array as $value) {
            if ($value["IdSuministro"] == $idProducto) {
                $ret = true;
                break;
            }
        }
        return $ret;
    }


    public static function LoadDashboard($fecha)
    {

        $array = array();

        try {

            $comandoTotalVentas = Database::getInstance()->getDb()->prepare("SELECT sum(Total) FROM VentaTB 
            WHERE FechaVenta = ? AND Estado = 1");
            $comandoTotalVentas->bindParam(1, $fecha, PDO::PARAM_STR);
            $comandoTotalVentas->execute();

            $comandoTotalCompras = Database::getInstance()->getDb()->prepare("SELECT isnull(sum(d.Importe),0) 
            FROM CompraTB AS c INNER JOIN DetalleCompraTB AS d
            ON d.IdCompra = c.IdCompra WHERE c.FechaCompra = ? AND c.EstadoCompra = 1");
            $comandoTotalCompras->bindParam(1, $fecha, PDO::PARAM_STR);
            $comandoTotalCompras->execute();

            $comantoTotalCuentasCobrar = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) 
            FROM VentaTB WHERE Tipo = 2 AND Estado = 2");
            $comantoTotalCuentasCobrar->execute();

            $comantoTotalCuentasPagar = Database::getInstance()->getDb()->prepare("SELECT COUNT(*) FROM CompraTB WHERE TipoCompra = 2 AND EstadoCompra = 2");
            $comantoTotalCuentasPagar->execute();

            $comandoProductosMasVendidos = Database::getInstance()->getDb()->prepare("SELECT  TOP 10
            dt.IdArticulo, 
            s.NombreMarca, 
            s.NuevaImagen as NuevaImagen,
            SUM(dt.Cantidad) as Cantidad,
            d.Nombre as Medida
                    from DetalleVentaTB as dt 
                    inner join VentaTB as v on v.IdVenta=dt.IdVenta
                    inner join SuministroTB as s on dt.IdArticulo=s.IdSuministro 
                    inner join DetalleTB as d on d.IdDetalle = s.UnidadCompra and d.IdMantenimiento = '0013'
                    where MONTH(v.FechaVenta) = MONTH(GETDATE()) AND YEAR(v.FechaVenta) = YEAR(GETDATE()) 
                    group by dt.IdArticulo, s.NombreMarca, NuevaImagen,d.Nombre
                    order by Cantidad DESC");
            $comandoProductosMasVendidos->execute();

            $arrayProductosMasVendidos = array();
            while ($rows = $comandoProductosMasVendidos->fetch()) {
                array_push($arrayProductosMasVendidos, array(
                    "IdArticulo" => $rows["IdArticulo"],
                    "NombreMarca" => $rows["NombreMarca"],
                    "Cantidad" => $rows["Cantidad"],
                    "Medida" => $rows["Medida"],
                    "Imagen" => ($rows["NuevaImagen"] != null ? base64_encode($rows["NuevaImagen"]) : '')
                ));
            }

            $date = new DateTime($fecha);

            $comandoVentasMesActual = Database::getInstance()->getDb()->prepare("SELECT 
            month(vt.FechaVenta) as Mes, 
            sum(vt.Total) AS Monto
            FROM VentaTB AS vt left join NotaCreditoTB as nc on nc.IdVenta = vt.IdVenta
            where vt.Estado <> 3 and nc.IdNotaCredito is null and year(vt.FechaVenta) = 2021
            GROUP BY month(vt.FechaVenta)");
            $comandoVentasMesActual->bindValue(1, $date->format('Y'), PDO::PARAM_STR);
            $comandoVentasMesActual->execute();
            $arrayVentaMesActual = array();
            while ($row = $comandoVentasMesActual->fetch()) {
                array_push($arrayVentaMesActual, array(
                    "Mes" => $row["Mes"],
                    "Monto" => floatval($row["Monto"]),
                ));
            }

            $comandoVentasMesAnterior = Database::getInstance()->getDb()->prepare("SELECT 
            month(vt.FechaVenta) as Mes, 
            sum(vt.Total) AS Monto
            FROM VentaTB AS vt left join NotaCreditoTB as nc on nc.IdVenta = vt.IdVenta
            where vt.Estado <> 3 and nc.IdNotaCredito is null and year(vt.FechaVenta) = ?
            GROUP BY month(vt.FechaVenta)");
            $date->modify('-1 year');
            $comandoVentasMesAnterior->bindValue(1, $date->format('Y'), PDO::PARAM_STR);
            $comandoVentasMesAnterior->execute();
            $arrayVentaMesAnterior = array();
            while ($row = $comandoVentasMesAnterior->fetch()) {
                array_push($arrayVentaMesAnterior, array(
                    "Mes" => $row["Mes"],
                    "Monto" => floatval($row["Monto"]),
                ));
            }
            //
            array_push($array, array(
                "TotalVentas" => $comandoTotalVentas->fetchColumn(),
                "TotalCompras" => $comandoTotalCompras->fetchColumn(),
                "TotalCuentasCobrar" => $comantoTotalCuentasCobrar->fetchColumn(),
                "TotalCuentasPagar" => $comantoTotalCuentasPagar->fetchColumn(),
                "ProductosMasVendidos" => $arrayProductosMasVendidos,
                "VentasMesActual" => $arrayVentaMesActual,
                "VentasMesAnterior" => $arrayVentaMesAnterior
            ));

            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public static function LoadProductosAgotados($posicionPaginaAgotados, $filasPorPaginaAgotados)
    {
        try {
            $array = array();
            $comandoProductosAgotados = Database::getInstance()->getDb()->prepare("SELECT NombreMarca, PrecioVentaGeneral, Cantidad 
            FROM SuministroTB 
            WHERE Cantidad <= 0 
            ORDER BY Cantidad ASC offset ? ROWS FETCH NEXT ? ROWS ONLY");
            $comandoProductosAgotados->bindParam(1, $posicionPaginaAgotados, PDO::PARAM_INT);
            $comandoProductosAgotados->bindParam(2, $filasPorPaginaAgotados, PDO::PARAM_INT);
            $comandoProductosAgotados->execute();
            $arrayProductosAgotados = array();
            while ($rows = $comandoProductosAgotados->fetch()) {
                array_push($arrayProductosAgotados, array(
                    "NombreProducto" => $rows["NombreMarca"],
                    "Pecio" => $rows["PrecioVentaGeneral"],
                    "Cantidad" => $rows["Cantidad"],
                ));
            }
            $comandoProductosAgotadosCount = Database::getInstance()->getDb()->prepare("SELECT COUNT(*)
            FROM SuministroTB WHERE Cantidad <= 0 ");
            $comandoProductosAgotadosCount->execute();
            $resultTotal = $comandoProductosAgotadosCount->fetchColumn();
            array_push($array, $arrayProductosAgotados, $resultTotal);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function LoadProductosPorAgotarse($posicionPaginaPorAgotarse, $filasPorPaginaPorAgotarse)
    {
        try {
            $array = array();
            $comandoProductosPorAgotarse = Database::getInstance()->getDb()->prepare("SELECT NombreMarca, PrecioVentaGeneral, Cantidad FROM SuministroTB
            WHERE Cantidad > 0 AND Cantidad < StockMinimo
            ORDER BY cantidad ASC offset ? ROWS FETCH NEXT ? ROWS ONLY");
            $comandoProductosPorAgotarse->bindParam(1, $posicionPaginaPorAgotarse, PDO::PARAM_INT);
            $comandoProductosPorAgotarse->bindParam(2, $filasPorPaginaPorAgotarse, PDO::PARAM_INT);
            $comandoProductosPorAgotarse->execute();

            $arrayProductosPorAgotarse = array();
            while ($rows = $comandoProductosPorAgotarse->fetch()) {
                array_push($arrayProductosPorAgotarse, array(
                    "NombreProducto" => $rows["NombreMarca"],
                    "Pecio" => $rows["PrecioVentaGeneral"],
                    "Cantidad" => $rows["Cantidad"],
                ));
            }

            $comandoProductosAgotadosCount = Database::getInstance()->getDb()->prepare("SELECT COUNT(*)
            FROM SuministroTB WHERE Cantidad > 0 AND Cantidad < StockMinimo");
            $comandoProductosAgotadosCount->execute();
            $resultTotal = $comandoProductosAgotadosCount->fetchColumn();
            array_push($array, $arrayProductosPorAgotarse, $resultTotal);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public static function ListarDetalleVentPorId($idVenta)
    {
        try {
            $lista = array();
            $resultVenta = null;
            $detalleventa = array();
            $opegravada = 0;
            $opeexogenerada = 0;
            $totalsinimpuesto = 0;
            $numeroitems = 0;
            $impuesto = 0;
            $resultEmpresa = null;
            $resultCliente = null;

            $cmdVenta = Database::getInstance()->getDb()->prepare("SELECT 
                dbo.Fc_Obtener_Nombre_Moneda(v.Moneda) as NombreMoneda,
		        dbo.Fc_Obtener_Abreviatura_Moneda(v.Moneda) as TipoMoneda,
                td.CodigoAlterno as TipoComprobante,
                v.Serie,v.Numeracion,v.FechaVenta,v.HoraVenta,
                ISNULL(v.Correlativo,0) as Correlativo
                FROM VentaTB as v inner join TipoDocumentoTB as td 
                on v.Comprobante = td.IdTipoDocumento
                WHERE v.IdVenta = ?");
            $cmdVenta->bindParam(1, $idVenta, PDO::PARAM_STR);
            $cmdVenta->execute();
            $resultVenta = $cmdVenta->fetchObject();

            $cmdCorrelativo = Database::getInstance()->getDb()->prepare("SELECT MAX(ISNULL(Correlativo,0)) as Correlativo FROM VentaTB WHERE FechaCorrelativo = CAST(GETDATE() AS DATE)");
            $cmdCorrelativo->execute();
            $resultCorrelativo = $cmdCorrelativo->fetchColumn();

            $cmdDetail = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_Ventas_Detalle_By_Id(?)}");
            $cmdDetail->bindParam(1, $idVenta, PDO::PARAM_STR);
            $cmdDetail->execute();
            $count = 0;

            while ($rowdetailt = $cmdDetail->fetch()) {
                $count++;
                $numeroitems++;
                array_push($detalleventa, array(
                    "Id" => $count,
                    "Clave" => $rowdetailt["Clave"],
                    "NombreMarca" => $rowdetailt["NombreMarca"],
                    "ClaveSat" => $rowdetailt["ClaveSat"],
                    "CodigoUnidad" => $rowdetailt["CodigoUnidad"],
                    "Cantidad" => $rowdetailt["Cantidad"],
                    "PrecioVenta" => $rowdetailt["PrecioVenta"],
                    "Descuento" => $rowdetailt["Descuento"],
                    "ValorImpuesto" => $rowdetailt["ValorImpuesto"],
                    "Codigo" => $rowdetailt["Codigo"],
                    "Numeracion" => $rowdetailt["Numeracion"],
                    "NombreImpuesto" => $rowdetailt["NombreImpuesto"],
                    "Letra" => $rowdetailt["Letra"],
                    "Categoria" => $rowdetailt["Categoria"]
                ));
            }

            foreach ($detalleventa as $value) {
                $cantidad = $value['Cantidad'];
                $valorImpuesto = $value['ValorImpuesto'];
                $precioBruto = $value['PrecioVenta'] / (($valorImpuesto / 100.00) + 1);

                $opegravada +=  $valorImpuesto == 0 ? 0 : $cantidad * $precioBruto;
                $opeexogenerada += $valorImpuesto == 0 ? $cantidad * $precioBruto : 0;

                $totalsinimpuesto += $cantidad * $precioBruto;
                $impuesto += $cantidad  * ($precioBruto * ($valorImpuesto / 100.00));
            }

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            dbo.Fc_Obtener_Ubigeo(Ubigeo) as CodigoUbigeo,
            dbo.Fc_Obtener_Departamento(Ubigeo) as Departamento,
            dbo.Fc_Obtener_Provincia(Ubigeo) as Provincia,
            dbo.Fc_Obtener_Distrito(Ubigeo) as Distrito,
            e.Telefono,e.Email,
            e.UsuarioSol,e.ClaveSol 
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $resultEmpresa = $cmdEmpresa->fetchObject();

            $cmdCliente = Database::getInstance()->getDb()->prepare("SELECT d.IdAuxiliar,c.NumeroDocumento,c.Informacion
            FROM ClienteTB AS c INNER JOIN VentaTB AS v ON c.IdCliente = v.Cliente
            INNER JOIN DetalleTB as d on c.TipoDocumento = d.IdDetalle and d.IdMantenimiento = '0003'
            WHERE v.IdVenta = ? ");
            $cmdCliente->bindParam(1, $idVenta, PDO::PARAM_STR);
            $cmdCliente->execute();
            $resultCliente = $cmdCliente->fetchObject();

            array_push($lista, array(
                "opgravada" => $opegravada,
                "opexonerada" =>   $opeexogenerada,
                "totalsinimpuesto" => $totalsinimpuesto,
                "totalimpuesto" => $impuesto,
                "totalconimpuesto" => $totalsinimpuesto + $impuesto,
                "numeroitems" => $numeroitems,
                "detalle" => $detalleventa
            ), $resultEmpresa, $resultCliente, $resultVenta, $resultCorrelativo);

            return $lista;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatVenta($idVenta, $codigo, $descripcion, $hash, $xmlgenerado)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE VentaTB SET 
            Xmlsunat = ? , Xmldescripcion = ?, CodigoHash = ?,Xmlgenerado = ? WHERE IdVenta = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $hash, PDO::PARAM_STR);
            $comando->bindParam(4, $xmlgenerado, PDO::PARAM_STR);
            $comando->bindParam(5, $idVenta, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatVentaUnico($idVenta, $codigo, $descripcion, $hash)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE VentaTB SET 
            Xmlsunat = ? , Xmldescripcion = ?, CodigoHash = ? WHERE IdVenta = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $hash, PDO::PARAM_STR);
            $comando->bindParam(4, $idVenta, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatNotaCredito($idNotaCredito, $codigo, $descripcion, $hash, $xmlgenerado)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE NotaCreditoTB SET 
            Xmlsunat = ? , Xmldescripcion = ?, CodigoHash = ?,Xmlgenerado = ?  WHERE IdNotaCredito = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $hash, PDO::PARAM_STR);
            $comando->bindParam(4, $xmlgenerado, PDO::PARAM_STR);
            $comando->bindParam(5, $idNotaCredito, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatNotaCreditoUnico($idNotaCredito, $codigo, $descripcion, $hash)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE NotaCreditoTB SET 
            Xmlsunat = ? , Xmldescripcion = ?, CodigoHash = ?  WHERE IdNotaCredito = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $hash, PDO::PARAM_STR);
            $comando->bindParam(4, $idNotaCredito, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function CambiarEstadoSunatResumen($idVenta, $codigo, $descripcion, $hash, $correlativo, $fechaCorrelativo)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();
            $comando = Database::getInstance()->getDb()->prepare("UPDATE VentaTB SET 
              Xmlsunat = ? , Xmldescripcion = ?, CodigoHash = ?,Correlativo=?,FechaCorrelativo=? WHERE IdVenta = ?");
            $comando->bindParam(1, $codigo, PDO::PARAM_STR);
            $comando->bindParam(2, $descripcion, PDO::PARAM_STR);
            $comando->bindParam(3, $hash, PDO::PARAM_STR);
            $comando->bindParam(4, $correlativo, PDO::PARAM_INT);
            $comando->bindParam(5, $fechaCorrelativo, PDO::PARAM_STR);
            $comando->bindParam(6, $idVenta, PDO::PARAM_STR);
            $comando->execute();
            Database::getInstance()->getDb()->commit();
            return "updated";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function GetReporteGeneralVentas($fechaInicial, $fechaFinal, $facturado)
    {
        try {
            $array = array();
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Generar_Excel_Ventas(?,?,?)}");
            $comando->bindParam(1, $fechaInicial, PDO::PARAM_STR);
            $comando->bindParam(2, $fechaFinal, PDO::PARAM_STR);
            $comando->bindParam(3, $facturado, PDO::PARAM_BOOL);
            $comando->execute();
            $count = 0;
            while ($row = $comando->fetch()) {
                $count++;
                array_push($array, array(
                    "Id" => $count,
                    "IdVenta" => $row["IdVenta"],
                    "Nombre" => $row["Nombre"],
                    "TipoComprobante" => $row["TipoComprobante"],
                    "Serie" => $row["Serie"],
                    "Numeracion" => $row["Numeracion"],
                    "FechaVenta" => $row["FechaVenta"],
                    "TipoDocumento" => $row["TipoDocumento"],
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "Estado" => $row["TipoEstado"],
                    "Base" => floatval($row["Base"]),
                    "Igv" => floatval($row["Igv"]),
                    "Xmlsunat" => $row["Xmlsunat"],
                    "Xmldescripcion" => $row["Xmldescripcion"]
                ));
            }
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function GetReporteGenelNotaCredito($fechaInicial, $fechaFinal)
    {
        try {
            $array = array();
            $comando = Database::getInstance()->getDb()->prepare("{CALL Sp_Generar_Excel_NotaCredito(?,?)}");
            $comando->bindParam(1, $fechaInicial, PDO::PARAM_STR);
            $comando->bindParam(2, $fechaFinal, PDO::PARAM_STR);
            $comando->execute();
            $count = 0;
            while ($row = $comando->fetch()) {
                $count++;
                array_push($array, array(
                    "Id" => $count,
                    "IdNotaCredito" => $row["IdNotaCredito"],
                    "TipoComprobante" => $row["TipoComprobante"],
                    "Serie" => $row["Serie"],
                    "Numeracion" => $row["Numeracion"],
                    "FechaRegistro" => $row["FechaRegistro"],
                    "TipoDocumento" => $row["TipoDocumento"],
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "Estado" => $row["TipoEstado"],
                    "Base" => $row["Base"],
                    "Igv" => $row["Igv"],
                    "CodigoAnulacion" => $row["CodigoAnulacion"],
                    "ComprobateModificado" => $row["ComprobateModificado"],
                    "MotivoAnulacion" => $row["MotivoAnulacion"],
                    "Xmlsunat" => $row["Xmlsunat"],
                    "Xmldescripcion" => $row["Xmldescripcion"]
                ));
            }
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public static function ListarComprobanteParaNotaCredito($comprobante)
    {
        try {
            $array = array();

            $cmdNotaCredito = Database::getInstance()->getDb()->prepare("SELECT IdTipoDocumento,Nombre FROM TipoDocumentoTB WHERE NotaCredito = 1");
            $cmdNotaCredito->execute();

            $arrayNotaCredito = array();
            while ($row = $cmdNotaCredito->fetch()) {
                array_push($arrayNotaCredito, array(
                    "IdTipoDocumento" => $row["IdTipoDocumento"],
                    "Nombre" => $row["Nombre"]
                ));
            }

            $cmdMoneda = Database::getInstance()->getDb()->prepare("SELECT IdMoneda,Nombre,Predeterminado FROM MonedaTB");
            $cmdMoneda->execute();

            $arrayMoneda = array();
            while ($row = $cmdMoneda->fetch()) {
                array_push($arrayMoneda, array(
                    "IdMoneda" => $row["IdMoneda"],
                    "Nombre" => $row["Nombre"],
                    "Predeterminado" => $row["Predeterminado"]
                ));
            }


            $cmdTipoComprobante = Database::getInstance()->getDb()->prepare("SELECT IdTipoDocumento,Nombre FROM TipoDocumentoTB");
            $cmdTipoComprobante->execute();

            $arrayTipoComprobante = array();
            while ($row = $cmdTipoComprobante->fetch()) {
                array_push($arrayTipoComprobante, array(
                    "IdTipoDocumento" => $row["IdTipoDocumento"],
                    "Nombre" => $row["Nombre"]
                ));
            }

            $cmdMotivoAnulacion = Database::getInstance()->getDb()->prepare("SELECT IdDetalle,Nombre FROM DetalleTB WHERE IdMantenimiento = '0019'");
            $cmdMotivoAnulacion->execute();
            $arrayMotivoAnulacion = array();
            while ($row = $cmdMotivoAnulacion->fetch()) {
                array_push($arrayMotivoAnulacion, array(
                    "IdDetalle" => $row["IdDetalle"],
                    "Nombre" => $row["Nombre"],
                ));
            }

            $cmdTipoDocumento = Database::getInstance()->getDb()->prepare("SELECT IdDetalle,Nombre FROM DetalleTB WHERE IdMantenimiento = '0003'");
            $cmdTipoDocumento->execute();

            $arrayTipoDocumento = array();
            while ($row = $cmdTipoDocumento->fetch()) {
                array_push($arrayTipoDocumento, array(
                    "IdDetalle" => $row["IdDetalle"],
                    "Nombre" => $row["Nombre"],
                ));
            }

            $cmdVenta = Database::getInstance()->getDb()->prepare("SELECT 
            v.IdVenta,
            v.Comprobante,
            v.Serie,
            v.Numeracion,
            c.IdCliente,
            c.TipoDocumento,
            c.NumeroDocumento,
            c.Informacion,
            c.Direccion,
            c.Celular,
            c.Email 
            FROM VentaTB AS v INNER JOIN ClienteTB AS c ON c.IdCliente = v.Cliente
            WHERE CONCAT(v.Serie,'-',v.Numeracion) = ? ");
            $cmdVenta->bindValue(1, $comprobante, PDO::PARAM_STR);
            $cmdVenta->execute();
            $resultVenta = $cmdVenta->fetchObject();

            $cmdDetalle = Database::getInstance()->getDb()->prepare("SELECT 
            dv.IdVenta,
            dv.IdArticulo,
            s.Clave,
            s.NombreMarca,
            isnull(d.Nombre,'') UnidadMarca,
            dv.Cantidad,
            dv.PrecioVenta,
            dv.Descuento,
            dv.ValorImpuesto,
            dv.NombreImpuesto 
            FROM DetalleVentaTB AS dv 
            INNER JOIN SuministroTB AS s ON s.IdSuministro = dv.IdArticulo
            LEFT JOIN DetalleTB AS d ON d.IdDetalle = s.UnidadCompra AND d.IdMantenimiento = '0013'
            WHERE dv.IdVenta = ?");
            $cmdDetalle->bindValue(1, $resultVenta->IdVenta, PDO::PARAM_STR);
            $cmdDetalle->execute();

            $arrayDetalle = array();
            while ($row = $cmdDetalle->fetch()) {
                array_push($arrayDetalle, array(
                    "IdVenta" => $row["IdVenta"],
                    "IdArticulo" => $row["IdArticulo"],
                    "Clave" => $row["Clave"],
                    "NombreMarca" => $row["NombreMarca"],
                    "UnidadMarca" => $row["UnidadMarca"],
                    "Cantidad" => $row["Cantidad"],
                    "PrecioVenta" => $row["PrecioVenta"],
                    "Descuento" => $row["Descuento"],
                    "ValorImpuesto" => $row["ValorImpuesto"],
                    "NombreImpuesto" => $row["NombreImpuesto"]
                ));
            }

            array_push($array, $arrayNotaCredito,  $arrayMoneda, $arrayTipoComprobante, $arrayMotivoAnulacion, $arrayTipoDocumento, $resultVenta, $arrayDetalle);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function RegistrarNotaCredito($body)
    {
        try {
            Database::getInstance()->getDb()->beginTransaction();

            $cmdCodigoNotaCredito = Database::getInstance()->getDb()->prepare("SELECT dbo.Fc_NotaCredito_Codigo_Alfanumerico();");
            $cmdCodigoNotaCredito->execute();
            $codigoNotaCredito = $cmdCodigoNotaCredito->fetchColumn();

            $cmdSerieNumeracion = Database::getInstance()->getDb()->prepare("SELECT dbo.Fc_Serie_Numero(?)");
            $cmdSerieNumeracion->bindValue(1, $body["IdNotaCredito"], PDO::PARAM_INT);
            $cmdSerieNumeracion->execute();
            $serieNumeracion = explode('-', $cmdSerieNumeracion->fetchColumn());

            $cmdNotaCredito = Database::getInstance()->getDb()->prepare("INSERT INTO NotaCreditoTB(
                IdNotaCredito,
                Vendedor,
                Cliente,
                Comprobante,
                Moneda,
                Serie,
                Numeracion,
                Motivo,
                FechaRegistro,
                HoraRegistro,
                IdVenta,
                Estado) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
            $cmdNotaCredito->bindValue(1, $codigoNotaCredito, PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(2, $body["IdVendedor"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(3, $body["IdCliente"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(4, $body["IdNotaCredito"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(5, $body["IdMoneda"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(6, $serieNumeracion[0], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(7, $serieNumeracion[1], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(8, $body["IdMotivo"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(9, $body["FechaRegistro"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(10, $body["HoraRegistro"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(11, $body["IdVenta"], PDO::PARAM_STR);
            $cmdNotaCredito->bindValue(12, $body["Estado"], PDO::PARAM_INT);
            $cmdNotaCredito->execute();

            $cmdComprobante = Database::getInstance()->getDb()->prepare("INSERT INTO ComprobanteTB(IdTipoDocumento,Serie,Numeracion,FechaRegistro)VALUES(?,?,?,?)");
            $cmdComprobante->bindValue(1, $body["IdNotaCredito"], PDO::PARAM_INT);
            $cmdComprobante->bindValue(2, $serieNumeracion[0], PDO::PARAM_STR);
            $cmdComprobante->bindValue(3, $serieNumeracion[1], PDO::PARAM_STR);
            $cmdComprobante->bindValue(4, $body["FechaRegistro"], PDO::PARAM_STR);
            $cmdComprobante->execute();

            $cmdNotaCreditoDetalle = Database::getInstance()->getDb()->prepare("INSERT INTO NotaCreditoDetalleTB(
            IdNotaCredito,
            IdSuministro,
            Cantidad,
            Precio,
            Descuento,
            ValorImpuesto) 
            VALUES(?,?,?,?,?,?)");

            foreach ($body["detalle"] as $value) {
                $cmdNotaCreditoDetalle->bindValue(1, $codigoNotaCredito, PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->bindValue(2, $value["IdArticulo"], PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->bindValue(3, $value["Cantidad"], PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->bindValue(4, $value["PrecioVenta"], PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->bindValue(5, $value["Descuento"], PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->bindValue(6, $value["ValorImpuesto"], PDO::PARAM_STR);
                $cmdNotaCreditoDetalle->execute();
            }

            Database::getInstance()->getDb()->commit();
            return "registrado";
        } catch (Exception $ex) {
            Database::getInstance()->getDb()->rollback();
            return $ex->getMessage();
        }
    }

    public static function ListaNotaCredito($opcion, $buscar, $fechaInicio, $fechaFinal, $posicionPagina, $filasPorPagina)
    {
        try {

            $array = array();

            $cmdNotaCredito = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_NotaCredito(?,?,?,?,?,?)}");
            $cmdNotaCredito->bindParam(1, $opcion, PDO::PARAM_INT);
            $cmdNotaCredito->bindParam(2, $buscar, PDO::PARAM_STR);
            $cmdNotaCredito->bindParam(3, $fechaInicio, PDO::PARAM_STR);
            $cmdNotaCredito->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $cmdNotaCredito->bindParam(5, $posicionPagina, PDO::PARAM_INT);
            $cmdNotaCredito->bindParam(6, $filasPorPagina, PDO::PARAM_INT);
            $cmdNotaCredito->execute();

            $arrayNotaCredito = array();
            $count = 0;
            while ($row = $cmdNotaCredito->fetch()) {
                $count++;
                array_push($arrayNotaCredito, array(
                    "Id" => $count,
                    "IdVenta" => $row["IdVenta"], 
                    "IdNotaCredito" => $row["IdNotaCredito"],                 
                    "FechaNotaCredito" => $row["FechaRegistro"],
                    "HoraNotaCredito" => $row["HoraRegistro"],
                    "SerieNotaCredito" => $row["SerieNotaCredito"],
                    "NumeracionNotaCredito" => $row["NumeracioNotaCredito"],                           
                    "Serie" => $row["SerieVenta"],
                    "Numeracion" => $row["NumeracionVenta"],                           
                    "NumeroDocumento" => $row["NumeroDocumento"],
                    "Informacion" => $row["Informacion"],
                    "Total" => floatval($row["Total"]),
                    "Xmlsunat" => $row["Xmlsunat"],
                    "Xmldescripcion" => $row["Xmldescripcion"],
                ));
            }

            $cmdNotaCreditCount = Database::getInstance()->getDb()->prepare("{CALL Sp_Listar_NotaCredito_Count(?,?,?,?)}");
            $cmdNotaCreditCount->bindParam(1, $opcion, PDO::PARAM_INT);
            $cmdNotaCreditCount->bindParam(2, $buscar, PDO::PARAM_STR);
            $cmdNotaCreditCount->bindParam(3, $fechaInicio, PDO::PARAM_STR);
            $cmdNotaCreditCount->bindParam(4, $fechaFinal, PDO::PARAM_STR);
            $cmdNotaCreditCount->execute();
            $resultTotal = $cmdNotaCreditCount->fetchColumn();

            array_push($array, $arrayNotaCredito, $resultTotal);
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ObtenerNotaCreditoById($idNotaCredito)
    {
        try {
            $array = array();
            $totalsinimpuesto = 0;
            $impuesto = 0;

            $cmdNotaCredito = Database::getInstance()->getDb()->prepare("SELECT
            n.IdNotaCredito, 
            tdn.CodigoAlterno as TipoDocumentoNotaCredito,
            n.Serie as SerieNotaCredito,
            n.Numeracion as NumeracionNotaCredito,
            n.FechaRegistro as FechaNotaCredito,
            n.HoraRegistro as HoraNotaCredito,
            tpv.CodigoAlterno,
            v.Serie,
            v.Numeracion,
            dt.IdAuxiliar as CodigoAnulacion,
            dt.Nombre as MotivoAnulacion,
            m.Abreviado as Moneda,
            dtc.IdAuxiliar as CodigoCliente,
            c.NumeroDocumento,
            c.Informacion,
            c.Direccion
            from NotaCreditoTB as n 
            inner join TipoDocumentoTB as tdn on tdn.IdTipoDocumento = n.Comprobante
            inner join VentaTB as v on v.IdVenta = n.IdVenta
            inner join TipoDocumentoTB as tpv on tpv.IdTipoDocumento = v.Comprobante
            inner join DetalleTB as dt on dt.IdDetalle = n.Motivo and dt.IdMantenimiento = '0019'
            inner join MonedaTB as m on m.IdMoneda = n.Moneda
            inner join ClienteTB as c on c.IdCliente = n.Cliente
            inner join DetalleTB as dtc on dtc.IdDetalle = c.TipoDocumento and dtc.IdMantenimiento = '0003'
            WHERE n.IdNotaCredito = ?");
            $cmdNotaCredito->bindValue(1, $idNotaCredito, PDO::PARAM_STR);
            $cmdNotaCredito->execute();
            $resultNotaCredito = $cmdNotaCredito->fetchObject();

            $cmdEmpresa = Database::getInstance()->getDb()->prepare("SELECT TOP 1 
            d.IdAuxiliar,e.NumeroDocumento,e.RazonSocial,e.NombreComercial,e.Domicilio,
            dbo.Fc_Obtener_Ubigeo(Ubigeo) as CodigoUbigeo,
            dbo.Fc_Obtener_Departamento(Ubigeo) as Departamento,
            dbo.Fc_Obtener_Provincia(Ubigeo) as Provincia,
            dbo.Fc_Obtener_Distrito(Ubigeo) as Distrito,
            e.Telefono,e.Email,
            e.UsuarioSol,e.ClaveSol 
            FROM EmpresaTB AS e INNER JOIN DetalleTB AS d ON e.TipoDocumento = d.IdDetalle AND d.IdMantenimiento = '0003'");
            $cmdEmpresa->execute();
            $resultEmpresa = $cmdEmpresa->fetchObject();

            $cmdDetalleNotaCredito =  Database::getInstance()->getDb()->prepare("SELECT 
            s.ClaveSat,
            ISNULL(d.IdAuxiliar,'') as CodigoUnidad,
            s.NombreMarca,
            nd.Cantidad,
            nd.Precio,
            nd.Descuento,
            nd.ValorImpuesto,
            i.Codigo,
            isnull(i.Numeracion,'') as Numeracion,
	        isnull(i.Letra,'') as Letra,
	        isnull(i.Categoria,'') as Categoria
            from NotaCreditoDetalleTB nd 
            inner join SuministroTB as s on s.IdSuministro = nd.IdSuministro
            inner join ImpuestoTB as i on s.Impuesto = i.IdImpuesto
            left join DetalleTB AS d ON d.IdDetalle = s.UnidadCompra AND d.IdMantenimiento = '0013'
            where nd.IdNotaCredito = ?");
            $cmdDetalleNotaCredito->bindValue(1, $idNotaCredito, PDO::PARAM_STR);
            $cmdDetalleNotaCredito->execute();

            $arrayDetalleNotaCredito = array();
            while ($row = $cmdDetalleNotaCredito->fetch()) {
                array_push($arrayDetalleNotaCredito, array(
                    "ClaveSat" => $row["ClaveSat"],
                    "CodigoUnidad" => $row["CodigoUnidad"],
                    "NombreMarca" => $row["NombreMarca"],
                    "Cantidad" => $row["Cantidad"],
                    "Precio" => $row["Precio"],
                    "Descuento" => $row["Descuento"],
                    "ValorImpuesto" => $row["ValorImpuesto"],
                    "Codigo" => $row["Codigo"],
                    "Numeracion" => $row["Numeracion"],
                    "Letra" => $row["Letra"],
                    "Categoria" => $row["Categoria"]
                ));
            }


            foreach ($arrayDetalleNotaCredito as $value) {
                $precio = $value['Precio'] / (($value['ValorImpuesto'] / 100.00) + 1);
                $totalsinimpuesto += $value['Cantidad'] * $precio;
                $impuesto += $value['Cantidad'] * ($precio * ($value['ValorImpuesto'] / 100.00));
            }

            array_push($array, $resultNotaCredito, $resultEmpresa, $arrayDetalleNotaCredito, array(
                "totalsinimpuesto" => $totalsinimpuesto,
                "totalimpuesto" => $impuesto,
                "totalconimpuesto" => $totalsinimpuesto + $impuesto
            ));
            return $array;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ListarNotificaciones()
    {
        try {

            $cmdNotificaciones = Database::getInstance()->getDb()->prepare("SELECT 
                co.Serie,
                td.Nombre,
				case v.Estado 
				when 3 then 'Dar de Baja'
				ELSE 'Por Declarar' end as Estado,
                count(co.Serie) AS Cantidad
                FROM ComprobanteTB AS co
                INNER JOIN TipoDocumentoTB AS td ON td.IdTipoDocumento = co.IdTipoDocumento
                LEFT JOIN VentaTB AS v ON v.Serie = co.Serie AND v.Numeracion = co.Numeracion
                LEFT JOIN NotaCreditoTB AS nc ON nc.Serie = co.Serie AND nc.Numeracion = co.Numeracion
                WHERE
                td.Facturacion = 1 AND v.IdVenta IS NOT NULL AND ISNULL(v.Xmlsunat,'') <> '0' AND ISNULL(v.Xmlsunat,'') <> '1032'	
                OR 
                td.Facturacion = 1 AND nc.IdNotaCredito IS NOT NULL AND ISNULL(nc.Xmlsunat,'') <> '0' AND ISNULL(nc.Xmlsunat,'') <> '1032' 
                GROUP BY co.Serie,td.Nombre,v.Estado");
            $cmdNotificaciones->execute();
            return $cmdNotificaciones->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function ListarDetalleNotificaciones()
    {
        try {

            $cmdNotificaciones = Database::getInstance()->getDb()->prepare("SELECT 
            isnull(v.FechaVenta,nc.FechaRegistro) as Fecha,
            co.Serie,
            co.Numeracion,
            td.Nombre,
            case v.Estado 
            when 3 then 'Dar de Baja'
            ELSE 'Por Declarar' end as Estado            
            FROM ComprobanteTB AS co
            INNER JOIN TipoDocumentoTB AS td ON td.IdTipoDocumento = co.IdTipoDocumento
            LEFT JOIN VentaTB AS v ON v.Serie = co.Serie AND v.Numeracion = co.Numeracion
            LEFT JOIN NotaCreditoTB AS nc ON nc.Serie = co.Serie AND nc.Numeracion = co.Numeracion
            WHERE
            td.Facturacion = 1 AND v.IdVenta IS NOT NULL AND ISNULL(v.Xmlsunat,'') <> '0' AND ISNULL(v.Xmlsunat,'') <> '1032'			
            OR 
            td.Facturacion = 1 AND nc.IdNotaCredito IS NOT NULL AND ISNULL(nc.Xmlsunat,'') <> '0' AND ISNULL(nc.Xmlsunat,'') <> '1032' 
            order by td.Nombre asc,co.Serie desc,cast(co.Numeracion as int) desc");
            $cmdNotificaciones->execute();
            return $cmdNotificaciones->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public static function GetDetalleId($idMantenimiento)
    {
        try {
            $cmdDetalle = Database::getInstance()->getDb()->prepare("{CALL Sp_Get_Detalle_Id(?)}");
            $cmdDetalle->bindValue(1, $idMantenimiento, PDO::PARAM_STR);
            $cmdDetalle->execute();
            return $cmdDetalle->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
