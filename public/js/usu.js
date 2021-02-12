$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});
$(document).ready(function () {
    (function (a) {
        a.fn.vali = function (b) {
            a(this).on({keypress: function (a) {
                    var c = a.which, d = a.keyCode, e = String.fromCharCode(c).toLowerCase(), f = b;
                    (-1 != f.indexOf(e) || 9 == d || 37 != c && 37 == d || 39 == d && 39 != c || 8 == d || 46 == d && 46 != c) && 161 != c || a.preventDefault()
                }})
        }
    })(jQuery);
    $('#username').vali('abcdefghijklmnopqrstuvwxyz0123456789-_.@');
    //fin funcion para bloquear campos solo letras o solo numeros
    $("#username").on('keyup', function (e) {
        var val = $(this).val();
        regx = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{1,9})$/;
        if (regx.test(val)) {
            $('#erroremail').text('');
        } else {
            $('#erroremail').text('Debe escribir un correo valido. Ejemplo: email@email.com');
        }
    });
    $('.fec').datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        firstDay: 1,
        changeYear: true,
        changeMonth: true,
        yearRange: "1920:2009",
        maxDate: new Date('2010-01-01')
    });

    $('input[type=password]').keyup(function () {
        var pswd = $(this).val();
        if (pswd.length < 8) {
            $('#errorpass').text('Debe ser mayor a 8 digitos.');
            $('#errorpassr').text('Debe ser mayor a 8 digitos.');
        } else {
            $('#errorpass').text('');
            $('#errorpassr').text('');
        }

//validate letter
        if (!pswd.match(/[a-z]/)) {
            $('#errorpass').text('Debe contener letras.');
            $('#errorpassr').text('Debe contener letras.');
        }

//validate capital letter
        if (!pswd.match(/[A-Z]/)) {
            $('#errorpass').text('Debe contener una letra mayúscula');
            $('#errorpassr').text('Debe contener una letra mayúscula');
        }

//validate number
        if (!pswd.match(/\d/)) {
            $('#errorpass').text('Debe contener numeros');
            $('#errorpassr').text('Debe contener numeros');
        }
    });

    $('.buscar-submit').click(function () {

        var identificador = $("#identificador").val();
        var username = $("#username").val();
        var fecnacrec = $("#fecnacrec").val();

        if (identificador !== '' && username !== '' && fecnacrec !== '') {

            $.ajax({
                data: {identificador: identificador, username: username, fecnacrec: fecnacrec},
                url: 'bcamcla',
                type: 'post',
                dataType: 'json',
                success: function (r) {
                    if (r.id >= 1) {
                        swal("Datos Encontrados", "Presione en boton continuar.", "success");
                        $("#id_usu").val(r.id);
                        $(".cambiodos-submit").show();
                        $("#identificador").attr("readonly", "readonly");
                        $("#identificador").attr("style", "pointer-events: none;");
                        $("#username").attr("readonly", "readonly");
                        $("#username").attr("style", "pointer-events: none;");
                        $("#fecnacrec").attr("readonly", "readonly");
                        $("#fecnacrec").attr("style", "pointer-events: none;");
                        $(".buscar-submit").hide();
                    } else if (r === false) {
                        swal("Los datos suministrados no son correctos, intente de nuevo.", "", "warning");
                    }
                }
            });
        } else {
            swal("Debe escribir la identificación, el correo regisrtrado y debe selecciona la fecha de nacimiento.", "", "warning");
        }
    });

    $('.resent-submit').click(function () {

        var comparacion = $('input:radio[name=comparacion]:checked').val();
        var id_usu = $('#id_usu').val();

        if (comparacion >= 1) {
            $.ajax({
                data: {comparacion: comparacion, id_usu: id_usu},
                url: 'selecccionado',
                type: 'post',
                dataType: 'json',
                success: function (r) {
                    if (r === 1) {
                        $("#datos").show();
                        $("#sle").hide();
                        $("#contra").show();
                        $("#combo").hide();
                        $("#guarda").show();
                        $(".resent-submit").hide();

                    } else if (r === false) {
                        swal("Los datos suministrados no son correctos.", "", "warning")
                                .then(function () {
                                    location.href = "/";
                                });
                    }
                }
            });

        } else {
            swal("Debe seleccionar una opción.", "", "warning");
        }
    });

    $('#guarda').click(function (e) {

        var clave = $('#clave').val();

        if (clave != '') {

            e.preventDefault();
            $.ajax({
                url: "resetear",
                type: "post",
                data: $('#clavesss').serialize(),
                success: function (data) {
                    if (data == 1) {
                        swal("<font size='6.5px;'>Cambio de clave exitoso!</font>", '', "success")
                                .then(function () {
                                    location.href = "/";
                                });
                    } else if (data == 2) {
                        swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema.", "error");
                    } else if (data == 3) {
                        swal("No ingreso la nueva clave.", "", "warning");
                    }

                },
                error: function (data) {
                    swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema.", "error");
                }
            });
        } else {
            swal("Debe escibir una contraseña nueva.", "", "warning");
        }

    });

    $('#eData').click(function (e) {
        $(".fomul").prop('disabled', false);
        $("#esp").hide();
        $("#act").show();
    });

    $('#cancelar').click(function (e) {
        $(".fomul").prop('disabled', true);
        $("#act").hide();
        $("#esp").show();
    });

    $('#estado').on("change", function () {
        var id = $(this).val();
        var municipio = $("#municipio");
        $("#municipio").empty();
        $("#parroquia").empty();
        municipio.append('<option value="0" selected>Seleccione...</option>');
        $("#parroquia").append('<option value="0" selected>Seleccione...</option>');
        if (id >= 1) {
            $.ajax({
                data: {id: id},
                url: "municipio",
                type: 'POST',
                dataType: 'json',
                success: function (r) {
                    if (r != false) {
                        $.each(r, function (i, l) {
                            municipio.append('<option value="' + l.id + '">' + l.nombre + '</option>');
                        });
                    }
                }
            });
        } else {
            swal("Debe seleccionar un Estado", "", "warning");
        }
    });

    $('#municipio').on("change", function () {
        var id = $(this).val();
        var parroquia = $("#parroquia");
        $("#parroquia").empty();
        parroquia.append('<option value="0" selected>Seleccione...</option>');
        if (id >= 1) {
            $.ajax({
                data: {id: id},
                url: "parroquia",
                type: 'POST',
                dataType: 'json',
                success: function (r) {
                    if (r != false) {
                        $.each(r, function (i, l) {
                            parroquia.append('<option value="' + l.id + '">' + l.nombre + '</option>');
                        });
                    }
                }
            });
        } else {
            swal("Debe seleccionar un Municipio", "", "warning");
        }
    });

    $('#actualizarData').click(function (e) {

        var id_identificador = $("#id_identificador").val();
        var estadocivil = $("#estadocivil").val();
        var cod = $("#cod").val();
        var telf = $("#telf").val();
        var cel = $("#cel").val();
        var parroquia = $("#parroquia").val();
        var direc = $("#direc").val();
        var error = 0;

        if (id_identificador == 1 || id_identificador == 2 || id_identificador == 6) {

            if (estadocivil == 0) {
                $("#estadocivil").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
                error = 1;
            } else {
                $("#estadocivil").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

            }
        }

        if (cod == '') {
            $("#cod").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
            error = 1;
        } else {
            $("#cod").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

        }
        if (telf == '') {
            $("#telf").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
            error = 1;
        } else {
            $("#telf").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

        }
        if (cel == '') {
            $("#cel").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
            error = 1;
        } else {
            $("#cel").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

        }
        if (parroquia == 0) {
            $("#parroquia").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
            error = 1;
        } else {
            $("#parroquia").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

        }
        if (direc == '') {
            $("#direc").attr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');
            error = 1;
        } else {
            $("#direc").removeAttr('style', 'background-color: #FDF5E7; border: 2px solid #f39c12;');

        }

        if (error == 0) {
            e.preventDefault();
            $.ajax({
                url: "/admin/actualizarData",
                type: "post",
                data: $('#editar').serialize(),
                success: function (data) {
                    if (data == 1) {
                        swal("Actualización exitosa de los datos!", "", "success")
                                .then(function () {
                                    location.href = "/admin/edit_perfil";
                                });
                    } else if (data == 2) {
                        swal("Ha ocurrido un problema al guardar los datos.", "", "error");
                    }
                },
                error: function (data) {
                    swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema.", "error");
                }
            });
        } else {
            swal("Faltan datos por completar.", "", "warning");
        }
    });

});
