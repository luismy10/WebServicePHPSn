<?php
session_start();
$title_page = "Productos vendidos";
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
                                <h1>Utilidad por Producto <small>Gráficas</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row ">

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Fecha Inicio:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="txtFechaInicio">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Fecha FIn:</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="txtFechaTermino">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Marca:</label>
                                <div class="form-group">
                                    <select class="form-control" id="cbMarca">
                                        <option value="0">- Seleccione -</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Categoría:</label>
                                <div class="form-group">
                                    <select class="form-control" id="cbCategoria">
                                        <option value="0">- Seleccione -</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Procesar</label>
                                <div class="form-group">
                                    <button class="btn btn-danger" id="btnGenerar">
                                        <i class="fa fa-chart-line"></i>
                                        Generar Gráfica
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Opciones</label>
                                <div class="form-group">
                                    <button class="btn btn-success" id="btnExcel">
                                        <i class="fa fa-file-excel"></i>
                                        Generar Excel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Productos</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Gráfica de ventas de un producto en un periodo de tiempo</strong>
                                        </p>
                                        <div class="chart-responsive">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="barChart" height="200" style="display: block; width: 366px; height: 200px;" width="366" class="chartjs-render-monitor"></canvas>
                                        </div>
                                        <!-- ./chart-responsive -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer bg-light p-0">
                                <div class="row">
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right">
                                            <h5 class="description-header" id="lblCostoTotal">0.00</h5>
                                            <span class="description-text">Costo Total</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right">
                                            <h5 class="description-header" id="lblPrecioTotal">0.00</h5>
                                            <span class="description-text">Precio Total</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-6">
                                        <div class="description-block border-right">
                                            <h5 class="description-header" id="lblUtilidadGenerada">0.00</h5>
                                            <span class="description-text">Utilidad Generada</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <ul class="products-list product-list-in-card pl-2 pr-2" id="ulListaProductos">

                                </ul>
                            </div>
                            <!-- /.footer -->
                        </div>

                    </div>
                </section>
            </div>
            <?php include('./layout/footer.php') ?>
        </div>
        <script src="./js/notificaciones.js"></script>

        <script>
            let tools = new Tools();
            let barChartCanvas = $('#barChart').get(0).getContext('2d');
            let barChart = null;
            $(document).ready(function() {

                $("#txtFechaInicio").val(tools.getCurrentDate());

                $("#txtFechaTermino").val(tools.getCurrentDate());

                $("#btnGenerar").click(function() {
                    if (!tools.validateDate($("#txtFechaInicio")) && !tools.validateDate($("#txtFechaTermino"))) {
                        loadProductosVendidos();
                    }
                });

                $("#btnGenerar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadProductosVendidos();
                    }
                    event.preventDefault();
                });

                $("#btnExcel").click(function() {
                    if (!tools.validateDate($("#txtFechaInicio")) && !tools.validateDate($("#txtFechaTermino"))) {
                        window.open("../app/sunat/excelutilidadgenerada.php?fechaInicio=" + $("#txtFechaInicio").val() + "&fechaFinal=" + $("#txtFechaTermino").val() + "&marca=" + $("#cbMarca").val() + "&categoria=" + $("#cbCategoria").val(), "_blank");
                    }
                });

                $("#btnExcel").keypress(function(event) {
                    if (event.keyCode === 13) {

                    }
                    event.preventDefault();
                });

                loadComponents("0007", $("#cbMarca"))
                loadComponents("0006", $("#cbCategoria"))
            });


            function loadComponents(idMantenimiento, select) {
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "detalleid",
                        "idMantenimiento": idMantenimiento
                    },
                    beforeSend: function() {
                        select.empty();
                    },
                    success: function(result) {
                        if (result.estado == 1) {
                            select.append('<option value="0">- Seleccione -</option>');
                            for (let value of result.data) {
                                select.append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                            }
                        } else {
                            select.append('<option value="0">- Seleccione warning-</option>');
                        }
                    },
                    error: function(error) {
                        select.append('<option value="0">- Seleccione error -</option>');
                    }
                });
            }

            function loadProductosVendidos() {
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "getproductosvendidos",
                        "fechaInicio": $("#txtFechaInicio").val(),
                        "fechaFinal": $("#txtFechaTermino").val(),
                        "marca": $("#cbMarca").val(),
                        "categoria": $("#cbCategoria").val(),
                    },
                    beforeSend: function() {
                        $("#ulListaProductos").empty();
                    },
                    success: function(result) {
                        if (result.estado == 1) {
                            let dataSet = [];
                            let totalCosto = 0;
                            let totalPrecio = 0;
                            let totalUtilidad = 0;
                            for (let value of result.data) {
                                let color = dame_color_aleatorio();
                                dataSet.push({
                                    label: value.NombreMarca,
                                    backgroundColor: color,
                                    borderColor: color,
                                    data: [tools.formatMoney(value.Utilidad)]
                                });

                                $("#ulListaProductos").append('<li class="item">' +
                                    '<div class="product-info m-0">' +
                                    '    <p class="product-title m-0">' + value.NombreMarca + '   <i class="fa fa-square-full" style="color:' + color + ';"></i>' +
                                    '        <span class="badge badge-warning float-right text-md">Utilidad: ' + tools.formatMoney(value.Utilidad) + '</span></p>' +
                                    '    <span class="product-description">' +
                                    '        ' + tools.formatMoney(value.Cantidad) + ' ' + value.Medida + '' +
                                    '    </span>' +
                                    '</div>' +
                                    '</li>  ');

                                totalCosto += value.CostoTotal;
                                totalPrecio += value.PrecioTotal;
                                totalUtilidad += value.Utilidad;
                            }
                            $("#lblCostoTotal").html(tools.formatMoney(totalCosto));
                            $("#lblPrecioTotal").html(tools.formatMoney(totalPrecio));
                            $("#lblUtilidadGenerada").html(tools.formatMoney(totalUtilidad));
                            pieChart(dataSet);
                        } else {
                            $("#lblUtilidadGenerada").html(tools.formatMoney(0));
                        }
                        console.log(result)
                    },
                    error: function(error) {
                        $("#lblUtilidadGenerada").html(tools.formatMoney(0));
                        console.log(error)
                    }
                });
            }

            function pieChart(data) {
                if (barChart != null) {
                    barChart.destroy();
                }
                barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: ["Productos"],
                        datasets: data
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        maintainAspectRatio: false,
                        datasetFill: false
                    }
                });

            }

            function dame_color_aleatorio() {
                let hexadecimal = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F")
                let color_aleatorio = "#";
                for (i = 0; i < 6; i++) {
                    posarray = aleatorio(0, hexadecimal.length)
                    color_aleatorio += hexadecimal[posarray]
                }
                return color_aleatorio
            }

            function aleatorio(inferior, superior) {
                numPosibilidades = superior - inferior
                aleat = Math.random() * numPosibilidades
                aleat = Math.floor(aleat)
                return parseInt(inferior) + aleat
            }
        </script>

    </body>

    </html>
<?php
}
