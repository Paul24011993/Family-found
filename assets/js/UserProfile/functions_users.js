$('document').ready(function (e) {

	view_all_permissions(['ver_Usuarios', 'add_Usuarios', 'mod_Usuarios', 'del_Usuarios', 'exp_Usuarios'], get_list_users());

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
	
	var table = $('#dt_data_users').DataTable({
		//"destroy" : true,
		"ajax": SERVER_API + "Users/",
		"columns": [
			{ "data": "USU_USUARIO" },
			{ "data": "PRF_DESCRIPCION" },
			{
				"data": "USU_NOMBRES",
				render: function (data, type, row) {
					return row.USU_NOMBRES + ' ' + row.USU_APELLIDOS;
				}
			},
			{ "data": "USU_DNI" },
			{ "data": "USU_EMAIL" },
			{
				"data": "USU_TELEFONO_1",
				render: function (data, type, row) {
					var addres = (row.USU_TELEFONO_2 == null && row.USU_TELEFONO_1 == null) ? 'Sin número de contacto' : (row.USU_TELEFONO_2 == null) ? row.USU_TELEFONO_1 : (row.USU_TELEFONO_1 == null) ? row.USU_TELEFONO_2 : (row.USU_TELEFONO_2 == null) ? row.USU_TELEFONO_1 : row.USU_TELEFONO_1 + ' - ' + row.USU_TELEFONO_2;
					return addres;
				}
			},
			{
				"data": "USU_ACTIVO",
				render: function (data, type, row) {
					var addres = (row.USU_ACTIVO == 1) ? 'Usuario activo' : (row.USU_ACTIVO == 2) ? '<code>Cambiar contraseña</code>' : '<code>Usuario inactivo</code>';
					return addres;
				}
			},
			{
				"data": "USU_ID",
				"render": function (data, type, row, meta) {
					let cookie_id_user = getCookie('id_user');
					let deshabilitado = "";
					if (row.USU_ID == cookie_id_user) {
						deshabilitado = "d-none";
					}
					let buttons = `<a href=" ${SERVER_URL}updateUser/${encode_b64(data)}" class="mod_Usuarios btn btn-default btn_datatable">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="#" class="btn btn-default btn_datatable delete_labour btn-delete del_Usuarios ${deshabilitado}" >
										<i class="fa fa-trash"></i>
									</a>`;
					return buttons;
				}
			}
		],
		"language": idioma_espanol,
		dom: "<'row'<'form-inline' <'col-sm-offset-5 exp_Usuarios'B>>>"
			+ "<'row' <'form-inline' <'col-sm-6 col-md-6 col-lg-6 text-left'l >"
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
	id_eliminar_user("#dt_data_users tbody", table);

}

var id_eliminar_user = function (tbody, table) {

	$(tbody).on("click", "a.btn-delete", function () {

		var data = table.row($(this).parents("tr")).data();
		//console.log(data.USU_ID);

		//hex_md5(row.MAN_ID)
		var id_labour = data.USU_ID;
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
				url: SERVER_API + 'Users/deleteUser/' + encode_b64(data.USU_ID),
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
