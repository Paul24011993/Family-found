(function($) {
	
	//mayuscula("input[type=text]");  
	
	//$('.select2').select2();
	
	// Fucntion to get current date
	Date.prototype.toDateInputValue = (function() {
		var local = new Date(this);
		local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
		return local.toJSON().slice(0,10);
	});
	
	/*$( ".datepicker" ).datepicker({
		dateFormat: 'yy-mm-dd'
	}).datepicker('setDate',new Date());
	
	$( ".datepicker_update" ).datepicker({
		dateFormat: 'yy-mm-dd'
	});*/
	
	$('#price').on('keyup', function() {
		var valid = /^\d{0,10}(\.\d{0,2})?$/.test( this.value.replace('.', '') ),
        val = this.value.replace('.', '');
		if( !valid ) {
			// invalid input, erase character
			this.value = val.substring(0, val.length-1);
			} else if( val.length > 2 ) {
			// valid input, set decimal point if string is longer than 3 characters
			this.value = val.substring(0,val.length-2)+"."+val.substring(val.length-2);
		}
	});
	
	if ($('#main').length) {
		//groupPartners();
	}
	
	
})(jQuery);
 


//Load menu side bar
$('document').ready(function(e) {
	

	
	$('[data-toggle="tooltip"]').tooltip();
	
	$("#prov").change(function () {
		$('#parro').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
		
		$("#prov option:selected").each(function () {
			var prov_id = $(this).val();
			$.post(SERVER_API + "Users/get_cant/", { prov_id: prov_id }, function(data){
				$( "#cant" ).prop( "disabled", false );
				$("#cant").html(data);
			});            
		});
	})
	
	$("#cant").change(function () {
		$("#cant option:selected").each(function () {
			cant_id = $(this).val();
			$.post(SERVER_API + "Users/get_parro/", { cant_id: cant_id }, function(data){
				$( "#parro" ).prop( "disabled", false );
				$("#parro").html(data);
			});            
		});
	})
	
	
	$("#container_partner_credit").hide();
	
	$("#sponserCredit").change(function () {
		$("#sponserCredit option:selected").each(function () {
			soc_id = $(this).val();
			$.post(SERVER_API + "ApplyCredits/get_data_credit/", { soc_id: soc_id }, function(data){
				if (soc_id == 0){
					$("#container_partner_credit").hide();
				}else{
					var data_server = $.parseJSON(data).data;
					$("#container_partner_credit").show();
					$('#dni_credit').val(data_server.SOC_DNI).prop("disabled", true);
					$('#names_credit').val(data_server.SOC_NOMBRES + ' ' + data_server.SOC_APELLIDOS).prop("disabled", true);
				}
			});

			//cargar y llenar el select de cuentas bancarias
			$.post(SERVER_API + "ApplyCredits/get_accounts_banks_partner/", { soc_id: soc_id }, function (data_account) {
				var data_server_data_account = $.parseJSON(data_account).data;
				//console.log(data_server_data_account);				
				$("#name_bank option").find('option').remove();

				$.each(data_server_data_account, function (key, registro) {
					$("#name_bank").append('<option value=' + registro.CUE_ID + '>' + registro.BAN_DESCRIPCION + ' - ' + registro.TIP_DESCRIPCION + ' - ' + registro.CUE_NUMERO_CUENTA + ' </option>');
				});
				
				$("#name_bank option:nth-child(1)").attr('selected', 'selected');

				$("#name_bank").change(function () {
					$("#name_bank option:selected").each(function () {
						soc_id = $(this).val();
						$(".btn_add_account_banck").remove();
						//console.log('the valeu is :' + soc_id);
						$("#name_bank").after('<button type="button" onclick="load_data_table(' + soc_id +')"  class="btn yellow mt-2 btn_add_account_banck">Agregar</button>');
						});
					});
			});

			//cargar y llenar el select de garantes
			$.post(SERVER_API + "ApplyCredits/get_guarantors/", { soc_id: soc_id }, function (guarantors) {
				var data_server_data_guarantors = $.parseJSON(guarantors).data;
				console.log(data_server_data_guarantors);
				//limpiar el select para cargar nuevos datos
				$("#guarantors").empty();
				//$("#guarantors option").find('option').remove();
				$("#guarantors").append('<option value="0">SELECCIONE</option>');
				$.each(data_server_data_guarantors, function (key, registro) {
					$("#guarantors").append('<option value=' + registro.SOC_ID + '>' + registro.SOC_NOMBRES + ' ' + registro.SOC_APELLIDOS + ' - ' + registro.SOC_DNI + ' </option>');
				});
				
				$("#guarantors option:nth-child(1)").attr('selected', 'selected');
				
				$("#guarantors").change(function () {
					$("#guarantors option:selected").each(function () {
						soc_id = $(this).val();
						$(".btn_add_account").remove();
						//console.log('the valeu is :' + soc_id);
						$("#guarantors").after('<button type="button" onclick="load_data_guarantors(' + soc_id +')"  class="btn yellow mt-2 btn_add_account">Agregar</button>');
						});
					});
			});
		});
	})
	

	//multistep form
	/*var current = 1, current_step, next_step, steps;
	steps = $("fieldset").length;

	
	// Custom method to validate username
/*	$.validator.addMethod("usernameRegex", function (value, element) {
		return this.optional(element) || /^[a-zA-Z0-9]*$/i.test(value);
	}, "Username must contain only letters, numbers");

	//validar select 
	$.validator.addMethod("valueNotEquals", function (value, element, arg) {
		// I use element.value instead value here, value parameter was always null
		return arg != element.value;
	}, "Value must not equal arg.");

	$(".next").click(function () {
		
		var form = $("#regiration_form");
		form.validate({
			debug: true,
			errorElement: 'span',
			errorClass: 'help-block',
			highlight: function (element, errorClass, validClass) {
				$(element).closest('.form-group').addClass("has-error");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass("has-error");
			},
			rules: {
				dni_credit: {
					required: true,
					maxlength: 10,
				},
				names_credit: {
					required: true,
					usernameRegex: true,
				},
				name_bank: {
					valueNotEquals: "0",
				},
				guarantors: {
					valueNotEquals: "0",
				},
				/*

				password: {
					required: true,
				},
				conf_password: {
					required: true,
					equalTo: '#password',
				},
				company: {
					required: true,
				},
				url: {
					required: true,
				},
				name: {
					required: true,
					minlength: 3,
				},
				email: {
					required: true,
					minlength: 3,
				},
*/
		/*	},
			messages: {
				dni_credit: {
					required: "Este campo es obligatorio",
				},
				names_credit: {
					required: "Este campo es obligatorio",
				},
				name_bank: {
					valueNotEquals: "Seleccione una Institución Financiera"
				},
				guarantors: {
					required: "Username required",
					valueNotEquals: "Seleccione una referencia"
				},
/*
				password: {
					required: "Password required",
				},
				conf_password: {
					required: "Password required",
					equalTo: "Password don't match",
				},
				name: {
					required: "Name required",
				},
				email: {
					required: "Email required",
				},*/
			/*}
		});
		if (form.valid() === true) {
			if ($('#account_information').is(":visible")) {
				current_fs = $('#account_information');
				next_fs = $('#company_information');
			} else if ($('#company_information').is(":visible")) {
				current_fs = $('#company_information');
				next_fs = $('#personal_information');
			}
/*
			next_fs.show();
			current_fs.hide();*/
			
		/*	current_step = $(this).parent();
			next_step = $(this).parent().next();
			next_step.show('fast');
			current_step.hide('fast');
			setProgressBar(++current);
		}



	});
	$(".previous").click(function () {
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show('fast');
		current_step.hide('fast');
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep) {
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width", percent + "%")
			.html(percent + "%");
	}
*//*
	$('#example').DataTable();
	
	
	//Load data table users
	get_list_users();
	
	//Load data table profiles
	get_list_profiles();
	
	//Add profiles
	load_profiles();
	
	// Update profiles
	load_profiles_update();
	
	// Update profiles
	get_list_partners();
	
	//Load data table contributions
	get_list_contributions();



	if ($('#container_contributions').length) {
		
		Contribution_thomas();
		without_contribution();
		//generateContributions();
	}

	
});
/**/ 
var generateContributions = function () {
	$('#generateContributions').bootstrapValidator({
		// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		live: 'enabled',
		fields: {
			contribution_thomas: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Socio'
					},
				}
			},
			without_contribution: {
				validators: {
					notEmpty: {
						message: 'Seleccione una marca de vehículo'
					}
				}
			},
		},
		submitHandler: function (validator, form, submitButton) {
			var dataString = $('#generateContributions').serialize();

			//var number_proform = $('#number_proform').val();

			swal({
				title: '¿Estas seguro?',
				text: "Los datos del sistema serán actualizados",
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#03A9F4',
				cancelButtonColor: '#F44336',
				confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',
				cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar!'
			}).then(function () {
				$.ajax({
					type: "POST",
					url: SERVER_API + 'Proforms/updateProform/' + number_proform,
					data: dataString,
					success: function (datos) {

						var data_server = $.parseJSON(datos);

						if (data_server.type == 'error') {
							swal(
								"Ocurrio un error",
								data_server.data.message,
								data_server.type
							);
						} else {
							swal(
								"Registro ingresado",
								data_server.data.message,
								data_server.type
							);

							if (tipo == 'save') {
								$('.FormularioAjax')[0].reset();
							}
						}

						//console.log('ok '+dataString);
						//open_Proform(SERVER_API + 'Proforms/updateProform/'+dataString, 'Proforma N. '+$('#number_proform').val(), '', '1024', '768', 'true');
						//validator.defaultSubmit();
					}
				});
			});
		}
	});
}


