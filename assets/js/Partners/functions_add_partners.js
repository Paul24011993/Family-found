$('document').ready(function (e) {
	validate_email_dni_partners();

	load_select_2('#sponsor', 'Partners/get_partners_sponsor_list/')
});

function validate_email_dni_partners() {
	//validar email	y cedula			
	$('#email-soc, #dni-soc').blur(function () {
		var selector = $(this);
		var data_input = $(this).val();
		//var data_row = $(this).data('row');
		var data_row = $(this).attr('data-row');
		//console.log(SERVER_API + "Partners/redundancy_email/");
		$.ajax({
			url: SERVER_API + "Partners/redundancy_email/",
			type: "POST",
			data: { data_input, data_row },
			dataType: "JSON",
			beforeSend: function (objeto) {
				$(selector).siblings(".response_redundancy").show();
				$(selector).siblings(".response_redundancy").html("Validando...");
			},
			success: function (data) {
				//console.log(data);
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