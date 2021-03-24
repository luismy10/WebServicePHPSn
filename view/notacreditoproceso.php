<?php
session_start();
$title_page = "Nota de crédito";
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include 'layout/head.php'; ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

        <div class="wrapper">

            <!-- start header -->
            <?php include('./layout/header.php') ?>
            <!-- end header -->
            <!-- start menu -->
            <?php include('./layout/menu.php') ?>
            <!-- end menu -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">


                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Nota de Crédito <small>Documento</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-success" id="btnRegistrar">
                                        <img src="./image/save.svg" width="18" /> Registrar
                                    </button>

                                    <button class="btn btn-default" id="btnCancelar">
                                        <img src="./image/error.svg" width="18" /> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Documento Nota de Crédito
                                </label>
                                <div class="form-group">
                                    <select class="form-control" id="cbNotaCredito">
                                        <option value="">- Seleccionar -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Moneda
                                </label>
                                <div class="form-group">
                                    <select class="form-control" id="cbMoneda">
                                        <option value="">- Seleccionar -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Fecha de Registro
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="date" id="txtFechaRegistro">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group ">
                                    <label>
                                        <i></i>
                                        DOCUMENTO A MODIFICAR:
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Tipo de Comprobante
                                </label>
                                <div class="form-group">
                                    <select class="form-control" id="cbTipoComprobante">
                                        <option value="">- Seleccionar -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Serie y Número del Comprobante:
                                </label>

                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="B001-001, F001-1" id="txtComprobante" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Motivo
                                </label>
                                <div class="form-group">
                                    <select class="form-control" id="cbMotivo">
                                        <option value="">- Seleccionar -</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Tipo Documento Ident.
                                </label>
                                <div class="form-group">
                                    <select class="form-control" id="cbTipoDocumento">
                                        <option value="">- Seleccionar -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    N° de Documento
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="N° Dni, Ruc etc" id="txtNumDocumento">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Nombre/Razón Social:
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Información General" id="txtInformacionCliente">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Dirección
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Dirección de vivienda" id="txtDireccion">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Celular/Teléfono
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="N° de celular o teleléno" id="txtCelular">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Correo Electrónico
                                </label>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Ingrese su correo electrónico" id="txtEmail">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                        <thead style="background-color: #0766cc;color: white;">
                                            <tr>
                                                <th style="width:5%;">Quitar</th>
                                                <th style="width:20%;">Detalle</th>
                                                <th style="width:10%;">Unidad</th>
                                                <th style="width:10%;">Cantidad</th>
                                                <th style="width:10%;">Precio Unit.</th>
                                                <th style="width:10%;">Importe</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbList">
                                            <tr>
                                                <td class="text-center" colspan="6">
                                                    <p>No hay datos para mostrar.</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Observación:
                                </label>
                                <div class="form-group">
                                    <textarea class="form-control" style="height:200px;" placeholder="" id="txtObservacion">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Detalle:
                                </label>
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Importe Bruto:</th>
                                                    <th id="thImporteBruto">0.00</th>
                                                </tr>
                                                <tr>
                                                    <th> Descuento:</th>
                                                    <th id="thDescuento">0.00</th>
                                                </tr>
                                                <tr>
                                                    <th> Sub Importe:</th>
                                                    <th id="thSubImporte">0.00</th>
                                                </tr>
                                                <tr>
                                                    <th> Impuesto(%):</th>
                                                    <th id="thImpuesto">0.00</th>
                                                </tr>
                                                <tr>
                                                    <th> Importe Neto:</th>
                                                    <th id="thImporteNeto">0.00</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </body>
    <script>
        let tools = new Tools();

        let arrayDetalle = [];

        let idVenta = "";
        let idCliente = "";
        let idEmpleado = "<?= $_SESSION['IdEmpleado']; ?>";

        $(document).ready(function() {

            $("#txtFechaRegistro").val(tools.getCurrentDate());

            $("#btnRegistrar").click(function() {
                generarNotaCredito();
            });

            $("#btnRegistrar").keypress(function(event) {
                if (event.keyCode === 13) {
                    generarNotaCredito();
                }
                event.preventDefault();
            });

            $("#btnCancelar").click(function() {
                clearComponents();
            });

            $("#btnCancelar").keypress(function(event) {
                if (event.keyCode === 13) {
                    clearComponents();
                }
                event.preventDefault();
            });

            // $("#txtComprobante").keypress(function(event) {
            //     if (event.keyCode == 13) {
            //         if ($("#txtComprobante").val().trim() !== '') {
            //             cosultarDocumento($("#txtComprobante").val().trim());
            //         }
            //     }
            // });

            cosultarDocumento("<?= $_GET["comprobante"] ?>");

        });

        function cosultarDocumento(comprobante) {
            $.ajax({
                url: "../app/controller/ventas/ListarVentas.php",
                method: "GET",
                data: {
                    "type": "getventanotacredito",
                    "comprobante": comprobante
                },
                beforeSend: function() {
                    $("#cbNotaCredito").empty();
                    $("#cbMoneda").empty();
                    $("#cbTipoComprobante").empty();
                    $("#cbMotivo").empty();
                    $("#cbTipoDocumento").empty();
                    $("#tbList").empty();
                    arrayDetalle = [];
                    $("#txtComprobante").val(comprobante)
                },
                success: function(result) {

                    if (result.estado == 1) {

                        $("#cbNotaCredito").append('<option value="">- Seleccionar -</option>');
                        for (let notacredito of result.notaCredito) {
                            $("#cbNotaCredito").append('<option value="' + notacredito.IdTipoDocumento + '">' + notacredito.Nombre + '</option>');
                        }

                        if (result.notaCredito.length == 1) {
                            $("select#cbNotaCredito").prop('selectedIndex', 1);
                        }

                        $("#cbMoneda").append('<option value="">- Seleccionar -</option>');
                        for (let moneda of result.monedas) {
                            $("#cbMoneda").append('<option value="' + moneda.IdMoneda + '">' + moneda.Nombre + '</option>');
                        }

                        for (let modena of result.monedas) {
                            if (modena.Predeterminado == 1) {
                                $("#cbMoneda").val(modena.IdMoneda);
                                break;
                            }
                        }

                        $("#cbTipoComprobante").append('<option value="">- Seleccionar -</option>');
                        for (let comprobante of result.tipoComprobante) {
                            $("#cbTipoComprobante").append('<option value="' + comprobante.IdTipoDocumento + '">' + comprobante.Nombre + '</option>');
                        }

                        $("#cbMotivo").append('<option value="">- Seleccionar -</option>');
                        for (let anulacion of result.motivoAnulacion) {
                            $("#cbMotivo").append('<option value="' + anulacion.IdDetalle + '">' + anulacion.Nombre + '</option>');
                        }

                        $("#cbTipoDocumento").append('<option value="">- Seleccionar -</option>');
                        for (let documento of result.tipoDocumento) {
                            $("#cbTipoDocumento").append('<option value="' + documento.IdDetalle + '">' + documento.Nombre + '</option>');
                        }

                        idVenta = result.venta.IdVenta;
                        idCliente = result.venta.IdCliente;
                        $("#txtNumDocumento").val(result.venta.NumeroDocumento);
                        $("#txtInformacionCliente").val(result.venta.Informacion);
                        $("#txtDireccion").val(result.venta.Direccion);
                        $("#txtCelular").val(result.venta.Celular);
                        $("#txtEmail").val(result.venta.Email);

                        $("#cbTipoComprobante").val(result.venta.Comprobante);
                        $("#cbTipoDocumento").val(result.venta.TipoDocumento);

                        arrayDetalle = result.detalle;
                        generarDetalle();
                    } else {

                    }
                },
                error: function(error) {
                    console.log(error.responseText)
                }
            });
        }

        function generarDetalle() {
            let totalImporteBruto = 0;
            let totalDescuento = 0;
            let totalSubImporte = 0;
            let totalImpuesto = 0;
            let totalImporteNeto = 0;

            for (let detalle of arrayDetalle) {

                let cantidad = detalle.Cantidad;
                let impuesto = detalle.ValorImpuesto;
                let precioVenta = detalle.PrecioVenta;
                let descuento = detalle.Descuento;

                let precioBruto = precioVenta / ((impuesto / 100.00) + 1);
                let impuestoGenerado = precioBruto * (impuesto / 100.00);
                let impuestoTotal = impuestoGenerado * cantidad;
                let importeBrutoTotal = precioBruto * cantidad;
                let importeNeto = precioBruto + impuestoGenerado;
                let importeNetoTotal = importeBrutoTotal + impuestoTotal;

                $("#tbList").append('<tr id="' + detalle.IdVenta + "-" + detalle.IdArticulo + '">' +
                    '<td><button class="btn btn-default" onclick="removeTableTr(\'' + detalle.IdVenta + '\',\'' + detalle.IdArticulo + '\')"><i class="fa fa-trash"></i></button></td>' +
                    '<td>' + detalle.Clave + '<br>' + detalle.NombreMarca + '</td>' +
                    '<td>' + detalle.UnidadMarca + '</td>' +
                    '<td>' + tools.formatMoney(cantidad) + '</td>' +
                    '<td>' + tools.formatMoney(importeNeto) + '</td>' +
                    '<td>' + tools.formatMoney(importeNetoTotal) + '</td>' +
                    '</tr>');

                totalImporteBruto += importeBrutoTotal;
                totalDescuento += descuento;
                totalSubImporte += importeBrutoTotal;
                totalImpuesto += impuestoTotal;
                totalImporteNeto += importeNetoTotal;
            }

            $("#thImporteBruto").html(tools.formatMoney(totalImporteBruto));
            $("#thDescuento").html(tools.formatMoney(totalDescuento));
            $("#thSubImporte").html(tools.formatMoney(totalSubImporte));
            $("#thImpuesto").html(tools.formatMoney(totalImpuesto));
            $("#thImporteNeto").html(tools.formatMoney(totalImporteNeto));
        }

        function removeTableTr(idVenta, idProducto) {
            for (let i = 0; i < arrayDetalle.length; i++) {
                if (arrayDetalle[i].IdVenta === idVenta && arrayDetalle[i].IdArticulo === idProducto) {
                    arrayDetalle.splice(i, 1);
                    $("#" + idVenta + "-" + idProducto).remove();
                    break;
                }
            }
        }

        function generarNotaCredito() {
            if ($("#cbNotaCredito").val() == '') {
                $("#cbNotaCredito").focus();
            } else if ($("#cbMoneda").val() == '') {
                $("#cbMoneda").focus();
            } else if (!tools.validateDate($("#txtFechaRegistro").val())) {
                $("#txtFechaRegistro").focus();
            } else if ($("#cbTipoComprobante").val() == '') {
                $("#cbTipoComprobante").focus();
            } else if ($("#txtComprobante").val() == '') {
                $("#txtComprobante").focus();
            } else if ($("#cbMotivo").val() == '') {
                $("#cbMotivo").focus();
            } else if ($("#cbTipoDocumento").val() == '') {
                $("#cbTipoDocumento").focus();
            } else if ($("#txtNumDocumento").val() == '') {
                $("#txtNumDocumento").focus();
            } else if ($("#txtInformacionCliente").val() == '') {
                $("#txtInformacionCliente").focus();
            } else if (arrayDetalle.length == 0) {
                tools.AlertWarning("Nota de crédito:", "No hay productos en la lista para generar la nota de crédito.");
            } else {
                tools.ModalDialog("Nota de Crédito", "¿Está seguro de continuar?", function(value) {
                    if (value == true) {

                        $.ajax({
                            url: "../app/controller/ventas/RegistrarNotaCredito.php",
                            type: 'POST',
                            accepts: "application/json",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify({
                                "IdVendedor": idEmpleado,
                                "IdVenta": idVenta,
                                "IdCliente": idCliente,

                                "IdNotaCredito": $("#cbNotaCredito").val(),
                                "IdMoneda": $("#cbMoneda").val(),
                                "FechaRegistro": $("#txtFechaRegistro").val(),
                                "HoraRegistro": tools.getCurrentTime(),

                                "IdComprobante": $("#cbTipoComprobante").val(),
                                "SerieNumeracion": $("#txtComprobante").val(),
                                "IdMotivo": $("#cbMotivo").val(),

                                "IdDocumento": $("#cbTipoDocumento").val(),
                                "NumeroDocumento": $("#txtNumDocumento").val(),
                                "InformacionCliente": $("#txtInformacionCliente").val(),

                                "Direccion": $("#txtDireccion").val(),
                                "Celular": $("#txtCelular").val(),
                                "Email": $("#txtEmail").val(),
                                "Estado":1,

                                "detalle": arrayDetalle
                            }),
                            beforeSend: function() {
                                tools.ModalAlertInfo("Nota de Crédito", "Procesando petición..");
                            },
                            success: function(result) {
                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess("Producto", result.message);
                                    clearComponents();
                                    location.href = "notacredito.php";
                                } else {
                                    tools.ModalAlertWarning("Producto", result.message);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Producto", "Se produjo un error: " + error.responseText);
                            }
                        });

                    }
                });
            }
        }

        function clearComponents() {
            $("#cbNotaCredito").empty("");
            $("#cbNotaCredito").append('<option value="">- Seleccionar -</option>');

            $("#txtFechaRegistro").val(tools.getCurrentDate());

            $("#cbMoneda").empty("");
            $("#cbMoneda").append('<option value="">- Seleccionar -</option>');

            $("#cbTipoComprobante").empty("");
            $("#cbTipoComprobante").append('<option value="">- Seleccionar -</option>');

            $("#txtComprobante").val("");

            $("#cbMotivo").empty("");
            $("#cbMotivo").append('<option value="">- Seleccionar -</option>');

            $("#cbTipoDocumento").empty("");
            $("#cbTipoDocumento").append('<option value="">- Seleccionar -</option>');

            $("#txtNumDocumento").val("");

            $("#txtInformacionCliente").val("");

            $("#txtDireccion").val("");

            $("#txtComprobante").val("");

            $("#txtCelular").val("");

            $("#txtEmail").val("");

            arrayDetalle = [];
            idVenta = "";
            idCliente = "";
            $("#tbList").empty();
            $("#txtObservacion").val();
            generarDetalle();

        }
    </script>

    </html>
<?php
}
?>