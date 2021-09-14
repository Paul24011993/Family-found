//header('Content-type: application/json');
$(document).ready(function(){

	if(!isExistCookie("id_user")){
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
			
			$.post(SERVER_API + "Home/updatePasswordRecovery/", { USU_ID : getCookie('id_user'), USU_TOKEN_CLAVE : "", NEW_PASSWORD : password }, function (data_updatePassword) {
				
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
