<?php
session_start();
$title_page = "Empresa";

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
                                <h1> Configurar mi Empresa <small>Datos Básicos</small>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>
                                            <i></i>
                                            R.U.C:
                                        </label>
                                        <div class="form-group">
                                            <input id="txtNumDocumento" class="form-control" type="text" placeholder="R.U.C.">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="lbl-titulo ">
                                            <i></i>
                                            Razón Social
                                        </label>
                                        <div class="form-group">
                                            <input id="txtRazonSocial" class="form-control" type="text" placeholder="Razón Social" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>
                                            <i></i>
                                            Nombre Comercial
                                        </label>
                                        <div class="form-group">
                                            <input id="txtNomComercial" class="form-control" type="text" placeholder="Nombre Comercial">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center margin">
                                        <img src="./image/noimage.jpg" style="object-fit: cover;" width="160" height="160" id="lblImagen">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center margin">
                                        <input type="file" id="fileImage" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                        <label class="btn btn-warning" for="fileImage" id="txtFile"><i class="fa fa-photo"></i>Subir Imagen</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Dirección Fiscal:
                                </label>
                                <div class="form-group">
                                    <input id="txtDireccion" class="form-control" type="text" placeholder="Ingrese su dirección fiscal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Teléfono
                                </label>
                                <div class="form-group">
                                    <input id="txtTelefono" class="form-control" type="text" placeholder="Teléfono">

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Celular
                                </label>
                                <div class="form-group">
                                    <input id="txtCelular" class="form-control" type="text" placeholder="Celular">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Página Web
                                </label>
                                <div class="form-group">
                                    <input id="txtPaginWeb" class="form-control" type="text" placeholder="Página Web">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Email
                                </label>
                                <div class="form-group">
                                    <input id="txtEmail" class="form-control" type="text" placeholder="Email" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="subtitulo-texto">
                                    Usuario y Password SOL - SUNAT
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="lbl-titulo ">
                                    <i></i>
                                    Usuario Sol
                                </label>
                                <div class="form-group">
                                    <input id="txtUsuarioSol" class="form-control" type="text" placeholder="Usuario Sol" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="lbl-titulo ">
                                    <i></i>
                                    Contraseña Sol
                                </label>
                                <div class="form-group">
                                    <input id="txtClaveSol" class="form-control" type="password" placeholder="Password SOL" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                Certificado Electrónico y Password
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>
                                    <i></i>
                                    Seleccionar Archivo
                                </label>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileCertificado">
                                            <label class="custom-file-label" for="fileCertificado" id="lblNameCertificado">Seleccionar archivo</label>
                                        </div>
                                        <div class="input-group-append">
                                            <label class="input-group-text"  for="fileCertificado">Subir</label>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="lbl-titulo ">
                                    <i></i>
                                    Contraseña de tu Certificado
                                </label>
                                <div class="form-group">
                                    <input id="txtClaveCertificado" class="form-control" type="password" placeholder="Contraseña de tu Certificado" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button id="btnGuardar" class="btn btn-primary" type="button">
                                    <i class="fa fa-save"></i> Guardar Información
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </body>
    <script src="./js/notificaciones.js"></script>
    <script>
        let tools = new Tools();
        let idEmpresa = 0;
        let txtNumDocumento = $("#txtNumDocumento");
        let txtRazonSocial = $("#txtRazonSocial");
        let txtNomComercial = $("#txtNomComercial");
        let lblImagen = $("#lblImagen");
        let fileImage = $("#fileImage");
        let txtDireccion = $("#txtDireccion");
        let txtTelefono = $("#txtTelefono");
        let txtCelular = $("#txtCelular");
        let txtPaginWeb = $("#txtPaginWeb");
        let txtEmail = $("#txtEmail");
        let txtUsuarioSol = $("#txtUsuarioSol");
        let txtClaveSol = $("#txtClaveSol");
        let lblNameCertificado = $("#lblNameCertificado");
        let fileCertificado = $("#fileCertificado");
        let txtClaveCertificado = $("#txtClaveCertificado");
        $(document).ready(function() {
            $("#btnCerrarSession").click(function() {
                window.location.href = "closesession.php";
            });

            $("#fileImage").on('change', function(event) {
                lblImagen.attr("src", URL.createObjectURL(event.target.files[0]));
            });

            $("#fileCertificado").on('change', function(event) {
                lblNameCertificado.val(event.target.files[0].name);
            });

            $("#btnGuardar").keypress(function(event) {
                if (event.keyCode == 13) {
                    crudEmpresa();
                }
                event.preventDefault();
            });

            $("#btnGuardar").click(function() {
                crudEmpresa();
            });
            modalEvents();
            LoadDataEmpresa();
        });

        function modalEvents() {
            $('#modalAlert').on('shown.bs.modal', function(e) {
                $("#btnButtonAcceptModal").focus();
            })

            $("#btnIconCloseModal").click(function(event) {
                $("#modalAlert").modal('hide');
            });

            $("#btnIconCloseModal").keypress(function(event) {
                if (event.keyCode === 13) {
                    $("#modalAlert").modal('hide');
                }
                event.preventDefault();
            });

            $("#btnButtonAcceptModal").click(function(event) {
                $("#modalAlert").modal('hide');
            });

            $("#btnButtonAcceptModal").keypress(function(event) {
                if (event.keyCode === 13) {
                    $("#modalAlert").modal('hide');
                }
                event.preventDefault();
            });
        }

        function LoadDataEmpresa() {
            $.ajax({
                url: "../app/controller/empresa/ListarEmpresa.php",
                method: "GET",
                data: {},
                beforeSend: function() {
                    tools.AlertInfo("Mi Empresa", "Cargando información.", "toast-bottom-right");
                },
                success: function(result) {
                    let data = result;
                    console.log(data)
                    if (data.estado == 1) {
                        idEmpresa = data.result.IdEmpresa;
                        txtNumDocumento.val(data.result.NumeroDocumento);
                        txtRazonSocial.val(data.result.RazonSocial);
                        txtNomComercial.val(data.result.NombreComercial);
                        if (data.result.Image == "") {
                            lblImagen.attr("src", "./image/noimage.jpg");
                        } else {
                            lblImagen.attr("src", "data:image/png;base64," + data.result.Image);
                        }
                        txtDireccion.val(data.result.Domicilio);
                        txtTelefono.val(data.result.Telefono);
                        txtCelular.val(data.result.Celular);
                        txtPaginWeb.val(data.result.PaginaWeb);
                        txtEmail.val(data.result.Email);
                        txtUsuarioSol.val(data.result.UsuarioSol);
                        txtClaveSol.val(data.result.ClaveSol);
                        lblNameCertificado.val(data.result.CertificadoRuta);
                        txtClaveCertificado.val(data.result.CertificadoClave);
                        tools.AlertSuccess("Mi Empresa", "Cargo correctamente los datos.", "toast-bottom-right");
                    } else {
                        tools.AlertWarning("Mi Empresa", data.message, "toast-bottom-right");
                    }

                },
                error: function(error) {
                    console.log(error)
                    tools.AlertError("Mi Empresa",
                        "Error en :" + error.responseText, "toast-bottom-right");
                }
            });
        }

        function crudEmpresa() {

            var formData = new FormData();
            formData.append("idEmpresa", idEmpresa);
            formData.append("txtNumDocumento", txtNumDocumento.val());
            formData.append("txtRazonSocial", txtRazonSocial.val());
            formData.append("txtNomComercial", txtNomComercial.val());
            formData.append("txtDireccion", txtDireccion.val());
            formData.append("txtTelefono", txtTelefono.val());
            formData.append("txtCelular", txtCelular.val());
            formData.append("txtPaginWeb", txtPaginWeb.val());
            formData.append("txtEmail", txtEmail.val());

            formData.append("imageType", fileImage[0].files.length);
            formData.append("image", fileImage[0].files[0]);

            formData.append("txtUsuarioSol", txtUsuarioSol.val());
            formData.append("txtClaveSol", txtClaveSol.val());
            formData.append("certificadoUrl", lblNameCertificado.val());
            formData.append("certificadoType", fileCertificado[0].files.length);
            formData.append("certificado", fileCertificado[0].files[0]);
            formData.append("txtClaveCertificado", txtClaveCertificado.val());

            // console.log(fileCertificado[0].files.length)
            // console.log(fileCertificado[0].files[0])
            // console.log(txtClaveCertificado.val())

            tools.ModalDialog("Mi Empresa", "¿Está seguro de continuar?", function(value) {
                if (value == true) {
                    $.ajax({
                        url: "../app/controller/empresa/CrudEmpresa.php",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            tools.ModalAlertInfo("Mi Empresa", "Procesando petición..");
                        },
                        success: function(result) {
                            if (result.state == 1) {
                                tools.ModalAlertSuccess("Mi Empresa", result.message);
                            } else {
                                tools.ModalAlertWarning("Mi Empresa", result.message);
                            }
                        },
                        error: function(error) {
                            tools.ModalAlertError("Mi Empresa", "Se produjo un error: " + error.responseText);
                        }
                    });
                }
            });

        }
    </script>

    </html>
<?php
}
?>