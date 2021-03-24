<?php
session_start();
$title_page = "Notificaciones";
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
                                <h1>Notificaciones <small>Lista</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12" id="divLineaTiempo">
                                <!-- The time line -->

                            </div>
                            <!-- /.col -->
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
                fillNotificacionesTable()
            });

            function fillNotificacionesTable() {
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "listarDetalleNotificaciones",
                    },
                    beforeSend: function() {
                        $("#divLineaTiempo").empty();
                    },
                    success: function(result) {                 
                        if (result.estado == 1) {
                            for (let value of result.data) {
                                $("#divLineaTiempo").append('<div class="timeline">' +
                                    '<div>' +
                                    '<i class="fas fa-file bg-green"></i>' +
                                    '<div class="timeline-item">  ' +
                                    '<span class="time"><i class="fas fa-calendar"></i> '+ tools.getDateForma(value.Fecha)+'</span>' +
                                    '<h3 class="timeline-header no-border text-primary"><b>' + value.Nombre + ' ' + value.Serie + '-' + value.Numeracion + '<b><br><span class="text-dark text-sm">' + value.Estado + '</span></h3>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>');
                            }
                        } else {
                            $("#divLineaTiempo").append('<div class="timeline">' +
                                '<div>' +
                                '<i class="fas fa-file bg-green"></i>' +
                                '<div class="timeline-item">  ' +
                                '<span class="time"><i class="fas fa-clock"></i></span>' +
                                '<h3 class="timeline-header no-border text-primary"><b>' + result.message + '<b></h3>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        }
                    },
                    error: function(error) {
                        $("#divLineaTiempo").append('<div class="timeline">' +
                            '<div>' +
                            '<i class="fas fa-file bg-green"></i>' +
                            '<div class="timeline-item">  ' +
                            '<span class="time"><i class="fas fa-clock"></i></span>' +
                            '<h3 class="timeline-header no-border text-primary"><b>' + error.responseText + '<b></h3>' +
                            '</div>' +
                            '</div>' +
                            '</div>');
                    }
                });
            }
        </script>
    </body>

    </html>
<?php
}
