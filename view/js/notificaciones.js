'use strict'

$(document).ready(function () {
    loadNotificaciones();
});

function loadNotificaciones() {

    $.ajax({
        url: "../app/controller/ventas/ListarVentas.php",
        method: "GET",
        data: {
            "type": "listarNotificaciones",

        },
        beforeSend: function () {
            $("#divNotificaciones").empty();
        },
        success: function (result) {
            if (result.estado == 1) {
                let notificaciones = result.data;
                if (notificaciones.length == 0) {
                    $("#lblNumeroNotificaciones").html(0)
                    $("#divNotificaciones").append('<span class="dropdown-item dropdown-header" >0 Notificaciones</span>')
                } else {
                    $("#lblNumeroNotificaciones").html(notificaciones.length)
                    $("#divNotificaciones").append('<span class="dropdown-item dropdown-header" >' + notificaciones.length + ' Notificaciones</span>')

                    for (let noti of notificaciones) {
                        $("#divNotificaciones").append('<div class="dropdown-divider"></div>');
                        $("#divNotificaciones").append('<a href="mostrarnotificaciones.php" class="dropdown-item">' +
                            ' <i class="fas fa-file mr-2"></i> ' + noti.Cantidad + ' ' + noti.Nombre +
                            ' <span class="float-right text-muted text-sm">' + noti.Estado + '</span>' +
                            '</a>');
                    }
                }
            } else {
                $("#lblNumeroNotificaciones").html(0)
                $("#divNotificaciones").append('<span class="dropdown-item dropdown-header" >0 Notificaciones</span>')
                $("#divNotificaciones").append('<div class="dropdown-divider"></div>');
                $("#divNotificaciones").append('<a href="javascript:void(0)" class="dropdown-item">' +
                    ' <i class="fas fa-info mr-2"></i> ' + result.message +
                    ' <span class="float-right text-muted text-sm">Error </span>' +
                    '</a>');
            }
        },
        error: function (error) {
            console.log(error)
        }
    });

}