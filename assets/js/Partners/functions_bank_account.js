$('document').ready(function (e) {

	$('#container_partner').hide();
	$('#bank').prop('disabled', true);
	$('#typeAccount').prop('disabled', true);
	$('#numberAccount').prop('disabled', true);
	$('#btn_save_account').prop('disabled', true);

	//cargar datos en los select2
	load_select_index_excluyent();
	load_select_type_banks();
	load_select_type_accounts();

	$("#sponserBankAccount").change(function () {

		reset_select('#bank');
		$('#bank').prop('disabled', false);
		reset_select('#typeAccount');
		$('#numberAccount').val('');

		if ($(this).val() == 0) {
			$('#bank').prop('disabled', true);
		}

		$("#bank").change(function () {
			reset_select('#typeAccount');
			$('#typeAccount').prop('disabled', false);
			if ($(this).val() == 0) {
				$('#typeAccount').prop('disabled', true);
			}
		});

		$("#typeAccount").change(function () {
			$('#numberAccount').prop('disabled', false);
			if ($(this).val() == 0) {
				$('#numberAccount').prop('disabled', true);
				$('#numberAccount').val('');
			}
		});

		$('#numberAccount').keydown(function () {
			$('#btn_save_account').prop('disabled', false);
			if ($(this).val() == "") {
				$('#btn_save_account').prop('disabled', true);
			}
		});

		$('#numberAccount').blur(function () {
			$('#btn_save_account').prop('disabled', false);
			if ($(this).val() == "") {
				$('#btn_save_account').prop('disabled', true);
			}
		});

		$("#sponserBankAccount option:selected").each(function () {
			soc_id = $(this).val();
			$('#container_partner').show();
			$.post(SERVER_API + "BankAccounts/get_Data_Partner/", { soc_id: soc_id }, function (data) {
				var data_server = $.parseJSON(data);
				//muestra los datos de las cuentas registradas
				if (data_server.data.result_data == 1) {
					$("#container_partner").html(data_server.data.html);
					get_list_users();
				} else {
					$("#container_partner").html(data_server.data.html);
				}
			});
		});
	})
	
	// cargar datos en el modal
	$('#dataUpdate').on('shown.bs.modal',  function (event) {
		//load select bank
		$(this).find('#bank').each(function () {
			var dropdownParent = $('#dataUpdate');
			if ($(this).parents('#dataUpdate.in:first').length !== 0)
				dropdownParent = $(this).parents('#dataUpdate.in:first');
			$(this).select2({
				placeholder: 'SELECCIONE',
				ajax: {
					url: SERVER_API + 'BankAccounts/get_type_banks/',
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						console.log(params.term);
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
		});

		//load select type account
		$(this).find('#typeAccount').each(function () {
			var dropdownParent = $('#dataUpdate');
			if ($(this).parents('#dataUpdate.in:first').length !== 0)
				dropdownParent = $(this).parents('#dataUpdate.in:first');
			$(this).select2({
				placeholder: 'SELECCIONE',
				ajax: {
					url: SERVER_API + 'BankAccounts/get_type_accounts/',
					type: "post",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						console.log(params.term);
						return {
							searchTerm: params.term // search term
						};
					},
					processResults: function (response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
		});

		data_status_Account = [{ id: "1", text: "AUTORIZADO" }, { id: "0", text: "NO AUTORIZADO" }]
		
		$('#StatusAccount').select2({data : data_status_Account});
		
		var button 				= $(event.relatedTarget) // Botón que activó el modal
		var id 					= button.data('id') // Extraer la información de atributos de datos
		var number_account 		= button.data('number_account') // Extraer la información de atributos de datos
		
		var data_bank = {
			id: button.data('bank_id'),
			name: button.data('bank_name')
		};
		var data_type_account = {
			id: button.data('type_account_id'),
			name: button.data('type_account_name')
		};
		
		var data_status = {
			id: button.data('status_id'),
			name: button.data('status_name'),
		};

		var modal = $(this)
		modal.find('.modal-title').text('Modificar cuenta: ' + button.data('bank_name') + ' - ' + number_account )
		modal.find('.modal-body #CUE_ID').val(id)
		modal.find('.modal-body #numberAccount').val(number_account)
		
		// Set the value, creating a new option if necessary
		if ($('.bank_modal').find("option[value='" + data_bank.id + "']").length) {
			$('.bank_modal').val(data_bank.id).trigger('change');
		} else {
			// Create a DOM Option and pre-select by default
			var newOption = new Option(data_bank.name, data_bank.id, true, true);
			// Append it to the select
			$('.bank_modal').append(newOption).trigger('change');
		}

		if ($('.type_account_modal').find("option[value='" + data_type_account.id + "']").length) {
			$('.type_account_modal').val(data_type_account.id).trigger('change');
		} else {
			var newOption = new Option(data_type_account.name, data_type_account.id, true, true);
			$('.type_account_modal').append(newOption).trigger('change');
		}

		if ($('.StatusAccount_modal').find("option[value='" + data_status.id + "']").length) {
			$('.StatusAccount_modal').val(data_status.id).trigger('change');
		} else {
			var newOption = new Option(data_status.name, data_status.id, true, true);
			$('.StatusAccount_modal').append(newOption).trigger('change');
		}

		$(document).on('click', '.swal2-confirm', function (event) {
			event.preventDefault();
			
			$.post(SERVER_API + "BankAccounts/get_Data_Partner/", { soc_id: soc_id }, function (data) {
				var data_server = $.parseJSON(data);
				
				if (data_server.data.result_data == 1) {
					$('#dataUpdate').modal('hide');
					$("#container_partner").html(data_server.data.html);
					get_list_users();
					$('.page-header-fixed').css('padding-right','0');
				}
			})
		});
	})
});

function load_select_index_excluyent (){
	$("#sponserBankAccount").select2({
		placeholder: 'SELECCIONE',
		ajax: {
			url: SERVER_API + 'Partners/index_excluyent/1',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				console.log(params.term);
				return {
					searchTerm: params.term // search term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});
}
function load_select_type_banks (){
	$("#bank").select2({
		placeholder: 'SELECCIONE',
		ajax: {
			url: SERVER_API + 'BankAccounts/get_type_banks/',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				console.log(params.term);
				return {
					searchTerm: params.term // search term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});
}
function load_select_type_accounts (){

	$("#typeAccount").select2({
		placeholder: 'SELECCIONE',
		ajax: {
			url: SERVER_API + 'BankAccounts/get_type_accounts/',
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				console.log(params.term);
				return {
					searchTerm: params.term // search term
				};
			},
			processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
	});
}

function reset_select(id_selector){
	$(id_selector).val('');
	$(id_selector).trigger('change');
}

 
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

	var table = $('#dt_data_partners_accounts').DataTable({
		"destroy" : true,
		"ajax": SERVER_API + "BankAccounts/get_list_partners_accounts/" + soc_id,
		"columns": [
			{ "data": "BAN_DESCRIPCION" },
			{ "data": "TIP_DESCRIPCION" },
			{ "data": "CUE_NUMERO_CUENTA" },
			{
				"data": "CUE_ESTADO",
				render: function (data, type, row) {
					var addres = (row.CUE_ESTADO == 1) ? '<span class="alert alert-success"> AUTORIZADO</span>' : '<span class="alert alert-danger-aut">NO AUTORIZADO</span>';
					return addres;
				}
			},
			{
				"data": "CUE_ID",
				"render": function (data, type, row, meta) {
				
					let status_name = (row.CUE_ESTADO == 1) ? "AUTORIZADO" : " NO AUTORIZADO";

					let buttons = `<a data-toggle="modal" data-target="#dataUpdate" data-id="${row.CUE_ID}" data-bank_id="${row.BAN_ID}" data-bank_name="${row.BAN_DESCRIPCION}" data-type_account_id="${row.TIP_ID}" data-type_account_name="${row.TIP_DESCRIPCION}" data-number_account="${row.CUE_NUMERO_CUENTA}" data-status_id="${row.CUE_ESTADO}" data-status_name="${status_name}" class="btn btn-default btn_datatable openBtnModal"><i class="fa fa-pencil"></i></a>
					<a href="#" class="btn btn-default btn_datatable delete_labour btn-delete del_Usuarios" >
						<i class="fa fa-trash"></i>
					</a>`;
					return buttons;
				}
			}
		],
		"language": idioma_espanol,
	});
	id_eliminar_user("#dt_data_partners_accounts tbody", table);

}

var id_eliminar_user = function (tbody, table) {

	$(tbody).on("click", "a.btn-delete", function () {

		var data = table.row($(this).parents("tr")).data();
		//console.log(data.USU_ID);

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
				url: SERVER_API + 'BankAccounts/deletePartnerAccount/' + encode_b64(data.CUE_ID),
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {

					console.log(data);
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
							get_list_users();
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

var idioma_espanol = {
	"sProcessing": "Procesando...",
	"sLengthMenu": "Mostrar _MENU_ registros",
	"sZeroRecords": "No se encontraron resultados",
	"sEmptyTable": "Ningún dato disponible en esta tabla =(",
	"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix": "",
	"sSearch": "Buscar:",
	"sUrl": "",
	"sInfoThousands": ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst": "Primero",
		"sLast": "Último",
		"sNext": "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	},
	"buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	}
};
