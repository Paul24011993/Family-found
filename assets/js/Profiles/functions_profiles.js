$('document').ready(function (e) {

	view_all_permissions(['ver_Perfiles', 'add_Perfiles', 'mod_Perfiles', 'del_Perfiles', 'exp_Perfiles' ], get_list_users());

});


//******* profiles ******/
var get_list_users = function () {

	moment.lang('es', {
			months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
			monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
			weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
			weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
			weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
		}
	);
	
	var table = $('#dt_data_profile').DataTable({
		"destroy" : true,
		"columnDefs": [
			{ className: "text-center", "targets": [3] }
		],
		"ajax": SERVER_API + "Profiles/",
		"columns": [
			{ "data": "PRF_ID" },
			{ "data": "PRF_DESCRIPCION" },
			{
				"data": "PRF_FECHA_CREACION",
				"render": function (data, type, row, meta) {
					return moment(new Date(data)).format('dddd, D MMMM, YYYY - hh:mm:ss A')
				} },
			{
				"data": "PRF_ID",
				"render": function (data, type, row, meta) {
					let buttons = `<a href=" ${SERVER_URL}updateProfile/${encode_b64(data)}/" class="mod_Perfiles btn btn-primary btn_datatable">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="#" class="btn btn-danger btn_datatable delete_labour btn-delete del_Perfiles" >
										<i class="fa fa-trash"></i>
									</a>`;
					return buttons;
				}
			}
		],
		"language": idioma_espanol,
		dom: "<'row'<'form-inline' <'col-sm-offset-5 exp_Perfiles'B>>>"
			+ "<'row' <'form-inline' <'col-sm-6 col-md-6 col-lg-6 text-left mt-3'l >"
			+ " <'col-sm-6 col-md-6 col-lg-6'f>>>"
			+ "<rt>"
			+ "<'row'<'form-inline'"
			+ "<'col-sm-12 col-md-12 col-lg-12'p>>>",//'Bfrtip',
		buttons: [{
			text: 'copy',
			extend: "copy",
			className: 'btn dark btn-outline'
		}, {
			text: 'csv',
			extend: "csv",
			className: 'btn aqua btn-outline'
		}, {
			text: 'excel',
			extend: "excelHtml5",
			className: 'btn aqua btn-outline'
		}, {
			text: 'pdf',
			extend: "pdf",
			className: 'btn yellow  btn-outline'
		}, {
			text: 'print',
			extend: "print",
			className: 'btn purple  btn-outline'
		}]
	});

	$("#dt_data_profile tbody").on("click", "a.btn-delete", function () {
		var data = table.row($(this).parents("tr")).data();

		swal({
			title: "¿Estás seguro?",
			text: "Los datos serán eliminados completamente del sistema",
			type: "question",
			showCancelButton: true,
			confirmButtonText: "Aceptar",
			cancelButtonText: "Cancelar"
		}).then(function () {
			$.ajax({
				type: "POST",
				url: SERVER_API + 'Profiles/deleteProfile/' + btoa(data.PRF_ID),
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {

					var data_server = $.parseJSON(data);

					if (data_server.type == 'error') {
						swal(
							"Ocurrio un error",
							data_server.data.message,
							data_server.type
						);
					} else {
						swal(
							"Registro eliminado",
							data_server.data.message,
							data_server.type
						).then(function () {
							location.reload();
						});
					}
				},
				error: function () {
					alert('error');
					$('.RespuestaAjax').html(msjError);
				}
			});
			return false;
		});
	});
}
//******* end profiles ******/