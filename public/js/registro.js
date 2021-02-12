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
    $('#pnombre').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#snombre').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#papellido').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#sapellido').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#pnombrer').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#snombrer').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#papellidor').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#sapellidor').vali('abcdefghijklmnñopqrstuvwxyz ');
    $('#correo').vali('abcdefghijklmnopqrstuvwxyz0123456789-_.@');
    $('#correoe').vali('abcdefghijklmnopqrstuvwxyz0123456789-_.@');
    //fin funcion para bloquear campos solo letras o solo numeros
    $("#correo").on('keyup', function (e) {
        var val = $(this).val();
        regx = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{1,9})$/;
        if (regx.test(val)) {
            $('#erroremail').text('');
        } else {
            $('#erroremail').text('Debe escribir un correo valido. Ejemplo: email@email.com');
        }
    });
    $("#correoe").on('keyup', function (e) {
        var val = $(this).val();
        regx = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{1,9})$/;
        if (regx.test(val)) {
            $('#erroremaile').text('');
        } else {
            $('#erroremaile').text('Debe escribir un correo valido. Ejemplo: email@email.com');
        }
    });

    $("#cedula").on('keyup change', function (e) {
        $("#nuevo").hide();
        $("#completar").hide();
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

    $('#fecnacr').datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        firstDay: 1,
        changeYear: true,
        changeMonth: true,
        yearRange: "1920:2001",
        maxDate: new Date('2002-01-01')
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

    $('#bcedula').click(function () {

        var cedula = $("#identificador").val();
        var nac = $("#nac").val();
        var nacio = $('select[name="nac"] option:selected').text();
        if (nac !== '' && cedula !== '') {
            $('#cargando').show();
            $('#captcha').show();
            $("#nuevo").hide();
            $("#completar").hide();
            $("#alert").hide();
            $("#alert2").hide();
            $.ajax({
                data: {nac: nac, cedula: cedula, nacio: nacio},
                url: '/bcacedula',
                type: 'post',
                dataType: 'json',
                success: function (r) {

                    $("#cargando").hide();
                    if (r == 1) {

                        $("#nuevo").hide();
                        $("#alert").show();
                        $("#alert2").hide();
                        $("#alert").text("Usted ya se encuentra registrado en el sistema");
                        $("#tipo").val(0);

                    } else if (r == 4) {

                        $("#nuevo").hide();
                        $("#alert").show();
                        $("#alert2").hide();
                        $("#alert").text("El número de cédula indicado no es numérico.");
                        $("#tipo").val(0);

                    } else if (r == 5) {

                        $("#nuevo").hide();
                        $("#alert").show();
                        $("#alert2").hide();
                        $("#alert").text("Usted no cuenta con la edad requerida.");
                        $("#tipo").val(0);

                    } else if (r == false) {

                        $("#alert").hide();
                        $("#alert2").hide();
                        $("#nuevo").show();

                        $("#nuevojur").hide();
                        $("#for_user_registration_natu")[0].reset();
                        /*Es una persona natural Venezolano, Extranjero registrado o con Pasaporte que no se encuentra en el saime*/
                        if (nac == 1 || nac == 2 || nac == 6) {

                            if (nac == 6) {
                                $("#nacio").val('E').prop('readonly', true);
                            } else {
                                $("#nacio").val(nacio).prop('readonly', true);
                            }
                            $("#cedula").val(cedula).prop('readonly', true);
                            $("#pnombre").prop('readonly', false);
                            $("#snombre").prop('readonly', false);
                            $("#papellido").prop('readonly', false);
                            $("#sapellido").prop('readonly', false);
                            $("#fecnac").attr("readonly", false);
                            $("#fecnac").attr("style", "pointer-events:;");

                            $("#genero").attr("readonly", false);
                            $("#genero").attr("style", "pointer-events:;");
                            $("#genero option[value='0'").attr("selected", 'selected');
                            $("#genero option[value='1'").attr("selected", false);
                            $("#genero option[value='2'").attr("selected", false);

                            $("#tipo").val(1);
                            $("#fecnac1").val(nac);

                        } else {
                            /*Es una persona Jurídica, de Gobierno, Comuna*/

                            $("#alert").hide();
                            $("#alert2").hide();
                            $("#nuevo").hide();
                            $("#nuevojur").show();

                            $("#rif").val(cedula).prop('readonly', true);
                            $("#tipo").val(3);
                            $("#fecnac1").val(nac);
                        }

                    } else {

                        if (nac == 1 || nac == 2 || nac == 6) {

                            $("#alert").hide();
                            $("#alert2").hide();
                            $("#nuevo").show();
                            $("#nuevojur").hide();
                            $("#for_user_registration_natu")[0].reset();

                            $("#nacio").val(r[7]).prop('readonly', true);
                            $("#cedula").val(r[0]).prop('readonly', true);
                            $("#pnombre").val(r[1]).prop('readonly', true);
                            $("#snombre").val(r[2]).prop('readonly', true);
                            $("#papellido").val(r[3]).prop('readonly', true);
                            $("#sapellido").val(r[4]).prop('readonly', true);
                            if (r[5] != "F") {
                                $("#genero").attr("readonly", "readonly");
                                $("#genero").attr("style", "pointer-events: none;");
                                $("#genero option[value='2'").attr("selected", 'selected');
                                $("#genero option[value='0'").attr("selected", false);
                                $("#genero option[value='1'").attr("selected", false);
                            } else {
                                $("#genero").attr("readonly", "readonly");
                                $("#genero").attr("style", "pointer-events: none;");
                                $("#genero option[value='1'").attr("selected", 'selected');
                                $("#genero option[value='0'").attr("selected", false);
                                $("#genero option[value='2'").attr("selected", false);
                            }
                            $("#fecnac").val(r[6]).attr("readonly", "readonly");
                            $("#fecnac").val(r[6]).attr("style", "pointer-events: none;");
                            $("#fecnac1").val(nac);
                            $("#tipo").val(2);
                        } else {
                            /*Es una persona Jurídica, de Gobierno, Comuna con datos en el seniat*/

                            $("#alert").hide();
                            $("#alert2").hide();
                            $("#nuevo").hide();
                            $("#nuevojur").show();
                            $("#for_user_registration_jur")[0].reset();
                            $("#fecnac1").val(nac);

                            $("#rif").val(r[0]).prop('readonly', true);
                            $("#emp").val(r[1]).prop('readonly', true);
                            $("#direce").val(r[2]).prop('readonly', true);
                            $("#telfe").val(r[3]).prop('readonly', true);
                            $("#cele").val(r[4]).prop('readonly', true);
                            $("#correoe").val(r[5]).prop('readonly', true);
                            $("#usuarioperr").val(r[5]).prop('readonly', true);
                            $("#tipo").val(3);

                        }
                    }
                }
            });
        } else {
            $("#alert").text("Debe seleccionar un tipo de identificación y escribir el número");

        }
    });

    $('#bcedulae').click(function () {

        var cedula = $("#identificadorr").val();
        var nac = $("#nacr").val();
        var nacio = $('select[name="nacr"] option:selected').text();
        if (nac !== '' && cedula !== '') {
            $("#nuevo").hide();
            $("#alert").hide();
            $("#alert2").hide();
            $('#captcha').show();
            $.ajax({
                data: {nac: nac, cedula: cedula, nacio: nacio},
                url: '/bcacedula',
                type: 'post',
                dataType: 'json',
                success: function (r) {

                    if (r === 1) {

                        $("#nuevo").hide();
                        $("#alert2").show();
                        $("#alert").hide();
                        $("#alert2").text("Usted ya se encuentra registrado en el sistema");
                        $("#tipo").val(0);

                    } else if (r === 4) {

                        $("#nuevo").hide();
                        $("#alert2").show();
                        $("#alert").hide();
                        $("#alert2").text("El número de cédula indicado no es numérico.");
                        $("#tipo").val(0);

                    } else if (r === 5) {

                        $("#nuevo").hide();
                        $("#alert2").show();
                        $("#alert").hide();
                        $("#alert2").text("Usted no cuenta con la edad requerida.");
                        $("#tipo").val(0);

                    } else if (r == false) {

                        $("#alert2").hide();
                        $("#alert").hide();
                        $("#nuevo").hide();

                        $("#darep").show();
                        /*Es una persona natural Venezolano, Extranjero registrado o con Pasaporte que no se encuentra en el saime*/
                        if (nac == 1 || nac == 2 || nac == 6) {
                            if (nac == 6) {
                                $("#nacior").val('E').prop('readonly', true);
                            } else {
                                $("#nacior").val(nacio).prop('readonly', true);
                            }
                            $("#cedular").val(cedula).prop('readonly', true);

                            $("#pnombrer").val('');
                            $("#snombrer").val('');
                            $("#papellidor").val('');
                            $("#sapellidor").val('');
                            $("#fecnacr").val('');

                            $("#pnombrer").prop('readonly', false);
                            $("#snombrer").prop('readonly', false);
                            $("#papellidor").prop('readonly', false);
                            $("#sapellidor").prop('readonly', false);

                            $("#fecnacr").attr("readonly", false);
                            $("#fecnacr").attr("style", "pointer-events:;");

                            $("#generor").attr("readonly", false);
                            $("#generor").attr("style", "pointer-events:;");
                            $("#generor option[value='0'").attr("selected", 'selected');
                            $("#generor option[value='1'").attr("selected", false);
                            $("#generor option[value='2'").attr("selected", false);
                            $("#fecnac1r").val(nac);

                        }

                    } else {

                        $("#alert").hide();
                        $("#alert2").hide();
                        $("#darep").show();
                        $("#nuevo").hide();

                        $("#nacior").val(r[7]).prop('readonly', true);
                        $("#cedular").val(r[0]).prop('readonly', true);
                        $("#pnombrer").val(r[1]).prop('readonly', true);
                        $("#snombrer").val(r[2]).prop('readonly', true);
                        $("#papellidor").val(r[3]).prop('readonly', true);
                        $("#sapellidor").val(r[4]).prop('readonly', true);
                        if (r[5] != "F") {
                            $("#generor").attr("readonly", "readonly");
                            $("#generor").attr("style", "pointer-events: none;");
                            $("#generor option[value='2'").attr("selected", 'selected');
                            $("#generor option[value='0'").attr("selected", false);
                            $("#generor option[value='1'").attr("selected", false);
                        } else {
                            $("#generor").attr("readonly", "readonly");
                            $("#generor").attr("style", "pointer-events: none;");
                            $("#generor option[value='1'").attr("selected", 'selected');
                            $("#generor option[value='0'").attr("selected", false);
                            $("#generor option[value='2'").attr("selected", false);
                        }
                        $("#fecnacr").val(r[6]).attr("readonly", "readonly");
                        $("#fecnacr").val(r[6]).attr("style", "pointer-events: none;");
                        $("#fecnac1r").val(nac);
                    }
                }
            });
        } else {
            $("#alert2").text("Debe seleccionar una nacionalidad y escribir el número de cédula");
        }
    });


    $('#estado').on("change", function () {
        var id = $(this).val();
        var municipio = $("#municipio");
        $("#municipio").empty();
        $("#parroquia").empty();
        $("#parroquia").append('<option value="0" selected>Seleccione...</option>');
        municipio.append('<option value="0" selected>Seleccione...</option>');
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
            $("#alert").text("Debe seleccionar un Estado");
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
            $("#alert").text("Debe seleccionar un Municipio");
        }
    });
    $('#estadoe').on("change", function () {
        var id = $(this).val();
        var municipio = $("#municipioe");
        $("#municipioe").empty();
        $("#parroquiae").empty();
        $("#parroquiae").append('<option value="0" selected>Seleccione...</option>');
        municipio.append('<option value="0" selected>Seleccione...</option>');
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
            $("#alert").text("Debe seleccionar un Estado");
        }
    });
    $('#municipioe').on("change", function () {
        var id = $(this).val();
        var parroquia = $("#parroquiae");
        $("#parroquiae").empty();
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
            $("#alert").text("Debe seleccionar un Municipio");
        }
    });

    $('#for_user_registration_natu').submit(function (e) {
        e.preventDefault();
        if (grecaptcha.getResponse() == "") {
            return location.reload();
        }
        $.ajax({
            url: "/procesar",
            type: "post",
            data: $('#for_user_registration_natu').serialize(),
            success: function (data) {

                if (data == 1) {
                    swal("<font size='6.5px;'>Registro exitoso de los datos!</font>", "<font color='red' size='6px;'>Debe ingresar con su usuario y clave al sistema para completar su información.</font>", "success")
                            .then(function () {
                                location.href = "/";
                            });
                } else if (data == 2) {
                    swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema..", "error");
                    grecaptcha.reset();
                } else if (data == 3) {
                    swal("El usuario / correo proporcionado ya se encuentra registrado.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 4) {
                    swal("El identificador cédula / pasaporte / rif, proporcionado ya se encuentra registrado.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 5) {
                    swal("Faltan los campos Primer Nombre y Primer Apellido.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 6) {
                    swal("Falta seleccionar el Género.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 7) {
                    swal("Falta seleccionar el Estado Civil.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 8) {
                    swal("Falta seleccionar la Fecha de Nacimiento.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 9) {
                    swal("Falta escribir el Correo.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 10) {
                    swal("Falta escribir el Télefono de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 11) {
                    swal("Falta escribir el Télefono Celular de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 12) {
                    swal("Falta seleccionar el Estado Municipio y Parroquia.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 13) {
                    swal("Falta escribir la Dirección detallada de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 14) {
                    swal("Falta escribir un correo valido para crear su usuario.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 15) {
                    swal("Falta escribir su clave de acceso.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 16) {
                    swal("Falta escribir su código postal.", "", "warning");
                    grecaptcha.reset();
                }

            },
            error: function (data) {
                swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema.", "error");
                grecaptcha.reset();
            }
        });
    });

    $('#for_user_registration_jur').submit(function (e) {
        e.preventDefault();
        if (grecaptcha.getResponse() == "") {
            return location.reload();
        }
        $.ajax({
            url: "/procesar",
            type: "post",
            data: $('#for_user_registration_jur').serialize(),
            success: function (data) {

                if (data == 1) {
                    swal("<font size='6.5px;'>Registro exitoso de los datos!</font>", "<font color='red' size='6px;'>Debe ingresar con su usuario y clave al sistema para completar su información.</font>", "success")
                            .then(function () {
                                location.href = "/";
                            });
                } else if (data == 2) {
                    swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema..", "error");
                    grecaptcha.reset();
                } else if (data == 3) {
                    swal("El usuario / correo proporcionado ya se encuentra registrado.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 4) {
                    swal("El identificador cédula / pasaporte / rif, proporcionado ya se encuentra registrado.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 5) {
                    swal("Faltan los campos Primer Nombre y Primer Apellido.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 6) {
                    swal("Falta seleccionar el Género.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 8) {
                    swal("Falta seleccionar la Fecha de Nacimiento.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 9) {
                    swal("Falta escribir el Correo.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 10) {
                    swal("Falta escribir el Télefono de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 11) {
                    swal("Falta escribir el Télefono Celular de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 12) {
                    swal("Falta seleccionar el Estado Municipio y Parroquia.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 13) {
                    swal("Falta escribir la Dirección detallada de contacto.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 14) {
                    swal("Falta escribir un correo valido para crear su usuario.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 15) {
                    swal("Falta escribir su clave de acceso.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 16) {
                    swal("Falta escribir su código postal.", "", "warning");
                    grecaptcha.reset();
                } else if (data == 17) {
                    swal("Falta escribir el nombre de la Empresa.", "", "warning");
                    grecaptcha.reset();
                }

            },
            error: function (data) {
                swal("Ha ocurrido un problema al guardar los datos.", "Comuniquese con el Administrador del sistema.", "error");
                grecaptcha.reset();
            }
        });
    });

    $('#correo').keyup(function () {
        var correo = $('#correo').val();
        $("#usuarioper").val(correo).prop('readonly', true);
    });

    $('#correoe').keyup(function () {
        var correo = $('#correoe').val();
        $("#usuarioperr").val(correo).prop('readonly', true);
    });

    $('.solonumero').keyup(function () {
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });
});

var CaptchaCallback = function () {
    
    grecaptcha.render('RecaptchaField1', {
        'sitekey': '6LcEG7cUAAAAANp8tvxqQziFEGmtujNSvMBk5NCs',
        'theme': 'dark',
        'callback': function () {
            var tipo = $("#tipo").val();
            console.log(tipo);
            if (tipo == 1 || tipo == 2) {
                $('#for_user_registration_natu').submit();
            } else {
                $('#for_user_registration_jur').submit();
            }
        }
    });
    
};
