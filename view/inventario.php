<?php
session_start();
$title_page = "Inventario";
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
                                <h1>Inventario General <small>Lista</small>
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
                                    <button class="btn btn-danger" id="btnReload">
                                        <i class="fa fa-sync-alt"></i> Recargar
                                    </button>
                                    <button class="btn btn-default">
                                        <i class="fa fa-file-alt"></i> Reporte
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Buscar por clave:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ingrese la clave o clave alterna" id="txtClaveProducto">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Buscar por descripción:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ingrese la descripción del producto" id="txtDescripcionProducto">
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                                <th style="width: 5%;">N°</th>
                                                <th style="width: 25%;">Descripción</th>
                                                <th style="width: 10%;">Categoría</th>
                                                <th style="width: 10%;">Marca</th>
                                                <th style="width: 15%;">Cantidad</th>
                                                <th style="width: 15%;">Inv.Min / Inv.Max</th>
                                                <th style="width: 10%;">Inventario</th>
                                                <th style="width: 5%;">Estado</th>
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

            let tools = new Tools();

            let tbody = $("#tbList");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            let txtClaveProducto = $("#txtClaveProducto");
            let txtDescripcionProducto = $("#txtDescripcionProducto");

            $(document).ready(function() {
                $("#btnCerrarSession").click(function() {
                    window.location.href = "closesession.php";
                });

                loadInitInventario();

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

                $("#btnReload").on("click", function(event) {
                    loadInitInventario();
                });

                $("#btnReload").on("keydown", function(event) {
                    if (event.keyCode === 13) {
                        loadInitInventario();
                    }
                });

                txtClaveProducto.on("keyup", function() {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (txtClaveProducto.val().trim() !== "") {
                            if (!state) {
                                paginacion = 1;
                                fillInventarioTable(txtClaveProducto.val(), "", 1);
                                opcion = 1;
                            }
                        }
                    }

                });

                txtDescripcionProducto.on("keyup", function() {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (txtDescripcionProducto.val().trim() !== "") {
                            if (!state) {
                                paginacion = 1;
                                fillInventarioTable("", txtDescripcionProducto.val(), 2);
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#tbList").on("click", "tr", function(event) {
                    $(".selected-table-tr").removeClass("selected-table-tr");
                    $(this).addClass("selected-table-tr");
                });

            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        fillInventarioTable("", "", 0);
                        break;
                    case 1:
                        fillInventarioTable(txtClaveProducto.val(), "", 1);
                        break;
                    case 2:
                        fillInventarioTable("", txtDescripcionProducto.val(), 2);
                        break;
                }
            }

            function loadInitInventario() {
                if (!state) {
                    paginacion = 1;
                    fillInventarioTable("", "", 0);
                    opcion = 0;
                }
            }

            function fillInventarioTable(producto, nombre, opcion) {
                $.ajax({
                    url: "../app/controller/suministros/ListarInventario.php",
                    method: "GET",
                    data: {
                        "producto": producto,
                        "existencia": 0,
                        "nombre": nombre,
                        "opcion": opcion,
                        "categoria": 0,
                        "marca": 0,
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
                            let suministros = object.data;
                            if (suministros.length == 0) {
                                tbody.empty();
                                tbody.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar</p></td></tr>');
                                lblPaginaActual.html(0);
                                lblPaginaSiguiente.html(0);
                                state = false;
                            } else {
                                tbody.empty();
                                for (let suministro of suministros) {
                                    tbody.append('<tr>' +
                                        '<td data-label="N°" class="td-center">' + suministro.count + '</td>' +
                                        '<td data-label="Descripción" class="td-left">' + suministro.Clave + (suministro.ClaveAlterna === "" ? "" : "-" + suministro.ClaveAlterna) + "</br>" + suministro.NombreMarca + '</td>' +
                                        '<td data-label="Categoría" class="td-left">' + suministro.Categoria + '</td>' +
                                        '<td data-label="Marca" class="td-left">' + suministro.Marca + '</td>' +
                                        '<td data-label="Cantidad" class="td-right ' + (suministro.Cantidad <= 0 ? "text-danger " : "text-success") + '">' +
                                        tools.formatMoney(suministro.Cantidad) + " " + suministro.UnidadCompra +
                                        '</td>' +
                                        //                                            '<td data-label="Costo General" class="td-right">' + formatMoney(suministro.PrecioCompra) + '</td>' +
                                        //                                            '<td data-label="Precio General" class="td-right">' + formatMoney(suministro.PrecioVentaGeneral) + '</td>' +
                                        '<td data-label="Inv.Min / Inv.Max" class="td-right">' + (tools.formatMoney(suministro.StockMinimo) + " - " + tools.formatMoney(suministro.StockMaximo)) + '</td>' +
                                        '<td data-label="Estado" class="td-center">' + (suministro.Inventario === "1" ? "Si" : "No") + '</td>' +
                                        '<td data-label="Estado" class="td-center">' + (suministro.Estado === "1" ? "Activo" : "Inactivo") + '</td>' +
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
                            lblPaginaActual.html(0);
                            lblPaginaSiguiente.html(0);
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbody.empty();
                        tbody.append('<tr><td class="text-center" colspan="8"><p>Error en: ' + error.responseText + '</p></td></tr>');
                        lblPaginaActual.html(0);
                        lblPaginaSiguiente.html(0);
                        state = false;
                    }
                });
            }
        </script>

    </body>

    </html>
<?php
}
