$(function() {
    $('#closeBtn').click(function(){
       if( !$("#respY").is(":hidden") )
           document.location.reload();
    });
    
    $('.icon-remove').click(function(){
        var idEnt = $(this).parent().attr('id');
        $("#myModal .modal-body").html("");
        $('#myModal .modal-title').html("Eliminar registro # " + idEnt)
        $("#deletePane").show();
        $('#myModal').modal('show');
        $('#deleteBtn').click(function(){
            deleteReg(idEnt);
        });
    });
    
    $("#frmSearchShipment").validate({
        submitHandler: function(form) {
            $.ajax({
                url:urlSearch,
                type:"POST",
                data:$('#frmSearchShipment').serialize(),
                dataType:"json",
                cache:false,
                beforeSend: function(){
                    $('#deletePane').hide();
                    $('#loading').show();
                    $('#shipmentsTable tbody').html("");
                    if( $('#aviso').is(':visible') )
                        $('#aviso').hide();
                }
            }).done(function(data){
                var fn = data.length;

                if( isNaN(parseInt(fn)) )
                {
                    $('#aviso').show().html(data.msg);
                    return false;
                }

                var row = "";            
                for(i = 0; i < fn; ++i)
                {
                    row = "<tr><td>" + data[i].id + "</td><td>" + data[i].cit1 + ", " + data[i].edo1 + "</td><td>" + data[i].cit2 + ", " + data[i].edo2 + "</td>";
                    row = row + "<td>" + data[i].dateSource + "</td><td>" + data[i].dias + "</td>";
                    row = row + "<td>" + data[i].vehicle + "</td><td>" + data[i].tipo + "</td><td>" + ((data[i].aceptado == '1') ? "<span class='icon-ok'></span>" : "" ) + "</td>";
                    row = row + "<td id='" + data[i].id + "' style='cursor:pointer;'><span class='icon-search'></span>&nbsp;<span class='icon-pencil'></span>&nbsp;<span class='icon-remove'></span></td></tr>";
                    $('#shipmentsTable tbody').append(row);
                }

                details();
            }).fail(function(data,text){
                alert("Error!" + text);
            }).always(function(){
                $('#loading').hide();
            });
        },
	rules: {
            edosOrigen:"required",
            edosDestino:"required",
            edosOrigenCity: "required",
            edosDestinoCity: "required"
	},
	messages: {
            edosOrigen: "Campo requerido",
            edosDestino: "Campo requerido",
            edosOrigenCity: "Campo requerido",
            edosDestinoCity: "Campo requerido"
	}
    });
    
    details();
});

function deleteReg(idEnt)
{
    $.ajax({
        url:urlDelete,
        type:"POST",
        data:{'idEntity' : idEnt, 'entityName' : 'Shipment'},
        cache:false,
        beforeSend: function(){
            $("#myModal .modal-body").html("<div align='center'>Eliminando registro...</div>");
            $("#deletePane").hide();
        }
    }).done(function(html){
        $("#myModal .modal-body").html("<div align='center' id='respY'>" + html + "</div>");
        
    }).fail(function(){
        $("#myModal .modal-body").html("<div align='center'>Ocurri&oacute; un error, por favor intenta de nuevo.</div>");
    }).always(function(){
    
    });
}

function details()
{
    $("#deletePane").hide();
    
    $('.icon-search').click(function() {
        $('#myModal').modal('show');
        var idShip = $(this).parent().attr('id');
        $.ajax({
            url:urlGetModal,
            type:"POST",
            data:{idShipment:idShip},
            cache:false,
            beforeSend: function(){
                $("#myModal .modal-body").html("<div align='center'>Cargando Informaci&oacute;n</div>");
            }
        }).done(function(html){
            $("#myModal .modal-title").html("Detalle de carga # " + idShip);
            $("#myModal .modal-body").html(html);
        }).fail(function(){
            $("#myModal .modal-body").html("<div align='center'>Ocurri&oacute; un error, por favor intenta de nuevo.</div>");
        }).always(function(){
         
        });
    });
}