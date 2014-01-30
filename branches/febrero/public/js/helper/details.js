$(function() {
    $('#closeDetails').click(function(){
        $('#details').fadeOut('fast',function(){
            $('.details').html('');
            $('#panelmain').fadeIn();
            $('#searchBtn').removeAttr('disabled');
        });
    })
    details();
});

function details()
{
    $('.icon-search').click(function() {
        var item = $(this).parent().attr('id');
        var nameEnt = $(this).parent().attr('class');
        
        $.ajax({
            url:urlGetDetails,
            type:"POST",
            data:{idItem:item, entity:nameEnt},
            cache:false,
            beforeSend: function(){
                $('#panelmain').fadeOut('fast',function(){
                    $('.details').html('Cargado...');
                    $('#details').fadeIn();
                });
            }
        }).done(function(html){
            $('.details').html(html);
        }).fail(function(){
            $('.details').html("Ocurrio un error!");
        }).always(function(){
            $('#searchBtn').attr('disabled','disabled');
        });
    });
}