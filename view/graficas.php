<?php
session_start();
$title_page = "Gráficos";
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
                                <h1>Gráficos <small>Modulos</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card card-primary">

                                    <div class="card-header">
                                        <h3 class="card-title"> <i class="fa fa-user"></i> Gráficas</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <a href="productovendidos.php">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/sitio-web.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Utilidad por Producto
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <a href="productovendidos.php">
                                                            <div class="card card-default" style="border-style: dashed;border-width: 1px;border-color: #2A2A28;">
                                                                <div class="card-body text-center">
                                                                    <img src="image/portapapeles.png" alt="Vender" width="87">
                                                                    <p style="margin-top: 10px;font-size: 14pt;color:#C68907;">
                                                                        Producto Vendidos y no Vendidos
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

            });
        </script>
    </body>

    </html>
<?php
}
