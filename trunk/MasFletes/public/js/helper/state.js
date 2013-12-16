$(function() {
    $('.selState').change(function() {
        $('#' + this.id + 'City').attr('disabled','disabled');
        $.post(urlGetCities, {state: $(this).val()}).done($.proxy(function(data) {
            result = $.parseJSON(data);
            options = $('#' + this.id + 'City');
            $(options).empty();
            $.each(result, function(){
                options.append($("<option />").attr("value", this.id).text(this.name));
            });
            $('#' + this.id + 'City').removeAttr("disabled");
        }, this));
        ;
    });
});


