$(function() {    
    $('#userNameTF').focus(function(){
        $('#correoSp').hide();
    });
    
   $("#addUserFrm, #editUserFrm").validate({        
        submitHandler: function(form)
        {
            $('#correoSp').html("").hide();
            $.ajax({
                url:urlUsers,
                type:"POST",
                data:{ user:$('#userNameTF').val(), idUser:id_user },
                dataType:"html",
                cache:false,
                beforeSend: function(){ $('#correoSp').show(); }
            }).done($.proxy(function(html){
                var r = parseInt(html);
                if( r === 0 )
                    this.submit();
                else
                    $('#correoSp').html("Correo No disponible, favor de cambiarlo.");
            },form)).fail(function(data,text){
                alert("Ocurrio un error " + text);
            });
            return false;
        },
        rules: {
            role:"required",
            firstNameTF: "required",
            lastNameTF: "required",
            address: "required",
            state: "required",
            stateCity: "required",
            zipcode:{
                required:true,
                digits:true
            },
            userNameTF: {
                required: true,
                email:true
            },
            passTF: {
                required: true,
		minlength: 5
            },
            passCpyTF: {
                required: true,
		minlength: 5,
		equalTo: "#passTF"
            }
	},
	messages: {
            role:"Campo requerido",
            firstNameTF: "Campo requerido",
            lastNameTF: "Campo requerido",
            address: "Campo requerido",
            state: "Campo requerido",
            stateCity: "Campo requerido",
            zipcode:{
                required:"Campo requerido",
                digits:"Solo numeros"
            },
	userNameTF: {
            required: "Campo requerido",
            minlength: "El usuario no puede ser menor a 5 caracteres",
            email:"Ingrese un correo valido"
        },
        passTF: {
            required: "Campo requerido",
            minlength: "El password no puede ser menor a 5 caracteres"
	},
	passCpyTF: {
            required: "Campo requerido",
            minlength: "El usuario no puede ser menor a 5 caracteres",
            equalTo: "Los passwords deben ser iguales"
	}
    }
});
        
        $('#changePass').click(function(){
            if( $(this).is(':checked') )
                $('#passTF, #passCpyTF').removeAttr("disabled");
            else
                $('#passTF, #passCpyTF').attr("disabled","disabled");
        });

});