/*
function Contribution_thomas(params) {
	$("#contribution_thomas").change(function () {
		$("#contribution_thomas option:selected").each(function () {
			soc_id = $(this).val();
			if (soc_id == 0) {
				$("table.table_contribution_thomas").hide();
				$('#apport_thomas').val();
				$('.btn_remove_row').click();

			} else {
				$("#id_hide").val(soc_id);
				$('table.table_contribution_thomas').show();
				var tbHtml = '';
				$.post(SERVER_API + "Contributions/get_data_to_table/", { soc_id: soc_id }, function (data) {
					var get_data_to_table = $.parseJSON(data).data;
					console.log(get_data_to_table);
					
					$.each(get_data_to_table, function (key, registro) {
						var id = $("#id_hide").val();
						if (checkId(id)) {
							return alert('El Socio ya se encuentra en la lista');
						}

						tbHtml += ` <tr>
							<th for="id">${registro.SOC_ID}<input type="hidden" name="id_apport_thomas[]" value="${registro.SOC_ID}"></th>
							<th >${registro.SOC_NOMBRES + ` ` + registro.SOC_APELLIDOS}</th>
							<th class="text-center">
								<div class="input-group"><span class="input-group-addon">$</span>
									<input class="form-control" type="number"  value="${registro.APO_CUOTA_EXTRA}" required name="apport_thomas[]" id="apport_thomas" min="0" step="1.00">
									<span class="input-group-addon">.00</span>
								</div>
								<span class="help-block">`;
										if (parseInt(registro.APO_CUOTA_EXTRA) > 0) {
											tbHtml += `El socio cuenta con un aporte extra de $${registro.APO_CUOTA_EXTRA} si desea aumentar o reducir el aporte ingrese el valor total en el cuadro de texto `;
										}
								tbHtml += `</span>
							</th>
							<th class="text-center"><button class="btn btn-danger btn-circle btn_remove_row" type="button"><i class="fa fa-times"></i> </button></th>
						</tr>`;
					});
					$('table.table_contribution_thomas tbody').prepend(tbHtml);
				});
			}
		});
	})

	// evento para eliminar la fila
	$("table.table_contribution_thomas").on("click", ".btn_remove_row", function () {
		$(this).parents("tr").remove();
	});
}

function checkId(id) {
	let ids = document.querySelectorAll('table.table_contribution_thomas th[for="id"]');
	return [].filter.call(ids, td => td.textContent === id).length === 1;
}

function without_contribution(params) {
	$("#without_contribution").change(function () {
		$("#without_contribution option:selected").each(function () {
			soc_id = $(this).val();
			var tbHtml = '';
			if (soc_id == 0) {
				$(".table_without_contribution").hide();
				$('.note-warning-multa').hide();
				$('input[type=radio]').prop('checked', false);
				//$('#observation_contribution').prop('disabled', false);
			} else {
				$('#observation_contribution').prop('disabled', true);
				$('.table_without_contribution').show();
				$('.note-warning-multa').show();
				
				console.log(soc_id);
				$.post(SERVER_API + "Contributions/get_multa_partner/", { soc_id: soc_id }, function (data) {
					var get_multa_partner = $.parseJSON(data).data;
					console.log(parseInt(get_multa_partner.APO_MULTA));
					tbHtml += `<div class="note note-danger">
									<h4 class="block">El Socio Seleccionado ya registra una multa</h4>
								</div>`;

					if (parseInt(get_multa_partner.APO_MULTA) > 0) {
						$('#notice_multa').empty();
						$('#notice_multa').append(tbHtml);
					}else{
						$('#notice_multa').empty();
					}

					
				});




			}
			$('input.iCheck').on("click", function () {
				$('#observation_contribution').prop('disabled', true);
				$('#observation_contribution').empty();
				$('#observation_contribution').val('');
				if ($(this).val() !== 4){
					$('#observation_contribution').prop('disabled', false);
				}
			});
		});
	})

	// evento para eliminar la fila
	$("table.table_without_contribution").on("click", ".btn_remove_row", function () {
		$(this).parents("tr").remove();
	});
}

// evento para eliminar la fila
$("#tabla").on("click", ".del", function(){
	$(this).parents("tr").remove();
});

function load_data_table(id) {
	
	$('table.load_table_test').show();

	var tbHtml = '';
	$.post(SERVER_API + "ApplyCredits/get_accounts_banks_partner_table/", { soc_id: id }, function (data_account) {
		var data_server_data_account = $.parseJSON(data_account).data;
		
		$.each(data_server_data_account, function (key, registro) {
			//console.log(id + registro.BAN_DESCRIPCION);
			//$("table.load_table_test tbody").append('<td>' + registro.BAN_DESCRIPCION + '</td>');
			tbHtml += ` <tr>
			<th scope='row'>${registro.BAN_DESCRIPCION}</th>
			<th scope='row'>${registro.TIP_DESCRIPCION}</th>
			<th scope='row'>${registro.CUE_NUMERO_CUENTA}</th>
			</tr>`;
		});
		
		$('table.load_table_test tbody').empty();
		$('table.load_table_test tbody').append(tbHtml);

	});
}

function load_data_guarantors(id) {
	
	$('table.load_table_guarantors').show();

	var tbHtml = '';
	
	$.post(SERVER_API + "ApplyCredits/get_accounts_banks_partner_guarantors/", { soc_id: id }, function (data_account_guarantors) {
		var data_server_data_account_guarantors = $.parseJSON(data_account_guarantors).data;
		
		$.each(data_server_data_account_guarantors, function (key, registro) {
			tbHtml += ` <tr>
			<th scope='row'>${registro.SOC_NOMBRES}</th>
			<th scope='row'>${registro.SOC_APELLIDOS}</th>
			<th scope='row'>${registro.SOC_DNI}</th>
			</tr>`;
			
		});
		
		$('table.load_table_guarantors tbody').empty();
		$('table.load_table_guarantors tbody').append(tbHtml);

	});
}

function test7(id) {
	let test = $('#val_account').val();
	$('.modal-body').load(SERVER_URL+ "views/contents/get_account_modal.php?id=" + id, function () {
		$('#exampleModal').modal({ show: true });
//		alert(id);
	});
}


function mayuscula(campo) {
	$(campo).keyup(function () {
		$(this).val($(this).val().toUpperCase());
	});
}

function minuscula(campo) {
	$(campo).keyup(function () {
		$(this).val($(this).val().toLowerCase());
	});
}

//******* users ******/
/*
var get_list_contributions = function () {
	var table = $('#dt_data_contributions').DataTable({
		//"destroy" : true,
		"ajax": SERVER_API + "Contributions/",
		"columns": [
			{
				"data": "SOC_NOMBRES",
				render: function (data, type, row) {
					return row.SOC_NOMBRES + ' ' + row.SOC_APELLIDOS;
				}
			},
			{
				"data": "APO_CUOTA",
				"className" : 'text-right',
				render: function (data, type, row) {
					return '$' + row.APO_CUOTA;
				}
			 },
			{
				"data": "APO_CUOTA_THOMASITO",
				"className": 'text-right',
				render: function (data, type, row) {
					return '$' + row.APO_CUOTA_THOMASITO;
				}
			},
			{
				"data": "APO_CUOTA_EXTRA",
				"className": 'text-right',
				render: function (data, type, row) {
					return '$' + row.APO_CUOTA_EXTRA;
				}
			},
			{
				"data": "APO_MULTA",
				"className": 'text-right',
				render: function (data, type, row) {
					return '$' + row.APO_MULTA;
				}
			},
			
			{ "data": "APO_MULTA_DESCRIPCION" },
			{ "data": "APO_FECHA_APORTES" },
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
}

//******* end users ******/










