$('document').ready(function (e) {

	resourceAddress.hash();
	let path = webAddress.resourcePath;
	let path_separated = path.split('/');

	$("#user_id").val(path_separated[3]);


	load_select_2("#profile", 'Users/get_profile_user/');

	$.ajax({
		url: SERVER_API + 'Users/update_user/' + path_separated[3],
		success: function (data) {
			let jsons = JSON.parse(data);
			
			$('#user_name').val(jsons.data.USU_USUARIO);
			$('#name').val(jsons.data.USU_NOMBRES);
			$('#last_name').val(jsons.data.USU_APELLIDOS);
			$('#email').val(jsons.data.USU_EMAIL);
			$('#dni').val(jsons.data.USU_DNI);
			$('#phone_one').val(jsons.data.USU_TELEFONO_1);
			$('#phone_two').val(jsons.data.USU_TELEFONO_2);
			$('#street_one').val(jsons.data.DIR_CALLE_PRINCIPAL);
			$('#number_home').val(jsons.data.DIR_NUMERO_DOMICILIO);
			$('#street_two').val(jsons.data.DIR_CALLE_SECUNDARIA);
			$('#postal_code').val(jsons.data.DIR_CODIGO_POSTAL);
			$('#reference').val(jsons.data.DIR_REFERENCIA);

			$("input[type=radio]").each(function (index) {
				if (jsons.data.USU_ACTIVO == $(this).val()){
					$(this).attr('checked', true);
					//console.log(jsons.data);
				}
			});
		},
		error: function (data) {
			alert('error');
		}
	});

	// cambiar nombres de mensajes de dropify
	$('#input-file-events, #input-file-partners').dropify({
		messages: {
			'default': 'Arrastre y suelte un archivo aquí o haga clic en',
			'replace': 'Arrastra y suelta o<br> haz clic para reemplazar',
			'remove': 'Eliminar',
			'error': 'Ooops, algo sucedió mal'
		}
	});

	//actualizar imagen de usuario
	$("#input-file-events").change(function () {
		var formData = new FormData();
		var files = $('#input-file-events')[0].files;
		var user_id = $('#user_id').val();
		formData.append('file', files[0]);

		var data_url_image = [getCookie("user_name"), user_id];

		var ajaxObj = {
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,

			xhr: function () {
				var xhr = new XMLHttpRequest();
				xhr.upload.onprogress = function (e) {
					var percent = '0';
					var percentage = '0%';
					if (e.lengthComputable) {
						percent = Math.round((e.loaded / e.total) * 100);
						percentage = percent + '%';
						$('.progress-bar').width(percentage).attr('aria-valuenow', percent).text(percentage);
					}
				};
				return xhr;
			},
			success: function (data) {
				ajaxObj.url = SERVER_URL + 'uploadImageUser/' + btoa($.parseJSON(data).data.name_image) + '/';
				$.ajax(ajaxObj);

				var data_server = $.parseJSON(data);
				name_image_server = data_server.data.name_image;
				//console.log(name_image_server);

				if (data_server.type == 'error') {
					swal(
						"Ocurrio un error",
						data_server.data.message,
						data_server.type
					);
				} else {
					swal(
						"Imagen actualizada",
						data_server.data.message,
						data_server.type
					).then(function () {
						//location.reload();
						$('.alert').show().addClass('alert-success').text('Importación exitosa');
					});
				}
			},
			error: function () {
				avatar.src = initialAvatarURL;
				$('.alert').show().addClass('alert-warning').text('Error al importar el archivo');
			},
			complete: function () {
				//$progress.hide();
			},
		};
		//url1 ajax 
		ajaxObj.url = SERVER_API + 'Users/update_image_user/' + data_url_image;
		$.ajax(ajaxObj);

	});
});