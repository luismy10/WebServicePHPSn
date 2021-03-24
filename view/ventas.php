<?php
session_start();
$title_page = "Ventas";
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

            <!-- modal start -->
            <div class="row">
                <div class="modal fade" id="mdAlert" data-backdrop="static">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-file-excel">
                                    </i> Generar Excel
                                </h4>
                                <button type="button" class="close" id="btnClose">
                                    <i class="fa fa-window-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>¿Generar el excel con todos los comprobante generados o solo los facturados?</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="btnTodos">
                                    <i class="fa fa-check"></i> Todos</button>
                                <button type="button" class="btn btn-danger" id="btnFacturados">
                                    <i class="fa fa-check"></i> Facturados</button>
                                <button type="button" class="btn btn-primary" id="btnCancelar">
                                    <i class="fa fa-remove"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal end -->

            <!-- Modal del detalle de ingreso -->
            <div class="row">
                <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-indent">
                                    </i> Detalle de la venta seleccionada</h4>
                                <button type="button" class="close" id="btnCloseModal">
                                    <i class="fa fa-window-close"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Comprobante:</th>
                                                        <th id="thComprobante" colspan="5">--</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Cliente:</th>
                                                        <th id="thCliente" colspan="5">--</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Fecha y Hora:</th>
                                                        <th id="thFechaHora">--</th>
                                                        <th>Estado:</th>
                                                        <th id="thEstado">--</th>
                                                        <th>Total:</th>
                                                        <th id="thTotal">--</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                                <thead style="background-color: #0766cc;color: white;">
                                                    <tr>
                                                        <th style="width:5%;">N°</th>
                                                        <th style="width:30%;">Descripción</th>
                                                        <th style="width:15%;">Cantidad</th>
                                                        <th style="width:15%;">Impuesto</th>
                                                        <th style="width:15%;">Precio</th>
                                                        <th style="width:15%;">Descuento</th>
                                                        <th style="width:15%;">Importe</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbIngresosDetalle">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--   Modal del detalle de ingreso -->

            <!-- Modal del detalle de ingreso -->
            <div class="row">
                <div class="modal fade" id="id-modal-clientes" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-users">
                                    </i> Clientes
                                </h4>
                                <button type="button" class="close" id="btnCloseModal">
                                    <i class="fa fa-window-close"></i>
                                </button>

                            </div>
                            <div class="modal-body padding-horizontal">

                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <label>Buscar:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Buscar clientes..." id="txtBuscarClientes">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label>Opción:</label>
                                        <div class="form-group">
                                            <button class="btn btn-default" id="btnRecargarProductos">
                                                <img src="./image/reload.png" width="18"> Recargar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                                <thead style="background-color: #0766cc;color: white;">
                                                    <tr>
                                                        <th style="width:5%;">N°</th>
                                                        <th style="width:30%;">Cliente</th>
                                                        <th style="width:15%;">Teléfono/Celular</th>
                                                        <th style="width:15%;">Cambiar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbClientes">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--   Modal del cliente -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Ventas <small>Lista</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <h4> Resumen de documentos emitidos</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group text-primary">
                                    <h4 id="lblTotalVenta">Total de venta por Fecha:&nbsp; S/ 0.00</h4>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <div class="row">
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <img src="./image/sunat_logo.png" width="28" height="28" />
                                    <span class="text-sm">Estados SUNAT:</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <img src="./image/accept.svg" width="28" height="28" />
                                    <span class="text-sm">Aceptado</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <img src="./image/unable.svg" width="28" height="28" />
                                    <span class="text-sm"> Rechazado</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <img src="./image/reuse.svg" width="28" height="28" />
                                    <span class="text-sm"> Pendiente de Envío</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <img src="./image/error.svg" width="28" height="28" />
                                    <span class="text-sm">Comunicación de Baja (Anulado)</span>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Fecha de Inicio:</label>
                                <div class="form-group">
                                    <input class="form-control" type="date" id="txtFechaInicial" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Fecha de Fin:</label>
                                <div class="form-group">
                                    <input class="form-control" type="date" id="txtFechaFinal" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Procesar:</label>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btnEnvioMasivo">
                                        <i class="fa fa-arrow-circle-up"></i> Envío masivo a sunat
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Generar Excel:</label>
                                <div class="form-group">
                                    <button class="btn btn-success" id="btnExcel">
                                        <i class="fa fa-file-excel"></i> Excel por Fecha
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <label>Buscar:</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-danger" id="btnReload"><i class="fa fa-refresh"></i> Recargar</button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <label>Paginación:</label>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btnAnterior">
                                        <i class="fa fa-arrow-circle-left"></i>
                                    </button>
                                    <span class="m-2" id="lblPaginaActual">0</span>
                                    <span class="m-2">de</span>
                                    <span class="m-2" id="lblPaginaSiguiente">0</span>
                                    <button type="button" class="btn btn-primary" id="btnSiguiente">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                        <thead style="background-color: #0766cc;color: white;">
                                            <tr>
                                                <th style="width:5%;">#</th>
                                                <th style="width:5%;">PDF</th>
                                                <th style="width:5%;">Detalle</th>
                                                <th style="width:5%;">Anular</th>
                                                <th style="width:10%;">Fecha</th>
                                                <th style="width:15%;">Comprobante</th>
                                                <th style="width:15%;">Cliente</th>
                                                <th style="width:10%;">Estado</th>
                                                <th style="width:10%;">Total</th>
                                                <th style="width:10%;">Estado SUNAT</th>
                                                <th style="width:25%;">Observación SUNAT</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <?php include('./layout/footer.php') ?>
        </div>
        <script src="./js/notificaciones.js"></script>
        <script>
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 20;
            let tbody = $("#tbList");
            let arrayVentas = [];

            let tools = new Tools();

            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");
            let lblTotalVenta = $("#lblTotalVenta");

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(3, "", fechaInicial, fechaFinal, '');
                        opcion = 0;
                    }
                });

                $("#txtFechaFinal").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(3, "", fechaInicial, fechaFinal, '');
                        opcion = 0;
                    }
                });

                $("#txtSearch").on("keyup", function(event) {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillVentasTable(2, value.trim(), "", "", '');
                                opcion = 1;
                            }
                        }
                    }
                });

                $("#btnAnterior").click(function() {
                    if (!state) {
                        if (paginacion > 1) {
                            paginacion--;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnSiguiente").click(function() {
                    if (!state) {
                        if (paginacion < totalPaginacion) {
                            paginacion++;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnReload").click(function() {
                    loadInitVentas();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitVentas();
                    }
                    event.preventDefault();
                });

                $("#btnExcel").click(function() {
                    openExcel();
                });

                $("#btnExcel").keypress(function(event) {
                    if (event.keyCode === 13) {
                        openExcel();
                    }
                    event.preventDefault();
                });

                $("#btnEnvioMasivo").click(function() {
                    tools.ModalDialog("Ventas", "¿Está seguro de continuar con el envío?", function(value) {
                        if (value == true) {
                            for (let venta of arrayVentas) {
                                if (venta.Estado !== "ANULADO") {
                                    if (venta.Xmlsunat !== "0") {
                                        firmarMasivaXml(venta.IdVenta);
                                    }
                                }
                            }
                        }
                    });
                });

                $("#btnCloseModal").click(function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("hide");

                    }
                    event.preventDefault();
                });
                loadInitVentas();
            });


            function onEventPaginacion() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                let value = $("#txtSearch").val();
                switch (opcion) {
                    case 0:
                        fillVentasTable(3, "", fechaInicial, fechaFinal, '');
                        break;
                    case 1:
                        fillVentasTable(2, value.trim(), "", "", '');
                        break;
                }
            }

            function loadInitVentas() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                    if (!state) {
                        paginacion = 1;
                        fillVentasTable(3, "", fechaInicial, fechaFinal, '');
                        opcion = 0;
                    }
                }
            }

            function fillVentasTable(opcion, busqueda, fechaInicial, fechaFinal, empleado) {
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "venta",
                        "opcion": opcion,
                        "busqueda": busqueda,
                        "fechaInicial": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "empleado": empleado,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="11"><img src="./image/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                        arrayVentas = [];
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
                            arrayVentas = object.data;
                            tbody.empty();
                            if (arrayVentas.length == 0) {
                                tbody.append('<tr><td class="text-center" colspan="11"><p>No hay datos para mostrar.</p></td></tr>');
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                lblTotalVenta.html("Total de venta por Fecha:&nbsp; S/ " + tools.formatMoney(parseFloat(object.suma)));
                                state = false;
                            } else {
                                for (let venta of arrayVentas) {
                                    let pdf = '<a class="btn btn-dafult"  onclick="openPdf(\'' + venta.IdVenta + '\')"><img src="./image/pdf.svg" width="26" /> </a>';
                                    let ver = '<a class="btn btn-dafult" onclick="opeModalDetalleIngreso(\'' + venta.IdVenta + '\')"><img src="./image/file.svg" width="26" /></a>';
                                    //  let credito = '<button class="btn btn-default btn-sm" onclick="generarNotaCredito(\'' + (venta.Serie + "-" + venta.Numeracion) + '\')"><img src="./image/notacredito.png" width="26" /></button>';
                                    let resumen = '<a class="btn btn-dafult" onclick="resumenDiarioXml(\'' + venta.IdVenta + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\',\'' + tools.getDateYYMMDD(venta.FechaVenta) + '\')"><img src="./image/reuse.svg" width="26" /></a>';
                                    let comunicacion = '<a class="btn btn-dafult" onclick="comunicacionBajaXml(\'' + venta.IdVenta + '\',\'' + venta.Serie + "-" + venta.Numeracion + '\')"><img src="./image/reuse.svg" width="26" /></a>';
                                    let anular = venta.Serie.toUpperCase().includes("B") ? resumen : comunicacion;

                                    let datetime = tools.getDateForma(venta.FechaVenta) + "<br>" + tools.getTimeForma24(venta.HoraVenta, true);
                                    let comprobante = venta.Comprobante + " <br/>" + (venta.Serie + "-" + venta.Numeracion) + (venta.IdNotaCredito == 1 ? " <span class='text-danger'>" + "Modificado(" + venta.SerieNotaCredito + "-" + venta.NumeracionNotaCredito + ")</span>" : "");
                                    let cliente = venta.DocumentoCliente + "<br>" + venta.Cliente;
                                    //'<button onclick="openModalClientes()" type="button" class="btn btn-primary btn-sm btn-flat">Editar</button>';
                                    let estado = "";
                                    if (venta.Tipo == 1 && venta.Estado == 1 || venta.Tipo == 2 && venta.Estado == 1) {
                                        estado = '<div class="badge badge-success">COBRADO</div>';
                                    } else if (venta.Tipo == 2 && venta.Estado == 2) {
                                        estado = '<div class="badge badge-warning">POR COBRAR</div>';
                                    } else if (venta.Tipo == 1 && venta.Estado == 2) {
                                        estado = '<div class="badge badge-primary">POR LLEVAR</div>';
                                    } else {
                                        estado = '<div class="badge badge-danger">ANULADO</div>';
                                    }
                                    // let estado = '<div class="' + (venta.Tipo == 2 && venta.Estado == 2 ? "label label-warning" :v venta.Estado == 3 ? "label label-danger" : "label label-success") + '">' + (venta.Estado == 2 ? "POR COBRAR/LLEVAR" : venta.Estado == 3 ? "ANULADO" : "COBRADO") + '</div>';
                                    let total = venta.Simbolo + " " + tools.formatMoney(venta.Total);

                                    let estadosunat = venta.Estado == 3 ?
                                        ('<button class="btn btn-default btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./image/error.svg" width="26" /></button>') :
                                        (venta.Xmlsunat === "" ?
                                            '<button class="btn btn-default btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./image/reuse.svg" width="26"/></button>' :
                                            venta.Xmlsunat === "0" ?
                                            '<button class="btn btn-default btn-sm"><img src="./image/accept.svg" width="26" /></button>' :
                                            '<button class="btn btn-default btn-sm" onclick="firmarXml(\'' + venta.IdVenta + '\')"><img src="./image/unable.svg" width="26" /></button>'
                                        );

                                    let descripcion = '<p class="recortar-texto">' + (venta.Xmldescripcion === "" ? "Por Generar Xml" : venta.Xmldescripcion) + '</p>';

                                    tbody.append('<tr>' +
                                        ' <td class="td-center">' + venta.id + '</td >' +
                                        ' <td class="td-center">' + pdf + '</td>' +
                                        ' <td class="td-center">' + ver + '</td>' +
                                        ' <td class="td-center">' + anular + '</td>' +
                                        ' <td class="td-left">' + datetime + '</td>' +
                                        ' <td class="td-left">' + comprobante + '</td>' +
                                        ' <td>' + cliente + '</td>' +
                                        ' <td>' + estado + '</td>' +
                                        ' <td class="td-right">' + total + '</td>' +
                                        ' <td class="td-center">' + estadosunat + '</td>' +
                                        ' <td class="td-left">' + descripcion + '</td>' +
                                        '</tr >');
                                }

                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                lblTotalVenta.html("Total de venta por Fecha:&nbsp; S/ " + tools.formatMoney(parseFloat(object.suma)));
                                state = false;
                            }
                        } else {
                            tbody.empty();
                            lblPaginaActual.html(0);
                            lblPaginaSiguiente.html(0);
                            tbody.append('<tr><td class="text-center" colspan="11"><p>' + object.message + '</p></td></tr>');
                            lblTotalVenta.html("S/ " + tools.formatMoney(parseFloat(0)));
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbody.empty();
                        lblPaginaActual.html(0);
                        lblPaginaSiguiente.html(0);
                        tbody.append('<tr><td class="text-center" colspan="11"><p>' + error.responseText + '</p></td></tr>');
                        lblTotalVenta.html("S/ " + tools.formatMoney(parseFloat(0)));
                        state = false;
                    }
                });
            }

            function opeModalDetalleIngreso(idVenta) {
                $("#id-modal-productos").modal("show");

                let thComprobante = $("#thComprobante");
                let thCliente = $("#thCliente");
                let thFechaHora = $("#thFechaHora");
                let thEstado = $("#thEstado");
                let thTotal = $("#thTotal");
                let tbIngresosDetalle = $("#tbIngresosDetalle");
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "allventa",
                        idVenta: idVenta
                    },
                    beforeSend: function() {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><img src="./image/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado == 1) {
                            tbIngresosDetalle.empty();
                            let venta = object.venta;
                            thComprobante.html(venta.Serie + "-" + venta.Numeracion);
                            thCliente.html(venta.NumeroDocumento + " - " + venta.Informacion);
                            thFechaHora.html(tools.getDateForma(venta.FechaVenta) + " - " + tools.getTimeForma24(venta.HoraVenta));
                            thEstado.html(venta.Estado == 3 ? "ANULADO" : venta.Estado == 2 ? "POR COBRAR" : "COBRADO");
                            thEstado.removeClass();
                            thEstado.addClass(venta.Estado == 3 ? "text-danger" : "text-success");
                            let detalleventa = object.ventadetalle;
                            let total = 0;
                            for (let venta of detalleventa) {
                                let num = venta.id;
                                let descripcion = venta.Clave + "<br>" + venta.NombreMarca;
                                let cantidad = venta.Cantidad;
                                let impuesto = venta.NombreImpuesto;
                                let precio = venta.PrecioVenta;
                                let descuento = venta.Descuento;
                                let importe = cantidad * precio;
                                tbIngresosDetalle.append('<tr>' +
                                    '<td>' + num + '</td>' +
                                    '<td class="td-left">' + descripcion + '</td>' +
                                    '<td>' + tools.formatMoney(cantidad) + "<br>" + venta.UnidadCompra + '</td>' +
                                    '<td>' + impuesto + '</td>' +
                                    '<td>' + tools.formatMoney(precio) + '</td>' +
                                    '<td>' + tools.formatMoney(descuento) + '</td>' +
                                    '<td>' + tools.formatMoney(importe) + '</td>' +
                                    '</tr>');
                                total += parseFloat(importe);
                            }
                            thTotal.html(venta.Simbolo + " " + tools.formatMoney(total));
                        } else {
                            tbIngresosDetalle.empty();
                            tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                        }
                    },
                    error: function(error) {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                    }
                });
            }

            function firmarXml(idventa) {
                tools.ModalDialog("Ventas", "¿Está seguro de enviar el documento?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/boleta.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                console.log(result)
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function firmarMasivaXml(idventa) {
                $.ajax({
                    url: "../app/examples/boleta.php",
                    method: "GET",
                    data: {
                        idventa: idventa
                    },
                    beforeSend: function() {
                        tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                    },
                    success: function(result) {
                        let object = result;
                        if (object.state === true) {
                            if (object.accept === true) {
                                tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            } else {
                                tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                            }
                        } else {
                            tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                        }
                    },
                    error: function(error) {
                        tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                    }
                });
            }

            function resumenDiarioXml(idventa, comprobante, resumen) {
                tools.ModalDialog("Emitir resumen díario", "¿Se anulará el documento: " + comprobante + ", y se creará el siguiente resumen individual: RC-" + resumen + "-1, estás seguro de anular el documento? los cambios no se podrán revertir!", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/resumen.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }


            function comunicacionBajaXml(idventa, comprobante) {
                tools.ModalDialog("Emitir comunicación de baja", "¿Se anulará el documento " + comprobante + "?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/examples/comunicacionbaja.php",
                            method: "GET",
                            data: {
                                idventa: idventa
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                        onEventPaginacion();
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });
                    }
                });
            }


            function openPdf(idVenta) {
                window.open("../app/sunat/pdfingresos.php?idVenta=" + idVenta, "_blank");
            }

            function generarNotaCredito(serieNumeracion) {
                window.open("./notacreditoproceso.php?comprobante=" + serieNumeracion);
            }

            function openExcel() {
                $("#mdAlert").modal("show");
                $("#btnTodos").unbind();
                $("#btnTodos").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelventa.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=0", "_blank");
                        $("#mdAlert").modal("hide");
                    }
                });

                $("#btnFacturados").unbind();
                $("#btnFacturados").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelventa.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                        $("#mdAlert").modal("hide");
                    }
                });

                $("#btnCancelar").unbind();
                $("#btnCancelar").bind("click", function() {
                    $("#mdAlert").modal("hide");
                });

                $("#btnClose").unbind();
                $("#btnClose").bind("click", function() {
                    $("#mdAlert").modal("hide");
                });

            }

            function openModalClientes() {
                $("#id-modal-clientes").modal("show");
            }
        </script>
    </body>

    </html>
<?php
}
