<?php
session_start();
$title_page = "Registrar producto";
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
                <div class="modal fade" id="idOpciones" data-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <i class="fa fa-plus">
                                    </i> Agregar unidad de medida
                                </h4>
                                <button id="btnCloseModal" type="button" class="close">
                                    <i class="fa fa-window-close"></i>
                                </button>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Buscar..." id="txtBuscar" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-default" id="btnRecargarProductos">
                                                <img src="./image/plus.png" width="20" />
                                            </button>
                                            <button class="btn btn-default" id="btnRecargarProductos">
                                                <img src="./image/edit.png" width="20" />
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="overflow:auto; height:320px">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-hover">
                                            <tbody id="tbLista">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <label class="text-center">Seleccione un elemento de la lista con doble click</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal end -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Header content -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Registrar <small>Producto</small>
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
                                        <img src="./image/error.svg" width="18" /> Limpiar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Información General</h3>
                                    </div>
                                    <div class="card-body">
                                        <!-- body -->
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12 padding-vertical-5 padding-horizontal-10  row-reverse-reverse">
                                                        <label>Clave <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Clave del producto" id="txtClave" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 padding-vertical-5 padding-horizontal-10  row-reverse-reverse">
                                                        <label>Clave Alterna</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Clave alterna del producto" id="txtClaveAlterna" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center margin">
                                                        <img src="./image/noimage.jpg" style="object-fit: cover;" width="160" height="160" id="lblImagen">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center m-2">
                                                        <input type="file" id="fileImage" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                                        <label for="fileImage" class="btn btn-default m-0">
                                                            <div class="content-button">
                                                                <img src="./image/photo.png" width="22" />
                                                                <span></span>
                                                            </div>
                                                        </label>
                                                        <button class="btn btn-default" id="btnRemove">
                                                            <img src="./image/remove-gray.png" width="22" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Descripción <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave del producto" id="txtDescripcion" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <label>Unidad de Medida(Precione espacio o doble click) <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Clave del producto" id="txtUnidadMedida" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <label>Categoría(Precione espacio o doble click) <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Clave del producto" id="txtCategoria" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>
                                                    Se Vende <i class="text-danger fa fa-info-circle"></i>
                                                </label>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbUnidad" name="tbSeVende" checked />
                                                            <label for="rbUnidad">
                                                                &nbsp;Por Unidad/Pza o Por Precio Base
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbMoneda" name="tbSeVende" />
                                                            <label for="rbMoneda">
                                                                &nbsp; Por Valor Monetario
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbGranel" name="tbSeVende" />
                                                            <label for="rbGranel">
                                                                &nbsp; A granel(Km,Ml,Mc, etc.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- body -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Información de Almacen</h3>
                                    </div>
                                    <div class="card-body">
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <label>Costo <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Costo de compra" id="txtCosto" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <label>Stock mínimo </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Stock mínimo" id="txtStockMinimo" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <label>Stock máximo </label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Stock máximo" id="txtStockMaximo" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Valor de salida del producto</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbUnidadSalida" name="tbValorSalida" checked />
                                                            <label for="rbUnidadSalida">
                                                                &nbsp; Por Unidades(cantidades)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbMonedaSalida" name="tbValorSalida" />
                                                            <label for="rbMonedaSalida">
                                                                &nbsp; Por valor monetario(S/, $, U, etc.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbGranelSalida" name="tbValorSalida" />
                                                            <label for="rbGranelSalida">
                                                                &nbsp;Por medidas(kg, cm, falón, etc.)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Impuesto <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <select class="form-control" id="cbImpuesto">
                                                        <option value="">- Seleccione -</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbPrecioNormal" name="tbTipoPrecio" checked />
                                                    <label for="rbPrecioNormal">
                                                        &nbsp;Lista de Precio Normal
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12" id="divPrecioNormal">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Precio General" id="txtPrecioGeneral" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <label>Precio 2 </label>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Precio 2" id="txtPrecio2" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <label>Precio 3 </label>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Precio 3" id="txtPrecio3" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbPrecioPersonalizado" name="tbTipoPrecio" />
                                                    <label for="rbPrecioPersonalizado">
                                                        &nbsp;Lista de Precios Personalizados
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12" id="divPrecioPersonalizado" style="display:none;">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Clave del producto" id="txtPrecioGeneralPersonalizado" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <label>Opción </label>
                                                        <div class="form-group">
                                                            <button class="btn btn-success" id="btnAgregar">
                                                                <i class="fa fa-plus"></i> Agregar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:30%">Nombre</th>
                                                                    <th style="width:30%">Precio del Monto</th>
                                                                    <th style="width:30%">Cantidad</th>
                                                                    <th style="width:10%">Opcion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbPrecios">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Información Adicional</h3>
                                    </div>
                                    <div class="card-body">
                                        <!--  -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Descripción alterna </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Descripción alterna " id="txtDescripcionAlterna" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Estado </label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="rbActivo" name="tbEstado" checked />
                                                            <label for="rbActivo">
                                                                &nbsp; Activo
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <input type="radio" id="tbDesactivo" name="tbEstado" />
                                                            <label for="tbDesactivo" class="radio-custom-label">
                                                                &nbsp; Inactivo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Marca(Precione espacio o doble click) </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Marca" id="txtMarca" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Presentación(Precione espacio o doble click) </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Presentación" id="txtPresentacion" autocomplete="false" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Clave única del producto </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave única del producto" id="txtClaveUnica" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="checkbox" id="cbLote">
                                                    <label for="cbLote">Lote(Indica si manejara un control de lotes y caducidades para este artículo)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  -->
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
            let tbPrecios = $("#tbPrecios");

            let mantenimiento = "";
            let idUnidadMedida = 0;
            let idCategoria = 0;
            let idMarca = 0;
            let idPresentacion = 0;

            $(document).ready(function() {

                $(document).keydown(function(event) {
                    if (event.keyCode === 27) {
                        $("#idOpciones").modal("hide");
                        $("#txtClave").focus();
                    }
                });

                $("#fileImage").on('change', function(event) {
                    $("#lblImagen").attr("src", URL.createObjectURL(event.target.files[0]));
                });

                $("#btnRemove").click(function() {
                    $("#lblImagen").attr("src", "./image/noimage.jpg");
                    $("#fileImage").val(null);
                });

                $("#btnRemove").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#lblImagen").attr("src", "./image/noimage.jpg");
                        $("#fileImage").val(null);
                    }
                    event.preventDefault();
                });

                // $("#txtClave").keypress(function(event) {
                //     var key = window.Event ? event.which : event.keyCode;
                //     var c = String.fromCharCode(key);
                //     if ((c < '0' || c > '9') && (c != '\b') && (c < 'a' || c > 'z') && (c < 'A' || c > 'Z')) {
                //         event.preventDefault();
                //     }
                // });

                // $("#txtClaveAlterna").keypress(function(event) {
                //     var key = window.Event ? event.which : event.keyCode;
                //     var c = String.fromCharCode(key);
                //     if ((c < '0' || c > '9') && (c != '\b') && (c < 'a' || c > 'z') && (c < 'A' || c > 'Z')) {
                //         event.preventDefault();
                //     }
                // });

                $("#txtCosto").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtCosto").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtStockMinimo").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtStockMinimo").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtStockMaximo").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtStockMaximo").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtUnidadMedida").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtCategoria").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtMarca").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtPresentacion").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#rbPrecioNormal").change(function() {
                    $("#divPrecioPersonalizado").css("display", "none");
                    $("#divPrecioNormal").css("display", "block");
                });

                $("#rbPrecioPersonalizado").change(function() {
                    $("#divPrecioNormal").css("display", "none");
                    $("#divPrecioPersonalizado").css("display", "block");
                });

                $("#btnAgregar").click(function() {
                    tbPrecios.append('<tr id="' + $("#tbPrecios tr").length + '">' +
                        '   <td><input type="text" class="form-control" value="Precio ' + ($("#tbPrecios tr").length == 0 ? 1 : $("#tbPrecios tr").length + 1) + '"></td>' +
                        '   <td><input type="number" class="form-control"  value="0.00"></td>' +
                        '   <td><input type="number" class="form-control"  value="0"></td>' +
                        '   <td class="td-center">' +
                        '    <button class="btn btn-default" onclick="removePrecio(\'' + $("#tbPrecios tr").length + '\')"><img src="./image/remove.png" width="18" /></button>' +
                        '   </td>' +
                        ' </tr>');
                });

                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        tbPrecios.append('<tr id="' + $("#tbPrecios tr").length + '">' +
                            '   <td><input type="text" class="form-control" value="Precio ' + ($("#tbPrecios tr").length == 0 ? 1 : $("#tbPrecios tr").length + 1) + '"></td>' +
                            '   <td><input type="number" class="form-control" value="0.00"></td>' +
                            '   <td><input type="number" class="form-control" value="0"></td>' +
                            '   <td class="td-center">' +
                            '    <button class="btn btn-default" onclick="removePrecio(\'' + $("#tbPrecios tr").length + '\')"><img src="./image/remove.png" /></button>' +
                            '   </td>' +
                            ' </tr>');
                    }
                    event.preventDefault();
                });

                $("#txtUnidadMedida").keyup(function(event) {
                    if (event.keyCode == 32) {
                        $("#idOpciones").modal("show");
                        $("#txtBuscar").val("");
                        $("#txtBuscar").focus();
                        mantenimiento = "0013";
                        loadModalId(mantenimiento, "");
                    }
                    event.preventDefault();
                });

                $("#txtUnidadMedida").dblclick(function(event) {
                    $("#idOpciones").modal("show");
                    $("#txtBuscar").val("");
                    $("#txtBuscar").focus();
                    mantenimiento = "0013";
                    loadModalId(mantenimiento, "");
                });

                $("#txtCategoria").keyup(function(event) {
                    if (event.keyCode == 32) {
                        $("#idOpciones").modal("show");
                        $("#txtBuscar").val("");
                        $("#txtBuscar").focus();
                        mantenimiento = "0006";
                        loadModalId(mantenimiento, "");
                    }
                    event.preventDefault();
                });

                $("#txtCategoria").dblclick(function(event) {
                    $("#idOpciones").modal("show");
                    $("#txtBuscar").val("");
                    $("#txtBuscar").focus();
                    mantenimiento = "0006";
                    loadModalId(mantenimiento, "");
                });

                $("#txtMarca").keyup(function(event) {
                    if (event.keyCode == 32) {
                        $("#idOpciones").modal("show");
                        $("#txtBuscar").val("");
                        $("#txtBuscar").focus();
                        mantenimiento = "0007";
                        loadModalId(mantenimiento, "");
                    }
                    event.preventDefault();
                });

                $("#txtMarca").dblclick(function(event) {
                    $("#idOpciones").modal("show");
                    $("#txtBuscar").val("");
                    $("#txtBuscar").focus();
                    mantenimiento = "0007";
                    loadModalId(mantenimiento, "");
                });

                $("#txtPresentacion").keyup(function(event) {
                    if (event.keyCode == 32) {
                        $("#idOpciones").modal("show");
                        $("#txtBuscar").val("");
                        $("#txtBuscar").focus();
                        mantenimiento = "0008";
                        loadModalId(mantenimiento, "");
                    }
                    event.preventDefault();
                });

                $("#txtPresentacion").dblclick(function(event) {
                    $("#idOpciones").modal("show");
                    $("#txtBuscar").val("");
                    $("#txtBuscar").focus();
                    mantenimiento = "0008";
                    loadModalId(mantenimiento, "");
                });

                /* registrar formularios */

                $("#txtClave").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtDescripcion").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtUnidadMedida").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtCategoria").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtCosto").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtStockMinimo").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtStockMaximo").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPrecioGeneral").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPrecio2").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPrecio3").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPrecioGeneralPersonalizado").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtDescripcionAlterna").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtMarca").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPresentacion").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtClaveUnica").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#btnRegistrar").click(function() {
                    registrarProducto();
                });

                $("#btnRegistrar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                    event.preventDefault();
                });

                $("#btnCancelar").click(function(event) {
                    clearComponents();
                });

                $("#btnCancelar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        clearComponents();
                    }
                    event.preventDefault();
                });
                /* registrar formularios */

                modalDetalle();
                loadImpuesto();
            });

            function modalDetalle() {
                $("#txtBuscar").keydown(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtBuscar").val().trim() != "") {
                            loadModalId(mantenimiento, $("#txtBuscar").val().trim());
                        }
                    }
                });

                $("#tbLista").on("click", "tr", function(event) {
                    $(".selected-table-tr").removeClass("selected-table-tr");
                    $(this).addClass("selected-table-tr");
                });

                $("#btnCloseModal").click(function(event) {
                    $("#idOpciones").modal("hide");
                });

                $("#btnCloseModal").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#idOpciones").modal("hide");
                    }
                });
            }

            function registrarProducto() {
                if ($("#txtClave").val().trim().length == 0) {
                    $("#txtClave").focus();
                } else if ($("#txtDescripcion").val().trim().length == 0) {
                    $("#txtDescripcion").focus();
                } else if ($("#txtUnidadMedida").val().trim().length == 0) {
                    $("#txtUnidadMedida").focus();
                } else if ($("#txtCategoria").val().trim().length == 0) {
                    $("#txtCategoria").focus();
                } else if (!tools.isNumeric($("#txtCosto").val())) {
                    $("#txtCosto").focus();
                } else if ($("#cbImpuesto").val() == '') {
                    $("#cbImpuesto").focus();
                } else if ($("#rbPrecioNormal").is(":checked") && !tools.isNumeric($("#txtPrecioGeneral").val())) {
                    $("#txtPrecioGeneral").focus();
                } else if ($("#rbPrecioPersonalizado").is(":checked") && !tools.isNumeric($("#txtPrecioGeneralPersonalizado").val())) {
                    $("#txtPrecioGeneralPersonalizado").focus();
                } else {

                    let listaPrecios = [];

                    if ($("#rbPrecioNormal").is(":checked")) {
                        listaPrecios.push({
                            "nombre": "Precio de Venta 1",
                            "valor": !tools.isNumeric($("#txtPrecio2").val()) ? 0 : $("#txtPrecio2").val().trim(),
                            "factor": 1
                        });
                        listaPrecios.push({
                            "nombre": "Precio de Venta 2",
                            "valor": !tools.isNumeric($("#txtPrecio3").val()) ? 0 : $("#txtPrecio3").val().trim(),
                            "factor": 1
                        });
                    } else {
                        $("#tbPrecios tr").each(function(row, tr) {
                            listaPrecios.push({
                                "nombre": $(tr).find("td:eq(0)").find("input").val(),
                                "valor": !tools.isNumeric($(tr).find("td:eq(1)").find("input").val()) ? 0 : $(tr).find("td:eq(1)").find("input").val().trim(),
                                "factor": !tools.isNumeric($(tr).find("td:eq(2)").find("input").val()) ? 0 : $(tr).find("td:eq(2)").find("input").val().trim()
                            });
                        });
                    }

                    let files = document.getElementById('fileImage').files;
                    if (files.length == 0) {
                        enviarRegistro(null, listaPrecios);
                    } else {
                        let file = files[0];
                        let blob = file.slice();
                        let reader = new FileReader();

                        reader.onloadend = function(evt) {
                            if (evt.target.readyState == FileReader.DONE) {
                                let base64String = evt.target.result.replace(/^data:.+;base64,/, '');
                                enviarRegistro(base64String, listaPrecios);
                            }
                        };
                        reader.readAsDataURL(blob);
                    }
                }
            }

            function enviarRegistro(image, listaPrecios) {
                tools.ModalDialog("Producto", "¿Está seguro de continuar?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/suministros/RegistrarSuministro.php",
                            type: 'POST',
                            accepts: "application/json",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify({
                                "Clave": $("#txtClave").val().trim(),
                                "ClaveAlterna": $("#txtClaveAlterna").val().trim(),
                                "NombreMarca": $("#txtDescripcion").val().trim(),
                                "NombreGenerico": $("#txtDescripcionAlterna").val().trim(),

                                "Categoria": idCategoria,
                                "Marca": idMarca,
                                "Presentacion": idPresentacion,
                                "UnidadCompra": idUnidadMedida,
                                "UnidadVenta": $("#rbGranel").is(":checked") ? 3 : $("#rbMoneda").is(":checked") ? 2 : 1,

                                "Estado": $("#rbActivo").is(":checked") ? 1 : 2,
                                "StockMinimo": !tools.isNumeric($("#txtStockMinimo").val().trim()) ? 0 : $("#txtStockMinimo").val().trim(),
                                "StockMaximo": !tools.isNumeric($("#txtStockMaximo").val().trim()) ? 0 : $("#txtStockMaximo").val().trim(),
                                "Cantidad": 0,

                                "Impuesto": $("#cbImpuesto").val(),
                                "TipoPrecio": $("#rbPrecioNormal").is(":checked") ? 1 : 0,
                                "PrecioCompra": !tools.isNumeric($("#txtCosto").val()) ? 0 : $("#txtCosto").val().trim(),
                                "PrecioVentaGeneral": $("#rbPrecioNormal").is(":checked") ? !tools.isNumeric($("#txtPrecioGeneral").val().trim()) ? 0 : $("#txtPrecioGeneral").val().trim() : !tools.isNumeric($("#txtPrecioGeneralPersonalizado").val().trim()) ? 0 : $("#txtPrecioGeneralPersonalizado").val().trim(),
                                "Lote": $("#cbLote").is(":checked") ? 1 : 0,
                                "ValorInventario": $("#rbGranelSalida").is(":checked") ? 3 : $("#rbMonedaSalida").is(":checked") ? 2 : 1,
                                "ClaveUnica": $("#txtClaveUnica").val(),
                                "Imagen": image,
                                "ListaPrecios": listaPrecios,
                            }),
                            beforeSend: function() {
                                tools.ModalAlertInfo("Producto", "Se está procesando la información.");
                            },
                            success: function(result) {
                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess("Producto", result.message);
                                    clearComponents();
                                } else if (result.estado == 2) {
                                    tools.ModalAlertWarning("Producto", result.message);
                                } else if (result.estado == 3) {
                                    tools.ModalAlertWarning("Producto", result.message);
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

            function removePrecio(idSuministro) {
                $("#" + idSuministro).remove();
            }

            function loadImpuesto() {
                $.get("../app/controller/suministros/ListarImpuestos.php", {
                    type: "impuestos"
                }, function(data, status) {
                    if (status === "success") {
                        let result = data;
                        if (result.estado === 1) {
                            $("#cbImpuesto").empty();
                            $("#cbImpuesto").append('<option value="">--TODOS--</option>');
                            for (let impuesto of result.data) {
                                $("#cbImpuesto").append('<option value="' + impuesto.IdImpuesto + '">' + impuesto.Nombre + '</option>');
                            }
                        } else {
                            $("#cbImpuesto").empty();
                        }
                    }
                });
            }

            function loadModalId(idMantenimiento, nombre) {
                $("#tbLista").empty();
                $.get("../app/controller/suministros/ListarImpuestos.php", {
                    type: "detalles",
                    mantenimiento: idMantenimiento,
                    nombre: nombre
                }, function(data, status) {
                    if (status === "success") {
                        for (let value of data.data) {
                            $("#tbLista").append('<tr ondblclick="selectModal(\'' + idMantenimiento + '\',\'' + value.IdDetalle + '\',\'' + value.Nombre + '\')">' +
                                '    <td>' + value.Nombre + '</td>' +
                                '</tr>');
                        }
                    }
                });
            }

            function selectModal(idMantenimiento, IdDetalle, Nombre) {
                if (idMantenimiento == "0013") {
                    $("#idOpciones").modal("hide");
                    idUnidadMedida = IdDetalle;
                    $("#txtUnidadMedida").val(Nombre);
                    $("#txtUnidadMedida").focus();
                } else if (idMantenimiento == "0006") {
                    $("#idOpciones").modal("hide");
                    idCategoria = IdDetalle;
                    $("#txtCategoria").val(Nombre);
                    $("#txtCategoria").focus();
                } else if (idMantenimiento == "0007") {
                    $("#idOpciones").modal("hide");
                    idMarca = IdDetalle;
                    $("#txtMarca").val(Nombre);
                    $("#txtMarca").focus();
                } else if (idMantenimiento == "0008") {
                    $("#idOpciones").modal("hide");
                    idPresentacion = IdDetalle;
                    $("#txtPresentacion").val(Nombre);
                    $("#txtPresentacion").focus();
                }
            }

            function clearComponents() {
                mantenimiento = "";
                idUnidadMedida = 0;
                idCategoria = 0;
                idMarca = 0;
                idPresentacion = 0;

                $("#txtClave").val("");
                $("#txtClaveAlterna").val("");
                $("#txtDescripcion").val("");
                $("#txtUnidadMedida").val("");
                $("#txtCategoria").val("");
                $("#rbUnidad").prop("checked", true);
                $("#txtCosto").val("");
                $("#txtStockMinimo").val("");
                $("#txtStockMaximo").val("");
                $("#rbUnidadSalida").prop("checked", true);
                $("#cbImpuesto").val("");
                $("#txtPrecioGeneral").val("");
                $("#txtPrecio2").val("");
                $("#txtPrecio3").val("");

                $("#txtDescripcionAlterna").val("");
                $("#txtEstado").val("");
                $("#txtMarca").val("");
                $("#txtPresentacion").val("");
                $("#txtClaveUnica").val("");
                $("#cbLote").prop("checked", false);
                tbPrecios.empty();
            }
        </script>
    </body>

    </html>
<?php
}
