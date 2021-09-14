$('document').ready(function (e) {
	validate_email_dni_user();
	load_select_2("#profile", 'Users/get_profile_user/');
});

// fill input user_name with data of input dni
$("#dni").keyup(function () {
	var value = $(this).val();
	$("#user_name").val(value);
});

function validate_email_dni_user() {
	//validar email	y cedula			
	$('#email, #dni').blur(function () {
		var selector = $(this);
		var data_input = $(this).val();
		var data_row = $(this).data('row');
		$.ajax({
			url: SERVER_API + "Users/redundancy_email/",
			type: "POST",
			data: { data_input, data_row },
			dataType: "JSON",
			beforeSend: function (objeto) {
				$(selector).siblings(".response_redundancy").show();
				$(selector).siblings(".response_redundancy").html("Validando...");
			},
			success: function (data) {
				$(selector).siblings(".response_redundancy").hide();
				$(selector).siblings(".response_redundancy").fadeIn(1000).html(data.data.menssage);

				if (data.data.type == 'has-error') {
					$(selector).parent('.respuesta-validacion-correo').addClass(data.data.type);
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-success');
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-warning');
				} else if (data.data.type == 'has-success') {
					$(selector).parent('.respuesta-validacion-correo').addClass(data.data.type);
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-error');
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-warning');
				} else if (data.data.type == 'has-warning') {
					$(selector).parent('.respuesta-validacion-correo').addClass(data.data.type);
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-error');
					$(selector).parent('.respuesta-validacion-correo').removeClass('has-success');
				}
			}
		});
	});
}
