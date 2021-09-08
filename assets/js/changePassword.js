//header('Content-type: application/json');
$(document).ready(function(){

	resourceAddress.hash();
	let path = webAddress.resourcePath;
	let path_separated = path.split('/');

	// separar los arametrso encriptados
	let path_separated_encode = atob(path_separated[3]).split('/');	
	
	// Si la cadena codificada no es correcta y si no hay los dos parametros enviados
	if( !urlisBase64(path_separated[3]) || !path_separated_encode[0] || !path_separated_encode[1] ){
		$('#inRandom ').empty();
		swal({
			title: "",
			text: "No se pudo verificar los datos",
			type: "error",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Salir",
			closeOnConfirm: true
		},
		function(isConfirm) {
			if (isConfirm) {
				window.location.href = SERVER_URL;
			}
		});
		return false;
	}
	
	$.post(SERVER_API + "Home/verificaTokenPass/", { data : path_separated[3] }, function (data) {
		var data_server = $.parseJSON(data);
		var data_user_random = '';

		if(!data_server.data){
			$('#inRandom ').empty();
			swal({
				title: "",
				text: "No se pudo verificar los datos",
				type: "error",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Salir",
				closeOnConfirm: true
			},
			function(isConfirm) {
				if (isConfirm) {
					window.location.href = SERVER_URL;
				}
			});
			return false;
		}
		
		$('.form_in_random').submit(function(e){
			e.preventDefault();
			
			var random = $('#random').val();
			if(random == ''){
				swal("Error", "Ingrese su código de validación", "error");
				return false;
			}
			$.post(SERVER_API + "Home/validate_random/", { code_random : random }, function (data) {
				var data_server_random = $.parseJSON(data);
				
				if(!data_server_random.data){
					swal("Error", "Código incorrecto", "error");
					return false;
				}
				data_user_random = data_server_random; 
				
				$('#inRandom').fadeOut().removeClass('in active');
				
				//$('#reoveryPassword .col-lg-12').html('<form action="" class="Form_forgot_password top15" autocomplete="off"><div class="form-group"><input type="email" id ="email" name="email" required="" placeholder="Correo electrónico" class="form-control"></div><button class="btn aqua block bottom15 has-spinner" type="submit">Enviar</button><a href="<?php echo SERVER_URL ?>" class="btn aqua btn-outline pull-right ">Cancelar</a></form>');
				$('#reoveryPassword').fadeIn().addClass('in active');
			});
		});
		
		//validar claves ()
		$('#password').strength({
			strengthConfirmPass: 'repeat_password',
			strengthClass: 'strength',
			strengthMeterClass: 'strength_meter',
			strengthButtonClass: 'button_strength',
			strengthButtonText: '<i class="icon fa fa-eye" aria-hidden="true"></i>',
			strengthButtonTextToggle: '<i class="icon fa fa-eye-slash" aria-hidden="true"></i>'
		});
 
		$('.Form_change_password').submit(function(e){
			e.preventDefault();
			
			var password 		= $('#password').val();
			var repeat_password = $('#repeat_password').val();

			if(password.localeCompare(repeat_password) !== 0){
				swal("Error", "Las contraseñas no coinciden", "error");
				return false;
			}
			
			$.post(SERVER_API + "Home/updatePasswordRecovery/", { USU_ID : data_user_random.data.USU_ID, USU_TOKEN_CLAVE : data_user_random.data.USU_TOKEN_CLAVE, NEW_PASSWORD : password }, function (data_updatePassword) {
				
				var updatePassword = $.parseJSON(data_updatePassword).data;
				console.log(updatePassword);

				if(updatePassword){
					swal({
						title: "",
						text: "Tu contraseña se actualizo corectamente",
						type: "success",
						confirmButtonClass: "btn-success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: true
					},
					function(isConfirm) {
						if (isConfirm) {
							window.location.href = SERVER_URL;
						}
					});
				}else{
					swal("Error", "Error al actualizar la contraseña, por favor vuelve a intentarlo", "error");
					return false;
				}
			});
		});
	});
});
