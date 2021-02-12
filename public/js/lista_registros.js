$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});

$(document).ready(function () { 

    $("#lista_reg").dataTable().fnDestroy();
    $("#lista_reg").DataTable({
        "language": lang,
        lengthMenu: [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todos"]],
        dom: 'Blfrtip',
        buttons: [
//            'csv', 'excel', 'pdf'
        ],
        "language": lang

    });


    $("#list_regpr").dataTable().fnDestroy();
    $("#list_regpr").DataTable({
        "language": lang,
        lengthMenu: [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todos"]],
        dom: 'Blfrtip',
        buttons: [
//            'csv', 'excel', 'pdf'
        ],
        "language": lang

    });


$("input[type=radio]").click(function(event){
        var valor = $(event.target).val();

        if(valor == 1){ //producto
            $("#ver_prods").show();
            $("#ver_proys").hide();


        } else if (valor == 2) { //proyecto
            $("#ver_proys").show();
            $("#ver_prods").hide();
        } 

});

});



function down_pro(id,opcion){
    swal({
        title: '¿Estas seguro?',
        text: "Esta seguro de eliminar el item",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then(function (res) {
        if(res){
            $.ajax({
                "url": '/admin/deletepro',
                "type": "post",
                "data": {id:id,opcion:opcion},
                "success": function (resp) {                
                    if (resp == 1) {
                        swal("Proceso exitoso.", "", "success");
                        setTimeout(function () {
                            location.href = '/admin/reg_up';
                        }, 1500);
                    } else if (resp == 2) {
                        swal("Error2", "Error durante el proceso.", "error");
                    }else if (resp == 3) {
                        swal("Error3", "Error durante el proceso.", "error");
                    }                    
                },
                "error": function (resp) {
                    swal("Error inesperado");
                }
    
            });
        }
    });


}