/*

var idioma_espanol = {
    "sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla =(",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	},
	"buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	}
};

	var archivo = document.getElementById("image");
	

// Create the chart
var options = {
	chart:{
		renderTo: 'container',
		type: 'column',
		events: {
			drilldown: function(e) {
			
			/*if (!e.seriesOptions) {

                        var chart = this;
                            //calling ajax to load the drill down levels
                            chart.showLoading('Simulating Ajax ...');
                            $.get(SERVER_API + 'Dashboards/get_proforms_highCharts/' + e.point.name, function(data) {
                                chart.hideLoading();
								console.log(data);
                                chart.addSeriesAsDrilldown(e.point, $.parseJSON(data));
                            });
                    }*/
				/*var drilldown = {
					series: []
				};
				var chart = this;
				var item, drilldown, s2;
				// Show the loading label
				chart.showLoading('Simulating Ajax ...');
				
				$.get(SERVER_API + 'Dashboards/get_proforms_highCharts/'+e.point.name, function(data) {
					
					 //console.log(data );
					//var data_server = $.parseJSON(data);
					
					
					/*	var json = $.parseJSON(data);
						$(json.data).each(function(i,val){
						$.each(val,function(k,v){
						var item2 = json.data[i];
						var total = parseFloat(item2.total)
						console.log(k + ' ' +v+ ' ' + e.point.name);
						drilldown.series.push({
						"name": e.point.name,
						"id": e.point.name,
						"data": [{name: item2.PROF_FECHA_EMISION, y: total}]
						});     
						});
					});*/
					//chart.addSingleSeriesAsDrilldown(e.point, s2);
					 
					
			 
				/*for(var i =0;i <= data.length-1;i++){
						var item = data[i];
						
						var numb = parseFloat(item.y);
						var texto = item.name;
						
						var s2= {
						id: e.point.name,
						name: e.point.name,
						data: data
						} 
						 
						//console.log(data );
					}
					chart.hideLoading();
					chart.addSingleSeriesAsDrilldown(e.point, s2);
					chart.applyDrilldown();
					
				});
			}
		}
	},
	series: [],
	drilldown: {}
};
$.getJSON(SERVER_API + 'Dashboards/get_proforms/', function(data){
	
	for(var i =0;i <= data.length-1;i++){
		var item = data[i];
		options.series.push({
			"type": "column",
			"name": item.name,
			"data": [{name: item.name, y: parseFloat(item.y), drilldown: item.name}]
		});
	}
	
	var chart = new Highcharts.Chart(options);*/
});


