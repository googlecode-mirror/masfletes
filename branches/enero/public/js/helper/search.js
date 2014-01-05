$(function() {
    $("#fechaIniTF, #fechaFinTF").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $(".frmSearch").validate({
        submitHandler: function(form) {
            $.ajax({
                url:urlSearch,
                type:"POST",
                data:$('.frmSearch').serialize(),
                dataType:"html",
                cache:false,
                beforeSend: function(){
                    $('.content_main').html('Cargando...');
                }
            }).done(function(data){
                $('.content_main').html(data);
                details();
                setDelForm();
            }).fail(function(data,text){
                alert("Error!" + text);
            }).always(function(){
                
            });
        },
	rules: {
            edosOrigen:"required",
            edosDestino:"required",
            edosOrigenCity:"required",
            edosDestinoCity:"required",
            shipment:"required",
            route:"required",
            status:"required"
	},
	messages: {
            edosOrigen: "Campo requerido",
            edosDestino: "Campo requerido",
            edosOrigenCity: "Campo requerido",
            edosDestinoCity: "Campo requerido",
            shipment:"Campo requerido",
            route:"Campo requerido",
            status:"Campo requerido"
	}
    });
    
});