$(function() {
   $("#addVehicleFrm, #editVehicleFrm").validate({
		rules: {
			nameTF: "required",
			descripcionTF: "required",
			capacidadTF:{
                            required:true,
                            number:true                        
                        }
		},
		messages: {
			nameTF: "Campo requerido",
			descripcionTF: "Campo requerido",
                        capacidadTF: "Campo requerido, solo numeros"
		}
	});
});