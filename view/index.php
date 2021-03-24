<?php
session_start();
$title_page = "Dashboard";
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "./login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include 'layout/head.php'; ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <?php include 'layout/header.php'; ?>
            <!-- /.navbar -->


            <!-- Main Sidebar Container -->
            <?php include 'layout/menu.php'; ?>

            <div class="content-wrapper">
                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Dashboard <small>Panel de control</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id="lblTotalVentas">S/ 0.00</h3>

                                        <p>VENTAS DEL DÍA</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 id="lblTotalCompras">S/ 0.00</h3>

                                        <p>COMPRAS DEL DÍA</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 id="lblTotalCuentasPorCobrar">0</h3>

                                        <p>CUENTAS POR COBRAR</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 id="lblTotalCuentasPorPagar">0</h3>

                                        <p>CUENTAS POR PAGAR</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Gráficos de las Ventas Por Mes</h5>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-center">
                                                    <strong id="lblMesActual">Ventas: --, --</strong>
                                                </p>
                                                <div class="chart">
                                                    <div class="card-body">
                                                        <div class="position-relative mb-4">
                                                            <div class="chartjs-size-monitor">
                                                                <div class="chartjs-size-monitor-expand">
                                                                    <div class=""></div>
                                                                </div>
                                                                <div class="chartjs-size-monitor-shrink">
                                                                    <div class=""></div>
                                                                </div>
                                                            </div>
                                                            <canvas id="sales-chart" height="200" style="display: block; width: 366px; height: 200px;" width="366" class="chartjs-render-monitor"></canvas>
                                                        </div>

                                                        <div class="d-flex flex-row justify-content-end">
                                                            <span class="mr-2">
                                                                <i class="fas fa-square text-primary"></i> Este Año
                                                            </span>

                                                            <span>
                                                                <i class="fas fa-square text-gray"></i> Año Pasado
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Los 10 Productos Más Vendidos del Mes y Día</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="products-list product-list-in-card pl-2 pr-2" id="tvProductos">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            <li class="pt-2 px-3">
                                                <h3 class="card-title">Estado del Inventario</h3>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">Productos Agotados</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Productos por Agotarse</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div id="tvProductoAgotado">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <div class="form-group">
                                                            <button class="btn btn-default" id="btnPaginaAnteriorAgotados">
                                                                <i class="fa fa fa-arrow-circle-left"></i>
                                                            </button>
                                                            <span class="m-2" id="lblPaginaActualAgotados">1</span>
                                                            <span class="m-2">de</span>
                                                            <span class="m-2" id="lblPaginaSiguienteAgotados">1</span>
                                                            <button class="btn btn-default" id="btnPaginaSiguienteAgotados">
                                                                <i class="fa fa fa-arrow-circle-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div id="tvProductoPorAgotarse">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <div class="form-group">
                                                            <button class="btn btn-default" id="btnPaginaAnteriorPorAgotarse">
                                                                <i class="fa fa fa-arrow-circle-left"></i>
                                                            </button>
                                                            <span class="m-2" id="lblPaginaActualPorAgotarse">0</span>
                                                            <span class="m-2">de</span>
                                                            <span class="m-2" id="lblPaginaSiguientePorAgotarse">0</span>
                                                            <button class="btn btn-default" id="btnPaginaSiguientePorAgotarse">
                                                                <i class="fa fa fa-arrow-circle-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php include('./layout/footer.php') ?>
        </div>
        <!-- ./wrapper -->
        <script src="./js/notificaciones.js"></script>
        <script>
            'use strict'
            let tools = new Tools();
            let buttonSelected = false;
            let buttonAgotadosSelected = false;

            let productoVendidos = $("#tvProductos");


            let productoAgotado = $("#tvProductoAgotado");
            let posicionPaginaAgotados = 0;
            let filasPorPaginaAgotados = 7;
            let totalPaginacionAgotadas = 0;

            let productosPorAgotarse = $("#tvProductoPorAgotarse");
            let posicionPaginaPorAgotarse = 0;
            let filasPorPaginaPorAgotarse = 7;
            let totalPaginacionPorAgotarse = 0;

            $(document).ready(function() {

                $("#btnCerrarSession").click(function() {
                    window.location.href = "./closesession.php";
                });

                $("#lblMesActual").html("Ventas: " + tools.nombreMes(tools.getCurrentMonth()) + ", " + tools.getCurrentYear());

                //botones de Productos por agotarse
                $("#btnPaginaAnteriorAgotados").click(function() {
                    if (posicionPaginaAgotados > 1) {
                        posicionPaginaAgotados--;
                        cargarProductosAgotados();
                    }
                });

                $("#btnPaginaSiguienteAgotados").click(function() {
                    if (posicionPaginaAgotados < totalPaginacionAgotadas) {
                        posicionPaginaAgotados++;
                        cargarProductosAgotados();
                    }
                });

                $("#btnPaginaAnteriorPorAgotarse").click(function() {
                    if (posicionPaginaPorAgotarse > 1) {
                        posicionPaginaPorAgotarse--;
                        cargarProductosPorAgotarse();
                    }
                });

                $("#btnPaginaSiguientePorAgotarse").click(function() {
                    if (posicionPaginaPorAgotarse < totalPaginacionPorAgotarse) {
                        posicionPaginaPorAgotarse++;
                        cargarProductosPorAgotarse();
                    }
                });

                cargarDashboard();
            });

            function cargarDashboard() {
                posicionPaginaAgotados = 1;
                posicionPaginaPorAgotarse = 1;
                let totalVentas = $("#lblTotalVentas");
                let totalCompras = $('#lblTotalCompras');
                let totalCuentasPorCobrar = $('#lblTotalCuentasPorCobrar');
                let totalCuentasPorPagar = $('#lblTotalCuentasPorPagar');

                $.ajax({
                    url: "../app/controller/ventas/CargarDashboard.php",
                    method: "GET",
                    data: {
                        type: "global",
                        fechaActual: tools.getCurrentDate(),
                        posicionPaginaAgotados: ((posicionPaginaAgotados - 1) * filasPorPaginaAgotados),
                        filasPorPaginaAgotados: filasPorPaginaAgotados,

                        posicionPaginaPorAgotarse: ((posicionPaginaPorAgotarse - 1) * filasPorPaginaPorAgotarse),
                        filasPorPaginaPorAgotarse: filasPorPaginaPorAgotarse,
                    },
                    beforeSend: function() {
                        productoVendidos.empty();
                    },
                    success: function(result) {
                        console.log(result.data[0])
                        totalVentas.html("S/  " + tools.formatMoney(result.data[0].TotalVentas));
                        totalCompras.html("S/  " + tools.formatMoney(result.data[0].TotalCompras));
                        totalCuentasPorCobrar.html(result.data[0].TotalCuentasCobrar);
                        totalCuentasPorPagar.html(result.data[0].TotalCuentasPagar);
                        let productosVendidos = result.data[0].ProductosMasVendidos;
                        for (let data of productosVendidos) {
                            let image = "./image/noimage.jpg";
                            if (data.Imagen != '') {
                                image = ("data:image/png;base64," + data.Imagen);
                            }
                            productoVendidos.append('<li class="item">' +
                                '<div class="product-img">' +
                                '    <img src="' + image + '" alt="Product Image" class="img-size-100">' +
                                '</div>' +
                                '<div class="product-info">' +
                                '    <a href="javascript:void(0)" class="product-title">' + data.NombreMarca + '' +
                                '        <span class="badge badge-warning float-right">' + tools.formatMoney(data.Cantidad, 0) + ' ' + data.Medida + '</span></a>' +
                                '</div>' +
                                '</li>');
                        }

                        // /*vista donde carga */
                        let dataActual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        for (let value of result.data[0].VentasMesActual) {
                            if (value.Mes == 1) {
                                dataActual[0] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 2) {
                                dataActual[1] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 3) {
                                dataActual[2] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 4) {
                                dataActual[3] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 5) {
                                dataActual[4] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 6) {
                                dataActual[5] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 7) {
                                dataActual[6] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 8) {
                                dataActual[7] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 9) {
                                dataActual[8] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 10) {
                                dataActual[9] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 11) {
                                dataActual[10] = tools.formatMoney(value.Monto)
                            } else if (value.Mes == 12) {
                                dataActual[11] = tools.formatMoney(value.Monto)
                            }
                        }
                        diagramaVentas(dataActual)
                        ProductosAgotados(result);
                        ProductosPorAgotarse(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function cargarProductosAgotados() {
                $.ajax({
                    url: "../app/controller/ventas/CargarDashboard.php",
                    method: "GET",
                    data: {
                        type: "productosAgotados",
                        posicionPaginaAgotados: ((posicionPaginaAgotados - 1) * filasPorPaginaAgotados),
                        filasPorPaginaAgotados: filasPorPaginaAgotados
                    },
                    beforeSend: function() {
                        productoAgotado.empty();
                    },
                    success: function(result) {
                        ProductosAgotados(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function cargarProductosPorAgotarse() {
                $.ajax({
                    url: "../app/controller/ventas/CargarDashboard.php",
                    method: "GET",
                    data: {
                        type: "productosPorAgotarse",
                        posicionPaginaPorAgotarse: ((posicionPaginaPorAgotarse - 1) * filasPorPaginaPorAgotarse),
                        filasPorPaginaPorAgotarse: filasPorPaginaPorAgotarse,
                    },
                    beforeSend: function() {
                        productosPorAgotarse.empty();
                    },
                    success: function(result) {
                        ProductosPorAgotarse(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function ProductosAgotados(result) {
                let productosAgotados = result.productosAgotadosLista;
                if (productosAgotados.length == 0) {

                    totalPaginacionAgotadas = 0;
                    $("#lblPaginaActualAgotados").html(0);
                    $("#lblPaginaSiguienteAgotados").html(0);
                } else {
                    for (let data of productosAgotados) {
                        productoAgotado.append('<div class="info-box mb-3 bg-danger">' +
                            '    <span class="info-box-icon"><i class="fas fa-bell-slash"></i></span>' +
                            '    <div class="info-box-content">' +
                            '        <span class="info-box-text">' + data.NombreProducto.substr(0, 35) + '</span>' +
                            '        <span class="info-box-number">Agotados: ' + tools.formatMoney(data.Cantidad, 2) + '</span>' +
                            '    </div>' +
                            '</div>');
                    }
                    totalPaginacionAgotadas = parseInt(Math.ceil((parseFloat(result.productosAgotadosTotal) / filasPorPaginaAgotados)));
                    $("#lblPaginaActualAgotados").html(posicionPaginaAgotados);
                    $("#lblPaginaSiguienteAgotados").html(totalPaginacionAgotadas);
                }
            }

            function ProductosPorAgotarse(result) {
                let prodcutosAgotados = result.productoPorAgotarseLista;
                if (prodcutosAgotados.length == 0) {


                    totalPaginacionPorAgotarse = 0;
                    $("#lblPaginaActualPorAgotarse").html(0);
                    $("#lblPaginaSiguientePorAgotarse").html(0);
                } else {
                    for (let data of prodcutosAgotados) {

                        productosPorAgotarse.append('<div class="info-box mb-3 bg-warning">' +
                            ' <span class="info-box-icon"><i class="fas fa-tag"></i></span>' +
                            ' <div class="info-box-content">' +
                            '     <span class="info-box-text">' + data.NombreProducto.substr(0, 35) + '</span>' +
                            '     <span class="info-box-number">P/Agotarse: ' + tools.formatMoney(data.Cantidad, 0) + '</span>' +
                            '</div>                                                   ' +
                            '</div>');

                    }
                    totalPaginacionPorAgotarse = parseInt(Math.ceil((parseFloat(result.productoPorAgotarseTotal) / filasPorPaginaPorAgotarse)));
                    $("#lblPaginaActualPorAgotarse").html(posicionPaginaPorAgotarse);
                    $("#lblPaginaSiguientePorAgotarse").html(totalPaginacionPorAgotarse);
                }

            }


            function diagramaVentas(dataActual, dataPasada) {
                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                }

                var mode = 'index'
                var intersect = true

                var $salesChart = $('#sales-chart')
                var salesChart = new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV', 'DIC'],
                        datasets: [{
                                backgroundColor: '#007bff',
                                borderColor: '#007bff',
                                data: dataActual
                            },
                            {
                                backgroundColor: '#ced4da',
                                borderColor: '#ced4da',
                                data: dataPasada
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return 'S/ ' + value
                                    }
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })

            }
        </script>
    </body>

    </html>
<?php }
