<?php
session_start();
$title_page = "Kardex";
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

            <!-- modal productos -->
            <div class="row">
                <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-indent">
                                    </i> Lista de Productos
                                </h4>
                                <button type="button" class="close" id="btnCloseModal">
                                    <i class="fa fa-window-close"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <label>Buscar:</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Buscar producto..." id="txtBuscarProducto" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label>Opción:</label>
                                        <div class="form-group">
                                            <button class="btn btn-default" id="btnRecargarProductos">
                                                <img src="./image/reload.png" width="18" /> Recargar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                                <thead style="background-color: #0766cc;color: white;">
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Clave/Nombre</th>
                                                        <th>Categoría/Marca</th>
                                                        <th>Cantidad</th>
                                                        <th>Impuesto</th>
                                                        <th>Precio</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbProductos">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
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

                        </div>
                    </div>
                </div>
            </div>
            <!-- modal productos -->


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Kardex <small>Lista</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-danger" id="btnReload">
                                        <i class="fa fa-sync-alt"></i> Recargar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Buscar por clave o clave alterna:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-success" id="btnProductos"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
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
                            <div class="col-md-6">
                                <label>Nombre de Producto:</label>
                                <div class="form-group">
                                    <label class="text-primary text-bold text-md" id="lblProducto">Producto</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label>Metodo</label>
                                <div class="form-group">
                                    <label class="text-primary text-bold text-md">Promedio ponderado</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label>Cantidad Actual</label>
                                <div class="form-group">
                                    <label class="text-primary text-bold text-md" id="lblCantidadActual">0.00</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label>Valor Actual</label>
                                <div class="form-group">
                                    <label class="text-primary text-bold text-md" id="lblValorActual">0.00</label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                        <thead style="background-color: #0766cc;color: white;">
                                            <tr>
                                                <th style="width: 5%;" rowspan="2">N°</th>
                                                <th style="width: 10%;" rowspan="2">Fecha</th>
                                                <th style="width: 25%;" rowspan="2">Detalle</th>
                                                <th style="width: 15%;" class="text-center" colspan="3">Unidades</th>
                                                <th style="width: 15%;" class="text-center" colspan="1">Cambios</th>
                                                <th style="width: 15%;" class="text-center" colspan="3">Valores</th>
                                            </tr>
                                            <tr>

                                                <th style="width: 10%;" class="text-center">Entrada</th>
                                                <th style="width: 10%;" class="text-center">Salida</th>
                                                <th style="width: 10%;" class="text-center">Existencia</th>
                                                <th style="width: 10%;" class="text-center">Costo variable</th>
                                                <th style="width: 10%;" class="text-center">Debe</th>
                                                <th style="width: 10%;" class="text-center">Haber</th>
                                                <th style="width: 10%;" class="text-center">Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbList">
                                            <tr>
                                                <td class="text-center" colspan="10">
                                                    <p>Tabla sin contenido.</p>
                                                </td>
                                            </tr>
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
            let tools = new Tools();

            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;

            let txtBuscarProducto = $("#txtBuscarProducto");
            let tbProductos = $("#tbProductos");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            /**/
            let tbList = $("#tbList");


            $(document).ready(function() {

                $("#btnProductos").on("click", function(event) {
                    $("#id-modal-productos").modal("show");
                    loadInitProductos();
                });

                $("#btnProductos").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("show");
                        loadInitProductos();
                    }
                    event.preventDefault();
                });


                $("#btnReload").click(function() {
                    clearElements();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        clearElements();
                    }
                    event.preventDefault();
                });

                loadComponentsModal();
            });

            function clearElements() {
                tbList.empty();
                tbList.append('<tr><td class="text-center" colspan="10"><p>Tabla sin contenido.</p> </td></tr>');
                $("#lblProducto").html("Producto");
                $("#lblCantidadActual").html("0.00");
                $("#lblValorActual").html("0.00");
                $("#txtSearch").val("");
                $("#txtSearch").focus();
            }

            function loadComponentsModal() {
                txtBuscarProducto.on("keyup", function(event) {
                    if (txtBuscarProducto.val().trim().length != 0) {
                        if (!state) {
                            paginacion = 1;
                            ListarProductos(1, txtBuscarProducto.val().trim());
                            opcion = 1;
                        }
                    }
                    event.preventDefault();
                });

                $("#btnCloseModal").on("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").on("keyup", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("hide");
                    }
                    event.preventDefault();
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

                $("#btnRecargarProductos").click(function() {
                    loadInitProductos();
                });

                $('#id-modal-productos').on('shown.bs.modal', function(e) {
                    txtBuscarProducto.focus();
                });

                $("#btnProductosNegativos").click(function() {
                    listarProductosNegativos();
                });

                $("#btnProductosNegativos").keypress(function(event) {
                    if (event.keyCode === 13) {
                        listarProductosNegativos();
                    }
                    event.preventDefault();
                });

                $("#btnTodosProductos").click(function() {
                    listarTodosLosProductos();
                });

                $("#btnTodosProductos").keypress(function(event) {
                    if (event.keyCode === 13) {
                        listarTodosLosProductos();
                    }
                    event.preventDefault();
                });

            }

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        ListarProductos(0, "");
                        break;
                    case 1:
                        ListarProductos(1, txtBuscarProducto.val().trim());
                        break;
                }
            }

            function loadInitProductos() {
                if (!state) {
                    paginacion = 1;
                    ListarProductos(0, "");
                    opcion = 0;
                }
            }

            function ListarProductos(tipo, value) {
                $.ajax({
                    url: "../app/controller/suministros/ListarSuministros.php",
                    method: "GET",
                    data: {
                        "type": "modalproductos",
                        "tipo": tipo,
                        "value": value,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbProductos.empty();
                        tbProductos.append('<tr><td class="text-center" colspan="6"><img src="./image/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
                            tbProductos.empty();
                            let productos = object.data;
                            if (productos.length === 0) {
                                tbProductos.append('<tr><td class="text-center" colspan="6"><p>No hay datos para mostrar</p></td></tr>');
                                totalPaginacion = 0;
                                lblPaginaActual.html(0);
                                lblPaginaSiguiente.html(0);
                                state = false;
                            } else {
                                for (let producto of productos) {
                                    tbProductos.append('<tr ondblclick="onSelectProducto(\'' + producto.IdSuministro + '\',\'' + producto.NombreMarca + '\')">' +
                                        '<td>' + producto.Id + '</td>' +
                                        '<td>' + producto.Clave + '</br>' + producto.NombreMarca + '</td>' +
                                        '<td>' + producto.Categoria + '<br>' + producto.Marca + '</td>' +
                                        '<td>' + tools.formatMoney(parseFloat(producto.Cantidad)) + '</td>' +
                                        '<td>' + producto.ImpuestoNombre + '</td>' +
                                        '<td>' + tools.formatMoney(parseFloat(producto.PrecioVentaGeneral)) + '</td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbProductos.empty();
                            tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbProductos.empty();
                        tbProductos.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                        state = false;
                    }
                });
            }

            function onSelectProducto(idSuministro, nombreMarca) {
                $("#id-modal-productos").modal("hide");
                $.ajax({
                    url: "../app/controller/suministros/ListarSuministros.php",
                    method: "GET",
                    data: {
                        "type": "kardexlista",
                        "idSuministro": idSuministro
                    },
                    beforeSend: function() {
                        $("#lblProducto").html(nombreMarca);
                        $("#lblCantidadActual").html("0.00");
                        $("#lblValorActual").html("0.00");
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><img src="./image/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');

                    },
                    success: function(result) {
                        if (result.estado == 1) {
                            if (result.kardex.length == 0) {
                                tbList.empty();
                                tbList.append('<tr><td class="text-center" colspan="10"><p>No hay datos para mostrar.</p></td></tr>');
                            } else {
                                tbList.empty();
                                for (let value of result.kardex) {
                                    tbList.append('<tr>' +
                                        '<td class="text-left">' + value.Id + '</td>' +
                                        '<td class="text-left">' + tools.getDateForma(value.Fecha) + '<br>' + tools.getTimeForma24(value.Hora) + '</td>' +
                                        '<td class="text-left">' + value.Nombre + '<br>' + value.Detalle + '</td>' +
                                        '<td class="text-right text-bold" style="background-color:#c6efd0;color:#297521;">' + (value.Tipo == "1" ? tools.formatMoney(value.Cantidad) : "") + '</td>' +
                                        '<td class="text-right text-bold" style="background-color:#ffc6d1;color:#890d15;">' + (value.Tipo == "2" ? "-" + tools.formatMoney(value.Cantidad) : "") + '</td>' +
                                        '<td class="text-right">' + tools.formatMoney(value.Existencia) + '</td>' +
                                        '<td class="text-right">' + tools.formatMoney(value.Costo) + '</td>' +
                                        '<td class="text-right">' + (value.Tipo == "1" ? tools.formatMoney(value.Total) : "") + '</td>' +
                                        '<td class="text-right">' + (value.Tipo == "2" ? "-" + tools.formatMoney(value.Total) : "") + '</td>' +
                                        '<td class="text-right">' + tools.formatMoney(value.Saldo) + '</td>' +
                                        '</tr>');
                                }

                                $("#lblCantidadActual").html(tools.formatMoney(result.cantidad));
                                $("#lblValorActual").html(tools.formatMoney(result.saldo));
                            }
                        } else {
                            tbList.empty();
                            tbList.append('<tr><td class="text-center" colspan="10"><p>' + result.message + '</p></td></tr>');
                        }
                    },
                    error: function(error) {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"> <p>' + error.responseText + '</p></td></tr>');
                    }
                });
            }
        </script>
    </body>

    </html>
<?php
}
