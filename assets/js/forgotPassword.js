//header('Content-type: application/json');
$(document).ready(function(){

	$('.Form_forgot_password').submit(function(e){
        e.preventDefault();

		var email = $('#email').val();
		
		if(!isEmail(email)){
			swal("Envío cancelado", "El correo ingresado no tiene un formato válido", "error");
			return false;
		}

		/* validar si existe el correo ingrersado */
		$.post(SERVER_API + "Home/get_data/", { data : email, db_table : 'tbl_usuarios', db_row : 'USU_EMAIL' }, function (data) {
			var data_server = $.parseJSON(data);
			
			if(data_server.data){

				if(data_server.data.USU_SOLICITUD_CLAVE == 1){
					swal("Envío cancelado", "Ya enviamos el codigo a su correo electrónico ", "error");
					return false;
				}

				$('button.has-spinner').buttonLoader('start');
			
				/* Generar token password y cambiar el estado de solicitud de cambio de clave */
				$.post(SERVER_API + "Home/generateTokenPass/", { usu_id : data_server.data.USU_ID }, function (data_token) {
					
					var token = $.parseJSON(data_token).data;

					var to = email;
					var subject = 'Solicitud para recuperación de contraseña';
					var template = 'forgotPassword';
					var url_recovery = atob(IP_SERVER) + 'changePassword/' + btoa(data_server.data.USU_ID +'/' + token +'/');

					/* Agregar un elemento al json */
					data_server.data.url_recovery = url_recovery;

					var dataUser = JSON.stringify(data_server.data);
					//console.log(data_server.data);
					var data_json_email = 
					{
						to : to, 
						subject : subject, 
						template : template,

						/* estructura del mensaje de correo enviado */
						title_swal : 'Correo enviado',
						text_swal : 'Hemos enviado un codigo temporal a tu correo electronico para restaurar tu contraseña, expira en 15 minutos',

						/* Datos para la plantilla del correo */
						dataUser : dataUser 
					};
					
					send_email(data_json_email);
					$('form.Form_forgot_password')[0].reset();
				
					/* Actualizar roandom en 15 minutos */
					setTimeout(function(){
						$.ajax({
							method: "POST",
							url: SERVER_API + "Home/updateRandom/",
							data: { USU_ID: data_server.data.USU_ID },
							success:function(res){
								//alert('acción de ejecución lanzada al servidor');
							},
							error:function(err){
								//alert('Error sobre la conexión al servidor');
							}
						});
						}, 900000);

				});
			}else{
				swal("Envío cancelado", "El correo " + email + " no esta registrado", "error");
				return false;
			}
		});
		
		var form = $(this);
		
        var accion		= form.attr('action');
        var metodo		= form.attr('method');
		
		var formdata = new FormData(this);
		
	
	});

});
