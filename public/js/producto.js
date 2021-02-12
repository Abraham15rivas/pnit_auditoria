$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

$(document).ready(function () { 

///////sub area /////
$("#prod_ar").change(function(){
    var id = $(this).val(); 
    $.ajax({
        "url":"/admin/prod_sar",
        "type":"post",
        "data": {id:id},
        "success": function(r){
            var res = r; 
            //console.log(r);
            $("#prod_sar").html("");
            $('#prod_sar').append($('<option>', {
                text: "Seleccione...",
                value: "0"
            }));
            $.each(res, function(i, item){
                $('#prod_sar').append($('<option>', {
                    value: item.id,
                    text: item.nombre
                }));
            });
            $("#prod_sar").prop("disabled", false);
        }
    });
});


///////especialidad /////
$("#prod_sar").change(function(){
    var id = $(this).val(); 
    $.ajax({
        "url":"/admin/prod_esp",
        "type":"post",
        "data": {id:id},
        "success": function(r){
            var res = r; 
            //console.log(r);
            $("#prod_esp").html("");
            $('#prod_esp').append($('<option>', {
                text: "Seleccione...",
                value: "0"
            }));
            $.each(res, function(i, item){
                $('#prod_esp').append($('<option>', {
                    value: item.id,
                    text: item.nombre
                }));
            });
            $("#prod_esp").prop("disabled", false);
        }
    });
});


$("input[type=radio]").click(function(event){
        var valor = $(event.target).val();

        if(valor == 1){ //producto
            $("#est_prod_fecha").show();
            $("#tipo_producto").show();
            $("#tipo_pat_destino").show();
            $("#objetivo").hide();  
            $("#preguntas").hide();
            $("#fecha_conlusion").hide();

            $("#prod_tit").removeClass("has-error");
            $("#prod_res").removeClass("has-error");
            $("#prod_ar").removeClass("has-error");
            $("#prod_sar").removeClass("has-error");
            $("#prod_esp").removeClass("has-error");
            $("#prod_lin").removeClass("has-error");
            $("#prod_mot").removeClass("has-error");
            $("#prod_ff").removeClass("has-error");

            $("#prod_tipo").removeClass("has-error");
            $("#prod_est").removeClass("has-error");
            $("#fecha_con").removeClass("has-error");


         // Clear the form
         $("#reg_save").find("textarea").val('');
         $('select').find('option').prop("selected", false);
         $('#nubeurl').val(""); 

        } else if (valor == 2) { //proyecto
            $("#objetivo").show();
            $("#preguntas").show();
            $("#fecha_conlusion").hide();
            $("#est_prod_fecha").hide();
            $("#tipo_producto").hide();
            $("#tipo_pat_destino").hide();

            $("#prod_tit").removeClass("has-error");
            $("#prod_res").removeClass("has-error");
            $("#prod_ar").removeClass("has-error");
            $("#prod_sar").removeClass("has-error");
            $("#prod_esp").removeClass("has-error");
            $("#prod_lin").removeClass("has-error");
            $("#prod_mot").removeClass("has-error");
            $("#prod_ff").removeClass("has-error");

            $("#pro_obj").removeClass("has-error");
            $("#proy_est").removeClass("has-error");
            $("#proy_p1").removeClass("has-error");
            $("#proy_p2").removeClass("has-error");
            $("#proy_p3").removeClass("has-error");
            $("#proy_p4").removeClass("has-error");    

        // Clear the form
         $("#reg_save").find("textarea").val('');
         $('select').find('option').prop("selected", false);
         $('#nubeurl').val("");        
        } 

});


$("#prod_est").change(function(){
    var valor = $(event.target).val();
 
    if(valor == 1){ //producto
        $("#fecha_conlusion").show();
    }
    else if (valor == 2) { //proyecto
        $("#fecha_conlusion").hide();
    } 

});

$('input[type="file"]').change(function (e) {
        var files = $("input[type='file']");
        //obtenemos el nombre del archivo
        var fileName = e.target.files[0].name;
        //obtenemos la extensión del archivo
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = e.target.files[0].size;
        //obtenemos el tipo de archivo
        var fileType = e.target.files[0].type;

        var arc1 = $( "input[name='prod_ar1']" ).val();
        var arc2 = $( "input[name='prod_ar2']" ).val();

       if (fileSize > 3145728)
        {
            swal("Error!", "El peso del archivo debe ser inferior a 3MB", "error");
            return $(this).val("");
        }

        if(arc1 !=='') {
            if (!arc1.match(/(?:pdf)$/)) {
                swal("Error!", "El formato del archivo debe ser pdf ", "error");
                return $(this).val("");
            }
        }
        if(arc2 !==''){
            if (!arc2.match(/(?:pdf|jpg|png|jpeg)$/)) {
                    swal("Error!", "El formato del archivo debe ser  png, jpg ,jpeg o pdf", "error");
                    return $(this).val("");
            }
        }
    });


$('#reg_save').submit(function (e) {
    e.preventDefault();
   var opc = $('input[name=opc]:checked').val() 
   var prod_tipo = $("#prod_tipo").val();
   var prod_tit = $("#prod_tit").val();
   var prod_res = $("#prod_res").val();
   var prod_lin = $("#prod_lin").val();
   var prod_ar = $("#prod_ar").val();
   var prod_sar = $("#prod_sar").val();
   var prod_esp = $("#prod_esp").val();
   //if opc 2
   var pro_obj = $("#pro_obj").val();
   var proy_est = $("#proy_est").val();
   var proy_p1 = $("#proy_p1").val();
   var proy_p2 = $("#proy_p2").val();
   var proy_p3 = $("#proy_p3").val();
   var proy_p4 = $("#proy_p4").val();

   var prod_mot = $("#prod_mot").val();
   var prod_tp = $("#prod_tp").val();
   var prod_des = $("#prod_des").val();
   var prod_ff = $("#prod_ff").val();
   var prod_est = $("#prod_est").val();
   var fecha_con = $("#fecha_con").val(); 
   var nubeurl = $("#nubeurl").val(); 
   var e = 0; 

    if(prod_tit == ""){
        $("#prod_tit").addClass("has-error");
        e++;
    }
    if(prod_res == ""){
        $("#prod_res").addClass("has-error");
        e++;
    }

    if(prod_ar == 0){
        $("#prod_ar").addClass("has-error");
        e++;
    }
    if(prod_sar == 0){
        $("#prod_sar").addClass("has-error");
        e++;
    } 

    if(prod_esp == 0){
        $("#prod_esp").addClass("has-error");
        e++;
    }
            
    if(prod_mot == 0){
        $("#prod_mot").addClass("has-error");
        e++;
    }
    if(prod_ff == 0){
        $("#prod_ff").addClass("has-error");
        e++;
    }     
    if(opc == 1){
        if(prod_tipo == 0){
            $("#prod_tipo").addClass("has-error");
            e++;
        }
        if(prod_est == 0){
            $("#prod_est").addClass("has-error");
            e++;
        }        
        if(prod_est == 1){
            if(fecha_con == ""){
                $("#fecha_con").addClass("has-error");
                e++;
            } 
        } 

    }
    if(opc == 2){
        if(pro_obj == ""){
            $("#pro_obj").addClass("has-error");
            e++;
        }
        if(proy_est == 0){
            $("#proy_est").addClass("has-error");
            e++;
        }
        if(proy_p1 == 0){
            $("#proy_p1").addClass("has-error");
            e++;
        } 
        if(proy_p2 == 0){
            $("#proy_p2").addClass("has-error");
        } 
        if(proy_p3 == 0){
            $("#proy_p3").addClass("has-error");
            e++;
        }         
        if(proy_p4 == 0){
            $("#proy_p4").addClass("has-error");
            e++;
        } 
    }

//////////////////////////////////////////////////////////////

   var obj_file = [];
   var files = $("input[type='file']");
    files.each(function () {
            obj_file.push($(this).prop('files')[0]);
    });

    var form_data = new FormData();
    $.each(obj_file, function (posicion, elemento) {
            form_data.append("file[" + posicion + "]", elemento);
    });    

    form_data.append("opc", opc);
    form_data.append("prod_tipo", prod_tipo);
    form_data.append("prod_tit", prod_tit);
    form_data.append("prod_res", prod_res);
    form_data.append("prod_lin", prod_lin);
    form_data.append("prod_ar", prod_ar);
    form_data.append("prod_sar", prod_sar);
    form_data.append("prod_esp", prod_esp);
    form_data.append("pro_obj", pro_obj);
    form_data.append("proy_est", proy_est);
    form_data.append("proy_p1", proy_p1);
    form_data.append("proy_p2", proy_p2);
    form_data.append("proy_p3", proy_p3);
    form_data.append("proy_p4", proy_p4);
    form_data.append("prod_mot", prod_mot);
    form_data.append("prod_tp", prod_tp);
    form_data.append("prod_des", prod_des);
    form_data.append("prod_ff", prod_ff);
    form_data.append("prod_est", prod_est);
    form_data.append("fecha_con", fecha_con); 
    form_data.append("nubeurl", nubeurl); 
    if (e === 0) {
            $.ajax({
                "url": "/procInf",
                "data": form_data,
                "dataType": 'json',
                "cache": false,
                "contentType": false,
                "processData": false,
                "type": "post",
                "success": function (res) {
                    if (res == 1) {
                        swal("Aviso", "Registro exitoso", "success");
                        setTimeout(function () {
                            location.href = '/admin/reg_up';
                        }, 1500);
                    } else if (res == 0) {
                        swal("Error0", "Ha ocurrido un error durante el proceso.", "error");
                    } else if (res == 3) {
                        swal("Error3", "Se ha producido un error al guardar el o los archivos.", "error");
                    } else if (res == 2) {
                        swal("Aviso", "Los archivos no cumplen con el formato PDF, PNG, JPG O JPEG.", "warning");
                    } else if (res == 4) {
                        swal("Aviso", "Los archivos no cumplen con el tamaño de 3MB.", "warning");
                    }
                    
                },
                "error": function () {
                    swal("Error de servidor");
                }
            });
   }


 });




});




