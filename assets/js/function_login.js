//header('Content-type: application/json');
$(document).ready(function(){
	
	$('.Form_login').submit(function(e){
        e.preventDefault();
		
		var form = $(this);
		
        var accion		= form.attr('action');
        var metodo		= form.attr('method');
		
		var formdata = new FormData(this);
		
		$.ajax({
			type: metodo,
			url: SERVER_API + accion,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (respuesta) {
			var obj = $.parseJSON(respuesta);
			
			//console.log(obj.type);
				if(obj.type == 'success'){
					var token = obj.data.token;
					var user_image = obj.data.user_image;
					var user_name = obj.data.user;
					var id_user = obj.data.id_user;
					var first_name = obj.data.first_name;
					var last_name = obj.data.last_name;
					var profile = obj.data.profile;
					var id_profile = obj.data.role;
					
					setCookie("Token_user",token,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("user_image",user_image,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("user_name",user_name,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("id_user",id_user,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("first_name",first_name,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("last_name",last_name,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("profile",profile,1); 			//set "user_email" cookie, expires in 1 day
					setCookie("id_profile",id_profile,1); 			//set "user_email" cookie, expires in 1 day
					
					if (obj.data.user_type === 1){
						window.location.href = SERVER_URL + "home/";
					} else if (obj.data.user_type === 2){
						window.location.href = SERVER_URL + "resetPassword/";
					}else{
						window.location.href = SERVER_URL;
					}

				}else{
				alert(obj.data.message);
				}
			},
			error: function() {

				alert(obj.data.message);
			}
		});
	});


	// Logout
	$('.btn-exit-system').on('click', function (e) {
		e.preventDefault();
		var Token = $(this).attr('href');
		//console.log(Token);
		swal({
			title: '¿Estas seguro?',
			text: "la sesión actual se cerrará y deberas iniciar sesión nuevamente",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			//cancelButtonColor: '#F44336',
			confirmButtonText: 'Si, Cerrar!',
			cancelButtonText: 'No, Cancelar!'
		}).then(function () {
			$.ajax({
				url: SERVER_API + 'Users/logout/' + Token,
				success: function (data) {
					console.log(data);
					var data_server = $.parseJSON(data);
					if (data_server.data.logout === "true") {
						//Delete cookie 
						document.cookie = "Token_user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
						document.cookie = "user_image=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
						document.cookie = "user_name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

						window.location.href = SERVER_URL;
					} else {
						swal(
							"Ocurrio un error",
							"No se pudo cerrar la sesion",
							"error"
						);
					}
				}
			});
		});
	});
		
});
