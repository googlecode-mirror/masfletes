$(function() {
    setDelForm();
});

function setDelItems()
{
    $('.deleteItem').click(function(){
        $('#rowIndex').val($(this).parent().parent().index());
        $('#idItem').val( $(this).attr('id') );
        $("#dialog-delete").dialog('open');
    });
}

function setDelForm()
{
    $.post(urlDelForm,{txt : texto},function(html)
    {
        $('.well:eq(0)').append(html);
        $('#dialog-delete').dialog({
        autoOpen: false,
        resizable: false,
        modal: true,
        open:function(event,ui)
        {
            $('#responseDiv').hide();
            $('.ui-dialog-buttonset button:eq(0)').removeAttr('disabled');
        },
        beforeClose:function(event,ui)
        {
            if( $('.ui-dialog-buttonset button:eq(1)').is(':disabled'))
                return false;
        },
        buttons: 
        {
            "Si": function()
            {
                $.ajax({
                url:urlDelete,
                type:"POST",
                data:{ent:entity, idItem : $('#idItem').val()},
                cache:false,
                beforeSend: function(){
                    $('.wait').show();
                    $('.ui-dialog-buttonset button').attr('disabled','disabled');
                }
               }).done(function(html){
                    var rp = parseInt(html);
                    if( rp == 1)
                    {
                        $('.table tbody tr:eq('+ $('#rowIndex').val() +')').remove();
                        $('#responseDiv').attr('class','alert alert-success');
                        $('#responseDiv').html('La eliminación fue satisfactoria');
                    }else{
                        $('#responseDiv').attr('class','alert alert-error');
                        $('#responseDiv').html('Ocurrió un error, intenta de nuevo!');
                    }
                    $('#responseDiv').show();
               }).fail(function(){
                   $('#responseDiv').attr('class','alert alert-error');
                   $('#responseDiv').html('Ocurrió un error, intenta de nuevo!');
                   $('#responseDiv').show();
               }).always(function(){
                   $('.wait').hide();
                   $('.ui-dialog-buttonset button:eq(1)').removeAttr('disabled');
               });
            },
            "Cerrar": function() {
                $( this ).dialog( "close" );
            }}
       });
       setDelItems();
    });
}