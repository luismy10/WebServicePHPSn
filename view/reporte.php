<?php
session_start();
$title_page = "Reportes";
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

            <!-- Modal Resumen de ingresos -->
            <div class="row">
                <div class="modal fade" id="linkListaIngresos">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-file-pdf"></i> Resumen de Ingresos Filtros
                                </h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="fa fa-window-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fi_ingresos">Fecha Inicio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="fi_ingresos" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ff_ingresos">Fecha Fin: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="ff_ingresos" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="btnAceptarIngresos" data-dismiss="modal">
                                    <i class="fa fa-check"></i> Aceptar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fa fa-times-circle"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Resumen de utilidad generada -->
            <div class="row">
                <div class="modal fade" id="linkUtilidadGenerada">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-file-pdf-o"></i> Utilidad Generada
                                </h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="fa fa-window-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fi_utilidad">Fecha Inicio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="fi_utilidad" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ff_utilidad">Fecha Fin: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="ff_utilidad" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="btnAceptarUtilidades">
                                    <i class="fa fa-file-pdf-o"></i> Generar PDF</button>
                                <button type="submit" class="btn btn-success" id="btnAceptarUtilidades">
                                    <i class="fa fa-file-excel-o"></i> Generar Excel</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fa fa-times-circle"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <!-- Modal resumen global -->
            <div class="row">
                <div class="modal fade" id="linkReporteGlobal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-file-pdf-o"></i> Resumen Global
                                </h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fi_global">Fecha Inicio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="fi_global" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ff_global">Fecha Fin: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="ff_global" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="btnAceptarResumenGlobal">
                                    <i class="fa fa-check"></i> Aceptar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fa fa-times-circle"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <!-- Modal reporte cliente -->
            <div class="row">
                <div class="modal fade" id="linkReporteClientes">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-file-pdf-o"></i> Reporte de Clientes
                                </h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fi_clientes">Fecha Inicio: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="fi_clientes" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ff_clientes">Fecha Fin: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                            <input id="ff_clientes" type="date" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="btnAceptarResumenClientes">
                                    <i class="fa fa-check"></i> Aceptar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    <i class="fa fa-times-circle"></i> Cancelar</button>
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
                                <h1>Reportes <small>Documento</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card card-primary">

                                    <div class="card-header">
                                        <h3 class="card-title"> <i class="fa fa-user"></i> Reportes</h3>
                                    </div>

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 text-center">

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="" data-toggle="modal" data-target="#linkListaIngresos">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/portapapeles.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Resumen de Ingresos
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="" data-toggle="modal" data-target="#linkUtilidadGenerada">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/sitio-web.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Utilidade Generada
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="" data-toggle="modal" data-target="#linkReporteGlobal">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/reportglobal.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Reporte Global
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                        <a href="" data-toggle="modal" data-target="#linkReporteClientes">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/reportclient.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Reporte de Clientes
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>

                                    </div>
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
            let tools = new Tools();

            $(document).ready(function() {

                $("#fi_ingresos").val(tools.getCurrentDate())
                $("#ff_ingresos").val(tools.getCurrentDate())

                $("#fi_utilidad").val(tools.getCurrentDate())
                $("#ff_utilidad").val(tools.getCurrentDate())

                $("#fi_global").val(tools.getCurrentDate())
                $("#ff_global").val(tools.getCurrentDate())

                $("#fi_clientes").val(tools.getCurrentDate())
                $("#ff_clientes").val(tools.getCurrentDate())
                //------------------------------------------------------------------------------------------------------------------------

                $("#btnAceptarIngresos").click(function() {
                    let fechaInicial = $("#fi_ingresos").val();
                    let fechaFinal = $("#ff_ingresos").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        window.open("../app/sunat/resumeningresos.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, "_blank");
                    }

                });

                //------------------------------------------------------------------------------------------------------------------------

                $("#btnAceptarUtilidades").click(function() {
                    let fechaInicial = $("#fi_utilidad").val();
                    let fechaFinal = $("#ff_utilidad").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        window.open("../app/sunat/utilidadgenerada.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, "_blank");
                    }

                });

                //------------------------------------------------------------------------------------------------------------------------

                $("#btnAceptarResumenGlobal").click(function() {
                    let fechaInicial = $("#fi_global").val();
                    let fechaFinal = $("#ff_global").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        window.open("../app/sunat/resumengeneral.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, "_blank");
                    }

                });

                //------------------------------------------------------------------------------------------------------------------------

                $("#btnAceptarResumenClientes").click(function() {
                    let fechaInicial = $("#fi_clientes").val();
                    let fechaFinal = $("#ff_clientes").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        window.open("../app/sunat/reporteclientes.php?fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal, "_blank");
                    }

                });

            });
        </script>
    </body>

    </html>
<?php
}
