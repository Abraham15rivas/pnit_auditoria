$(function () {

    $("#logform").submit(function (e) {
        e.preventDefault();
        if (grecaptcha.getResponse() == "") {
            return location.reload();
        }
        var usuario = $("#username").val();
        var contra = $("#password").val();

        $("#alert").css("display", "none");
        if (usuario === "") {
            $("#alert").css("display", "block");
            $("#alert").text('Rellene el campo Correo Electrónico');
        } else if (contra === "") {
            $("#alert").css("display", "block");
            $("#alert").text('Rellene el campo Contraseña');
        } else {

            $.ajax({
                'method': 'POST',
                'url': '/check',
                'data': $('#logform').serialize(),
                'success': function (response) {
                    if (response == 1) {
                        location.href = "/admin";
                    } else if (response == 2) {
                        $("#alert").css("display", "block");
                        $("#alert").text('El Usuario Proporcionado es Incorrecto');
                        grecaptcha.reset();
                    } else if (response == 3) {
                        $("#alert").css("display", "block");
                        $("#alert").text('La Contraseña Proporcionada es Incorrecta');
                        grecaptcha.reset();
                    }
                },
                'error': function () {

                    $("#alert").css("display", "block");
                    $("#alert").text('Ha ocurrido un problema interno');
                    grecaptcha.reset();
                }
            });
        }
    });
    /*****************nuevo *****************/
    $(".form-control").on('keyup change', function (e) {
        var inp = $(".form-control");
        if (
                $(inp[0]).val() == "" ||
                $(inp[1]).val() == ""

                ) {
            if (!$("#RecaptchaField1").hasClass("disabled-element")) {
                $("#RecaptchaField1").addClass("disabled-element");
            }
        } else {
            if ($("#RecaptchaField1").hasClass("disabled-element")) {
                $("#RecaptchaField1").removeClass("disabled-element");
            }
        }
    });
    /*****************nuevo *****************/
});

var CaptchaCallback = function () {
    grecaptcha.render('RecaptchaField1', {
        'sitekey': '6LcEG7cUAAAAANp8tvxqQziFEGmtujNSvMBk5NCs',
        'theme': 'dark',
        'callback': function () {
            $('#logform').submit();
        }
    });
};