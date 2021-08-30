$('document').ready(function (e) {

	view_all_permissions(['ver_Lista_de_Socios', 'add_Lista_de_Socios', 'mod_Lista_de_Socios', 'del_Lista_de_Socios', 'exp_Lista_de_Socios'], get_list_partners());

});

 
//******* profiles ******/
var get_list_partners = function () {

	moment.lang('es', {
			months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
			monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
			weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
			weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
			weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
		}
	);
	var table = $('#dt_data_partners').DataTable({
		//"destroy" : true,
		"ajax": SERVER_API + "Partners/",
		"columns": [
			{
				"data": "SOC_NOMBRES",
				render: function (data, type, row) {
					return row.SOC_NOMBRES + ' ' + row.SOC_APELLIDOS;
				}
			},
			{ "data": "SOC_DNI" },
			{ "data": "SOC_EMAIL" },
			{ "data": "SOC_TELEFONO" },
			{ "data": "SOC_FECHA_REGISTRO" },
			{
				"data": "SOC_ESTADO",
				render: function (data, type, row) {
					var status = (row.SOC_ESTADO == 1) ? 'Usuario activo' : (row.SOC_ESTADO == 2) ? '<code>Cambiar contraseña</code>' : '<code>Usuario inactivo</code>';
					return status;
				}
			},
			{
				"data": "SOC_ID",
				"render": function (data, type, row, meta) {
					let cookie_id_user = getCookie('id_user');
					let deshabilitado = "";
					if (row.local == cookie_id_user) {
						deshabilitado = "d-none";
					}
					let buttons = `<a href=" ${SERVER_URL}updatePartner/${encode_b64(data)}/" class="mod_Lista_de_Socios btn btn-default btn_datatable">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="#" class="btn btn-default btn_datatable delete_labour btn-delete del_Lista_de_Socios ${deshabilitado}" >
										<i class="fa fa-trash"></i>
									</a>`;
					return buttons;
				}
			}
		],
		"language": idioma_espanol,
		dom: "<'row'<'form-inline' <'col-sm-offset-5 exp_Lista_de_Socios'B>>>"
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
	id_eliminar_partners("#dt_data_partners tbody", table);

}

var id_eliminar_partners = function (tbody, table) {

	$(tbody).on("click", "a.btn-delete", function () {

		var data = table.row($(this).parents("tr")).data();
		//console.log(data.SOC_ID);

		var id_labour = data.SOC_ID;
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
				url: SERVER_API + 'Partners/deletePartner/' + encode_b64(data.SOC_ID),
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

	