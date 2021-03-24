<?php
session_start();
$title_page = "Ajuste";
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

            <!-- Modal del detalle de ingreso -->
            <div class="row">
                <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-indent">
                                    </i> Detalle del Ajuste
                                </h4>
                                <button type="button" class="close" id="btnCloseModal">
                                    <i class="fa fa-window-close"></i>
                                </button>

                            </div>
                            <div class="modal-body padding-horizontal">
                                <div class="row">
                                    <div class="col-md 12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Tipo de Ajustes:</th>
                                                        <th style="width: 40%;" id="lblTipoMovimiento">--</th>
                                                        <th style="width: 10%;">Codigo Verificación:</th>
                                                        <th style="width: 40%;" id="lblCodigoVerificacion">--</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 10%;">Fecha y Hora:</th>
                                                        <th style="width: 40%;" id="lblFechaHora">--</th>
                                                        <th style="width: 10%;">Estado:</th>
                                                        <th style="width: 40%;"><span id="lblEstadoMovimiento">--</span></th>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 10%;">Observación:</th>
                                                        <th style="width: 90%;" colspan="3" id="lblObservacion">--</th>
                                                    </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md 12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <button class="btn btn-default" id="btnCancelarMovimiento">
                                                <img src="./image/unable.svg" width="18" />
                                                Anular Ajuste
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md 12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                                <thead style="background-color: #0766cc;color: white;">
                                                    <tr>
                                                        <th class="th-porcent-5">N°</th>
                                                        <th class="th-porcent-35">Descripción</th>
                                                        <th class="th-porcent-15">Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbMovimientos">

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
            <!--  -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Ajustes realizados <small>Lista</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md 12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-success" id="btnMovimiento">
                                        <i class="fa fa-plus"></i>
                                        Realizar Ajuste
                                    </button>
                                    <button class="btn btn-danger" id="btnReload">
                                        <i class="fa fa-sync-alt"></i>
                                        Recargar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Moviminento:</label>
                                <div class="form-group">
                                    <select class="form-control" id="cbTipoMovimiento">
                                        <option value="0">--TODOS--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Inicio:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="txtFechaInicio">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Termino:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="txtFechaTermino">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Paginación:</label>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btnAnterior">
                                        <i class="fa fa-arrow-circle-left"></i>
                                    </button>
                                    <span class="m-2" id="lblPaginaActual">0</span>
                                    <span class="m-2">de</span>
                                    <span class="m-2" id="lblPaginaSiguiente">0</span>
                                    <button class="btn btn-primary" id="btnSiguiente">
                                        <i class="fa fa-arrow-circle-right"></i>
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
                                                <th scope="col" class="th-porcent-5">N°</th>
                                                <th scope="col" class="th-porcent-15">Tipo Ajuste</th>
                                                <th scope="col" class="th-porcent-10">Fecha y Hora</th>
                                                <th scope="col" class="th-porcent-25">Observación</th>
                                                <th scope="col" class="th-porcent-20">Información</th>
                                                <th scope="col" class="th-porcent-15">Estado</th>
                                                <th scope="col" class="th-porcent-5">Detalle</th>
                                                <th scope="col" class="th-porcent-5">Excel</th>
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
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            let cbTipoMovimiento = $("#cbTipoMovimiento");
            let txtFechaInicio = $("#txtFechaInicio");
            let txtFechaTermino = $("#txtFechaTermino");

            let lblTipoMovimiento = $("#lblTipoMovimiento");
            let lblFechaHora = $("#lblFechaHora");
            let lblObservacion = $("#lblObservacion");
            let lblEstadoMovimiento = $("#lblEstadoMovimiento");
            let lblCodigoVerificacion = $("#lblCodigoVerificacion");
            let tbMovimientos = $("#tbMovimientos");

            let tools = new Tools();

            $(document).ready(function() {

                $("#txtFechaInicio").val(tools.getCurrentDate());
                $("#txtFechaTermino").val(tools.getCurrentDate());

                $("#btnMovimiento").click(function() {
                    window.location.href = "ajusteproceso.php";
                });

                $("#btnMovimiento").keypress(function(event) {
                    if (event.keyCode === 13) {
                        window.location.href = "ajusteproceso.php";
                    }
                    event.preventDefault();
                });

                $("#btnReload").click(function() {
                    if (!state) {
                        loadComponents();
                    }
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        if (!state) {
                            loadComponents();
                        }
                    }
                    event.preventDefault();
                });

                txtFechaInicio.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(true, parseInt(cbTipoMovimiento.val()), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
                        }
                    }
                });

                txtFechaTermino.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(true, parseInt(cbTipoMovimiento.val()), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
                        }
                    }
                });

                cbTipoMovimiento.on("change", function() {
                    if (txtFechaInicio.val() !== "" && txtFechaTermino.val() !== "") {
                        if (!state) {
                            paginacion = 1;
                            fillInventarioTable(true, parseInt($(this).children("option:selected").val()), txtFechaInicio.val(), txtFechaTermino.val());
                            opcion = 1;
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

                $("#btnCloseModal").on("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").css({
                            "display": "none"
                        });
                    }
                    event.preventDefault();
                });

                loadComponents();
            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillInventarioTable(false, parseInt(cbTipoMovimiento.val()), "", "");
                        break;
                    case 1:
                        fillInventarioTable(true, parseInt(cbTipoMovimiento.val()), txtFechaInicio.val(), txtFechaTermino.val());
                        break;
                }
            }

            function loadComponents() {
                $.get("../app/controller/tipomovimiento/ListarTipoMovimientos.php", {
                    "ajuste": true,
                    "all": "true"
                }, function(data, status) {
                    if (status === "success") {
                        let cbTipoMovimiento = $("#cbTipoMovimiento");
                        let result = data;
                        if (result.estado === 1) {
                            cbTipoMovimiento.empty();
                            cbTipoMovimiento.append('<option value="0">--TODOS--</option>');
                            for (let tipos of result.data) {
                                cbTipoMovimiento.append('<option value="' + tipos.IdTipoMovimiento + '">' + tipos.Nombre + '</option>');
                            }
                            loadInitTable();
                        } else {
                            cbTipoMovimiento.empty();
                        }
                    }
                });
            }

            function loadInitTable() {
                if (!state) {
                    paginacion = 1;
                    fillInventarioTable(false, parseInt(cbTipoMovimiento.val()), "", "");
                    opcion = 0;
                }
            }

            function fillInventarioTable(init, movimiento, fechaInicial, fechaFinal) {
                $.ajax({
                    url: "../app/controller/suministros/ListarMovimiento.php",
                    method: "GET",
                    data: {
                        "init": init,
                        "opcion": 1,
                        "movimiento": movimiento,
                        "fechaInicial": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><img src="./image/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
                            let movimientos = object.data;
                            if (movimientos.length == 0) {
                                tbody.empty();
                                tbody.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar</p></td></tr>');
                                lblPaginaActual.html("0");
                                lblPaginaSiguiente.html("0");
                                state = false;
                            } else {
                                tbody.empty();
                                for (let moviminento of movimientos) {
                                    let estadoStyle = moviminento.Estado === "CANCELADO" ? "text-danger" : moviminento.Estado === "EN PROCESO" ? "text-warning" : "text-success";
                                    tbody.append('<tr>' +
                                        '<td>' + moviminento.count + '</td>' +
                                        '<td>' + (moviminento.TipoAjuste == 0 ? "DECREMENTO" : "INCREMENTO") + '<br>' + moviminento.TipoMovimiento + '</td>' +
                                        '<td>' + tools.getDateForma(moviminento.Fecha) + "</br>" + tools.getTimeForma24(moviminento.Hora) + '</td>' +
                                        '<td>' + moviminento.Observacion + '</td>' +
                                        '<td>' + moviminento.Informacion + '</td>' +
                                        '<td>' + '<div class="' + estadoStyle + '">' + moviminento.Estado + '</div>' + '</td>' +
                                        '<td><button class="btn btn-warning btn-sm" onclick="loadDetalleMovimiento(\'' + moviminento.IdMovimientoInventario + '\')"><img src="./image/search.png" width="18" /><span> Ver</span></button></td>' +
                                        '<td><button class="btn btn-success btn-sm" onclick="generarExcel(\'' + moviminento.IdMovimientoInventario + '\')"><i class="fa fa-file-excel"></i><span> Excel</span></button></td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbody.empty();
                            tbody.append('<tr><td class="text-center" colspan="8"><p>' + object.mensaje + '</p></td></tr>');
                            lblPaginaActual.html("0");
                            lblPaginaSiguiente.html("0");
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><p>Error en: ' + error.responseText + '</p></td></tr>');
                        lblPaginaActual.html("0");
                        lblPaginaSiguiente.html("0");
                        state = false;
                    }
                });
            }

            function loadDetalleMovimiento(idMovimiento) {
                $("#id-modal-productos").modal("show");
                $.ajax({
                    url: "../app/controller/tipomovimiento/ListarMovimientoPorId.php",
                    method: "GET",
                    data: {
                        "idMovimiento": idMovimiento
                    },
                    beforeSend: function() {
                        tbMovimientos.empty();
                        tbMovimientos.append('<tr><td class="td-center" colspan="3">Cargando información...</td></tr>');
                    },
                    success: function(result) {
                        if (result.estado === 1) {
                            tbMovimientos.empty();
                            let movimiento = result.data[0];
                            let movimientoDetalle = result.data[1];

                            lblTipoMovimiento.html(movimiento.TipoMovimiento);
                            lblFechaHora.html(tools.getDateForma(movimiento.Fecha) + " " + tools.getTimeForma24(movimiento.Hora));
                            lblObservacion.html(movimiento.Observacion);
                            //lblEstadoMovimiento.removeClass("block-detail-right");
                            lblEstadoMovimiento.addClass("label-asignacion");
                            lblEstadoMovimiento.html(movimiento.Estado);
                            lblCodigoVerificacion.html(movimiento.CodigoVerificacion);

                            $("#btnCancelarMovimiento").unbind();

                            $("#btnCancelarMovimiento").bind("click", function() {
                                cancelarMovimiento(idMovimiento);
                            });

                            $("#btnCancelarMovimiento").bind("keydown", function(event) {
                                if (event.keyCode === 13) {
                                    cancelarMovimiento(idMovimiento);
                                }
                                event.preventDefault();
                            });

                            for (let md of movimientoDetalle) {
                                tbMovimientos.append('<tr>' +
                                    '<td class="td-center">' + md.Id + '</td>' +
                                    '<td class="td-left">' + md.Clave + '</br>' + md.NombreMarca + '</td>' +
                                    '<td class="td-right">' + tools.formatMoney(md.Cantidad) + '</td>' +
                                    +'</tr>');
                            }
                        } else {
                            tbMovimientos.empty();
                            tbMovimientos.append('<tr><td class="td-center" colspan="3">' + result.mensaje + '</td></tr>');
                        }
                    },
                    error: function(error) {
                        tbMovimientos.empty();
                        tbMovimientos.append('<tr><td class="td-center" colspan="3">Error en cargar la información.</td></tr>');
                    }
                });
            }

            function cancelarMovimiento(idMovimiento) {
                tools.ModalDialog("Ajuste", "¿Está seguro de anular el Ajuste?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/tipomovimiento/CancelarMovimiento.php",
                            method: "GET",
                            data: {
                                "idMovimiento": idMovimiento
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ajuste", "Se está procesando la información.");
                            },
                            success: function(result) {
                                if (result.estado === 1) {
                                    tools.ModalAlertSuccess("Ajuste", result.mensaje);
                                } else if (result.estado === 2) {
                                    tools.ModalAlertWarning("Ajuste", result.mensaje);
                                } else {
                                    tools.ModalAlertWarning("Ajuste", result.mensaje);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ajuste", "Se produjo un error: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function generarExcel(idMovimiento) {
                window.open("../app/sunat/exceldetalleajuste.php?idMovimiento=" + idMovimiento, "_blank");
            }
        </script>

    </body>

    </html>
<?php
}
