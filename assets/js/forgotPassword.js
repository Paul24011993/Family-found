//header('Content-type: application/json');
$(document).ready(function(){
	
	$('.Form_forgot_password').submit(function(e){
        e.preventDefault();

		var email = $('#email').val();
		

		if(!isEmail(email)){
			swal("Envío cancelado", "Debe ingresar un correo válido", "error");
			return false;
		}

		/* validar si existe el correo ingrersado */
		$.post(SERVER_API + "Home/get_data/", { data : email, db_table : 'tbl_usuarios', db_row : 'USU_EMAIL' }, function (data) {
			var data_server = $.parseJSON(data);
			if(data_server.data){

				/* Generar token password y cambiar el estado de solicitud de cambio de clave */
				$.post(SERVER_API + "Home/generateTokenPass/", { usu_id : data_server.data.USU_ID }, function (data_token) {
					
					var token = $.parseJSON(data_token).data;

					var to = email;
					var subject = 'Solicitud para recuperación de contraseña';
					var template = 'forgotPassword';

					var dataUser = JSON.stringify(data_server.data);
					var url_recovery = SERVER_URL + 'changePassword/' + btoa(data_server.data.USU_ID +'/' + token +'/');

					var data_json_email = 
					{
						to : to, 
						subject : subject, 
						template : template, 
						dataUser : dataUser, 
						url_recovery : url_recovery 
					};

					send_email(data_json_email);
					//send_email(to, $subject, message, headers = '', attachments = array());
				
					console.log(token );
					
				});
			}else{
				swal("Envío cancelado", "El correo <span class='alert-danger p-0 px-1'>" + email + "</span> no esta registrado", "error");
				return false;
			}
		});
		
		var form = $(this);
		
        var accion		= form.attr('action');
        var metodo		= form.attr('method');
		
		var formdata = new FormData(this);
		
	
	});

});
