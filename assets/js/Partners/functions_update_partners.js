$('document').ready(function (e) {

	resourceAddress.hash();
	let path = webAddress.resourcePath;
	let path_separated = path.split('/');

	$("input[type=hidden]").val(path_separated[3]);
	load_select_2("#sponser", 'Partners/index_excluyent/' + decode_b64(path_separated[3]));
	
	$.ajax({
		url: SERVER_API + 'Partners/updatePartner/' + path_separated[3],
		success: function (data) {
			let jsons = JSON.parse(data);
			
			$('#name').val(jsons.data.SOC_NOMBRES);
			$('#last_name').val(jsons.data.SOC_APELLIDOS);
			$('#email').val(jsons.data.SOC_EMAIL);
			$('#dni').val(jsons.data.SOC_DNI);
			$('#phone_one').val(jsons.data.SOC_TELEFONO);
			$('#partner_id_select').val(jsons.data.SOC_ID);
			
			$("input[type=radio]").each(function (index) {
				if (jsons.data.SOC_ESTADO == $(this).val()) {
					$(this).attr('checked', true);
					//console.log(jsons.data);
				}
			});
		},
		error: function (data) {
			alert('error');
		}
	});

	//$('.select2').select2();
	
	//console.log('Partners/index_excluyent/' + decode_b64($('#partner_id_select').val()));
	

	// cambiar nombres de mensajes de dropify
	var drEvent = $('#input-file-events, #input-file-partners').dropify({
		messages: {
			'default': 'Arrastre y suelte un archivo aquí o haga clic en',
			'replace': 'Arrastra y suelta o<br> haz clic para reemplazar',
			'remove': 'Eliminar',
			'error': 'Ooops, algo sucedió mal'	
		}
	});

	//actualizar imagen de usuario
	$("#input-file-partners").change(function () {
		var formData = new FormData();
		var files = $('#input-file-partners')[0].files;
		var user_id = $('#partner_id').val();
		formData.append('file', files[0]);

		var data_url_image = [getCookie("user_name"), user_id];
		console.log(data_url_image);


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
				console.log(name_image_server);

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
		ajaxObj.url = SERVER_API + 'Partners/update_image_partner/' + data_url_image;
		$.ajax(ajaxObj);

	});
	

});
