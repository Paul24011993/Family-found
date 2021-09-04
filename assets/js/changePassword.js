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
				console.log(data_server_random);
				
				$('#inRandom').fadeOut().removeClass('in active');

				//$('#reoveryPassword .col-lg-12').html('<form action="" class="Form_forgot_password top15" autocomplete="off"><div class="form-group"><input type="email" id ="email" name="email" required="" placeholder="Correo electrónico" class="form-control"></div><button class="btn aqua block bottom15 has-spinner" type="submit">Enviar</button><a href="<?php echo SERVER_URL ?>" class="btn aqua btn-outline pull-right ">Cancelar</a></form>');
				$('#reoveryPassword').fadeIn().addClass('in active');
				



			});
		});
		

	});

		
/*
	$('.Form_forgot_password').submit(function(e){
        e.preventDefault();

		var email = $('#email').val();
		
		if(!isEmail(email)){
			swal("Envío cancelado", "Debe ingresar un correo válido", "error");
			return false;
		}

		/* validar si existe el correo ingrersado */
		/*$.post(SERVER_API + "Home/get_data/", { data : email, db_table : 'tbl_usuarios', db_row : 'USU_EMAIL' }, function (data) {
			var data_server = $.parseJSON(data);
			
			if(data_server.data){

				if(data_server.data.USU_SOLICITUD_CLAVE == 1){
					swal("Envío cancelado", "Ya enviamos el codigo a su correo electronico ", "error");
					return false;
				}

				$('button.has-spinner').buttonLoader('start');
			
				/* Generar token password y cambiar el estado de solicitud de cambio de clave */
				/*$.post(SERVER_API + "Home/generateTokenPass/", { usu_id : data_server.data.USU_ID }, function (data_token) {
					
					var token = $.parseJSON(data_token).data;

					var to = email;
					var subject = 'Solicitud para recuperación de contraseña';
					var template = 'forgotPassword';
					var url_recovery = atob(IP_SERVER) + 'changePassword/' + btoa(data_server.data.USU_ID +'/' + token +'/');

					/* Agregar un elemento al json */
					/*data_server.data.url_recovery = url_recovery;

					var dataUser = JSON.stringify(data_server.data);
					//console.log(data_server.data);
					var data_json_email = 
					{
						to : to, 
						subject : subject, 
						template : template,

						/* estructura del mensaje de correo enviado */
						/*title_swal : 'Correo enviado',
						text_swal : 'Hemos enviado un codigo temporal a tu correo electronico para restaurar tu contraseña, expira en 15 minutos',

						/* Datos para la plantilla del correo */
						/*dataUser : dataUser 
					};
					
					send_email(data_json_email);
					$('form.Form_forgot_password')[0].reset();
					
					$('#reoveryPassword').fadeOut().removeClass('in active');
					$('#inRandom').fadeIn().addClass('in active');

					/* Actualizar roandom en 15 minutos */
					/*setTimeout(function(){
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
		
	
	});*/

});
