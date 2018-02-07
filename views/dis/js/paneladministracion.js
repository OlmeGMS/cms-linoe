/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('tr #btn-eliminar').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");


        if (opcion) {

            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idusuario = fila.find('#id_estudiante').text();

            var data = {idUsuario: idusuario};

            $.post("EliminarUsuarioController.php", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });

        }


    });
    $('tr #btn-eliminarServicioVehiculo').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");

        if (opcion) {
            var fila = $(this).parent().parent();
            var idservicio = fila.find('#id_servicio').text();
            var data = {idServicio: idservicio};

            $.post("deleteserviciovehiculo", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }

    });
    $('tr #btn-eliminarCanalServicio').click(function (e) {
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idcanalservicio = fila.find('#id_canalservicio').text();
            var data = {idCanalServicio: idcanalservicio};

            $.post("deleteCanalServicio", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }

    });
    $('tr #btn-eliminarOrdenServicio').click(function (e) {
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idordenservicio = fila.find('#id_ordenservicio').text();
            var data = {idOrdenServicio: idordenservicio};

            $.post("deletOrdenServicio", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }

    });
    $('tr #btn-eliminarCarroceria').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idcarroceria = fila.find('#id_carroceria').text();
            var data = {idCarroceria: idcarroceria};
            $.post("deletecarroceria", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });

        }
    });
    $('tr #btn-eliminarblindaje').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idblindaje = fila.find('#id_blindaje').text();
            var data = {idBlindaje: idblindaje};
            $.post("deleteblindaje", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });
    $('tr #btn-eliminarmClaseVehiculo').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");

        if (opcion) {
            var fila = $(this).parent().parent();
            var idclaseVehiculo = fila.find('#id_claseVehiculo').text();
            var data = idclaseVehiculo
            var data = {idClaseVehiculo: idclaseVehiculo};
            $.post("deleteclasevehiculo", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });

        }
    });

    $('tr #btn-eliminarEmpresa').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idempresa = fila.find('#id_empresa').text();

            var data = {idEmpresa: idempresa};
            $.post("deleteEmpresa", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarTipoServicio').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idtiposervicio = fila.find('#id_tipoServico').text();

            var data = {idTipoServicio: idtiposervicio};
            $.post("deleteTipoServicio", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarSoat').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idsoat = fila.find('#id_soat').text();

            var data = {idSoat: idsoat};
            $.post("deleteSoat", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarPoliza').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idexcontractual = fila.find('#id_poliza').text();

            var data = {idExcontractual: idexcontractual};
            $.post("deleteExcontractual", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminar-conductor').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idconductor = fila.find('#id_conductor').text();

            var data = {idConductor: idconductor};
            $.post("deleteConductor", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarContrato').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idcontrato = fila.find('#id_contrato').text();

            var data = {idContrato: idcontrato};
            $.post("deleteContrato", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarcb').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");


        if (opcion) {

            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idcombustible = fila.find('#id_combustible').text();

            var data = {idCombustible: idcombustible};
            $.post("deletecombustible", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });

        }
    });

    $('tr #btn-eliminarModelo').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            var idmodelo = fila.find('#id_modelo').text();

            var data = {idModelo: idmodelo};
            $.post("deleteModelo", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }

    });



    $('tr #btn-eliminarLinea').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idlineaVehiculo = fila.find('#id_lineaVehiculo').text();
            var data = {idLineaVehiculo: idlineaVehiculo};
            $.post("deleteLineaVehiculo", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarEmpresaPrestadora').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idempresaPrestadora = fila.find('#id_empresaPrestadora').text();
            var data = {idEmpresaPrestadora: idempresaPrestadora};
            $.post("deleteEmpresaPrestadoraServicioSeguros", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

    $('tr #btn-eliminarVehiculo').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idvehiculo = fila.find('#id_vehiculo').text();
            var data = {idVehiculo: idvehiculo};
            $.post("deleteVehiculo", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });

        $('tr #btn-eliminarRuta').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Eliminar");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idruta = fila.find('#id_ruta').text();
            var data = {idRuta: idruta};
            $.post("deleteRuta", data, function (res, est, jqXHR) {
                alert(res);
                fila.remove();

            });
        }
    });


    $('#btn-modificarMarca').click(function (e) {
        e.preventDefault();
        var data = $('#formModificar').serialize();
        $.post("updateMarca", data, function (res, est, jqXHR) {
            alert(res);
        });
    });
    $('#btn-modificarSV').click(function (e) {
        e.preventDefault();
        var data = $('#formularioSV').serialize();
        $.post("updateserviciovehiculo", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarCarroceria').click(function (e) {
        e.preventDefault();
        var data = $('#formularioCarroceria').serialize();
        $.post("updatecarroceria", data, function (res, est, jqXHR) {
            alert(res);
        });
    });


    $('#btn-modificarBlindaje').click(function (e) {
        e.preventDefault();
        var data = $('#formularioBlindaje').serialize();
        $.post("updateblindaje", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarClaseVehiculo').click(function (e) {
        e.preventDefault();
        var data = $('#formularioClaseVehiculo').serialize();
        $.post("updateclasevehiculo", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarCombustible').click(function (e) {
        e.preventDefault();
        var data = $('#formularioCombustible').serialize();
        $.post("updatecombustible", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarModelo').click(function (e) {
        e.preventDefault();
        var data = $('#formModificarModelo').serialize();
        $.post("updateModelo", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarLinea').click(function (e) {
        e.preventDefault();
        var data = $('#form-ModificarLinea').serialize();
        $.post("updateLineaVehiculo", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-modificarPoliza').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificarPoliza').serialize();
        $.post("updateExcontractual", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('#btn-tel').click(function (e) {
        e.preventDefault();
        var data = $('#formtel').serialize();
        $.post("agregarTelefono", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificaEmpresa').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificarEmpresa').serialize();
        $.post("updateEmpresa", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificaSoat').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificarSoat').serialize();
        $.post("updateSoat", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificarCanalServico').click(function (e) {
        e.preventDefault();
        var data = $('#form-canalservicio').serialize();
        $.post("updateCanalServicio", data, function (res, est, jqXHR) {
            alert(res);
        });

    });


    $('#btn-modificaContrato').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificarContrato').serialize();
        $.post("updateContrato", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-editar-conductor').click(function (e) {
        e.preventDefault();
        var data = $('#form-editar-conductor').serialize();
        $.post("updateConductor", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificaTipoServicio').click(function (e) {
        e.preventDefault();
        var data = $('#form-tipoServicio').serialize();
        $.post("updateTipoServicio", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificar-ordenServicio').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificar-OrdenServicio').serialize();
        $.post("updateOrdenServicio", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificarEmpresaprestadora').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificarEmpresaprestadora').serialize();
        $.post("upDateEmpresaPrestadoraServicioSeguros", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificar-ruta').click(function (e) {
        e.preventDefault();
        var data = $('#form-modificar-ruta').serialize();
        $.post("updateRuta", data, function (res, est, jqXHR) {
            alert(res);
        });

    });

    $('#btn-modificarVehiculo').click(function (e) {
        e.preventDefault();
        var data = $('#form-mudificarVehiculo1').serialize();
        $.post("updateVehiculo1", data, function (res, est, jqXHR) {
            alert(res);
        });
    });

    $('tr #btn-fuec').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Generar Fuec");
        if (opcion) {
            var fila = $(this).parent().parent();
            var idfuec = fila.find('#id_fuec').text();
            var data = {idFuec: idfuec};
            $.post("planillaFuec", data, function (res, est, jqXHR) {
                alert("Se Genero");


            });

        }
    });

    $('tr #btn-generarPdf').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Generar el pdf ?");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            //var idtiposervicio = fila.find('#id_contrato').text();

            //var data = {idTipoServicio: idtiposervicio};
            $.post("reportTipoServicio", function (res, est, jqXHR) {
                alert("Se Genero el pdf");


            });
        }
    });
        $('tr #btn-generarPdf').click(function (e) {
        e.preventDefault();
        var opcion = confirm("Desea Generar el pdf ?");
        if (opcion) {
            var fila = $(this).parent().parent();// se llama lafila seleccionada
            //var idtiposervicio = fila.find('#id_contrato').text();

            //var data = {idTipoServicio: idtiposervicio};
            $.post("ReporterConductor", function (res, est, jqXHR) {
                alert("Se Genero el pdf");


            });
        }
    });

});
