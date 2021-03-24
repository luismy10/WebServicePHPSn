<?php
error_reporting(0);
session_start();
$title_page = "Login | SysSoft Integra";
if (isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "./index.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include 'layout/head.php'; ?>
    </head>

    <body class="hold-transition login-page" style='background-image: url("image/fondo3.jpg"); background-repeat: no-repeat;min-height: 100vh;background-position: center center;background-size: cover;'>
        <div class="login-box">

            <div class="card">

                <div class="login-logo">
                    <div class="p-3">
                        <img class="logo" src="./image/logo.png" width="100">
                    </div>
                    <div>
                        <h3 class="login-box-msg text-primary"> <b>SysSoft Integra</b> V.1</h3>
                    </div>
                </div>
                <div class="card-body login-card-body">

                    <p class="login-box-msg">Ingresos sus credenciales para iniciar</p>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Usuario" id="txtUsuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" id="txtClave">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block" id="btnEntrar">Ingresar</button>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <span class="text-danger" id="lblMessageError"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $("#txtUsuario").on("keydown", function(event) {
                    if (event.keyCode === 13) {
                        validarIngreso($("#txtUsuario").val().trim(), $("#txtClave").val().trim());
                    }
                });

                $("#txtClave").on("keydown", function(event) {
                    if (event.keyCode === 13) {
                        validarIngreso($("#txtUsuario").val(), $("#txtClave").val());
                    }
                });

                $("#btnEntrar").click(function() {
                    validarIngreso($("#txtUsuario").val(), $("#txtClave").val());
                });

                $("#btnEntrar").click(function(event) {
                    if (event.keyCode === 13) {
                        validarIngreso($("#txtUsuario").val(), $("#txtClave").val());
                    }
                    event.preventDefault();
                });
            });


            function validarIngreso(usuario, clave) {
                if (usuario.trim().length === 0) {
                    $("#lblMessageError").html("Ingrese su usuario.");
                    $("#txtUsuario").focus();
                } else if (clave.trim().length === 0) {
                    $("#lblMessageError").html("Ingrese su contraseña.");
                    $("#txtClave").focus();
                } else {
                    $.ajax({
                        url: "../app/controller/login/Login.php",
                        method: "GET",
                        data: {
                            "usuario": usuario.trim(),
                            "clave": clave.trim()
                        },
                        beforeSend: function() {
                            $("#lblMessageError").html("Validando ingreso...");
                            $("#btnEntrar").removeClass("button-primary");
                            $("#btnEntrar").addClass("button-primary-disable");
                        },
                        success: function(result) {
                            let object = result;
                            if (object.estado == 1) {
                                $("#btnEntrar").removeClass("button-primary-disable");
                                $("#btnEntrar").addClass("button-primary");
                                window.location.href = "./index.php";
                            } else if (object.estado == 2) {
                                $("#btnEntrar").removeClass("button-primary-disable");
                                $("#btnEntrar").addClass("button-primary");
                                $("#lblMessageError").html(object.message);
                                $("#txtUsuario").focus();
                            } else {
                                $("#btnEntrar").removeClass("button-primary-disable");
                                $("#btnEntrar").addClass("button-primary");
                                $("#lblMessageError").html(object.message);
                                $("#txtUsuario").focus();
                            }
                        },
                        error: function(error) {
                            $("#btnEntrar").removeClass("button-primary-disable");
                            $("#btnEntrar").addClass("button-primary");
                            $("#lblMessageError").html(error);
                        }
                    });
                }
            }
        </script>
    </body>

    </html>
<?php
}
