$(document).on("ready", function(){
	
	//$(".select2_update").prop("disabled", true);///
	
	$( ".button_detail" ).click(function() {
		var brand  			= $("#brand").val();
		var type 			= $(this).data("type");
		var detail 			= $(this).data("detail");
		var number_proform 	= $('#number_proform').val();
		
		var field_data;
		
		$('#dt_data_proforms_details_filter label input').focus();
		if(detail == 'repuestos'){
			$('#agregar_detalle').on('shown.bs.modal', function(event) {
				$('#agregar_detalle').find('.modal-title').text('Lista de repuestos')
				$('#rep').focus();
			});
			
			var field_data = ["REP_ID", "REP_DESCRIPCION", "REP_PRECIO", "REP_ESTADO"];
		}
		
		if(detail == 'lubricantes'){
			$('#agregar_detalle').on('shown.bs.modal', function(event) {
				$('#agregar_detalle').find('.modal-title').text('Lista de lubricantes')
				$('#rep').focus();
			});
			var field_data = ["LUB_ID", "LUB_DESCRIPCION", "LUB_PRECIO", "LUB_ESTADO"];
		}
		
		if(detail == 'mano_obra'){
			$('#agregar_detalle').on('shown.bs.modal', function(event) {
				$('#agregar_detalle').find('.modal-title').text('Lista de mano de obra')
				$('#rep').focus();
			});
			var field_data = ["MAN_ID", "MAN_DESCRIPCION", "MAN_PRECIO", "MAN_ESTADO"];
		}
		
		
		if(type == 'proforma_tmp'){
			detail_dataTable(brand, detail,field_data, 'proforma_tmp', number_proform);
			}else{
			detail_dataTable(brand, detail,field_data, 'proforma', number_proform);
		}
		
	});
	$("#load_detail_proform_tmp").load("../views/modules/detail_proform_tmp.php");
	
	// Cargar detalle de laproforma
	$("#load_detail_proform").load("../views/modules/detail_proform.php?views="+getCookie("PROF_NUMERO_DOCUMENTO"));
	
	//Validar formato de campos de la cabecera de la proforma
	validator_form_detail_tmp();
	
	//actualizar los datos de la cabecera de la proforma
	update_header_proform();
	
	//actualizar los datos de la cabecera de la proforma
	update_header_act();
	
	
	//Load data table proforms
	get_list_proforms();
	
	// Carrousel de imagenes de actas de entrega
	carrousel_act();
	
});

//******* proforms ******/

var get_list_proforms = function(){
	var table_proforms = $('#dt_data_proforms').DataTable({
		//"destroy" : true,
		"ajax": SERVER_API + "Proforms/",
		"columns": [
			{ "data": "PROF_ID", 
				"render": function ( data, type, row, meta ) {
					return '<a href="'+SERVER_URL+'createCertificated/'+btoa(btoa(btoa(data)))+'" class="add_Empresas_Publicas btn btn-default btn_datatable"><i class="fa fa-file"></i> Crear acta</a>';
				}
			},
			{ "data": "PROF_NUMERO_DOCUMENTO" },
			{ "data": "PROF_FECHA_EMISION" },
			{ "data": "USU_NOMBRES",
				"render" : function(data, type, row, meta){
					var full_name = row.USU_NOMBRES +' '+row.USU_APELLIDOS; 
					return full_name;
				}
			},
			{ "data": "MAR_DESCRIPCION" },
			{ "data": "PROF_PLACA" },
			{ "data": "PROF_VALOR_TOTAL",
				"render" : function(dara, type, row, meta){
					var format_price = '$ ' + row.PROF_VALOR_TOTAL; 
					return format_price;
				}
			},
			
			{ "data": "PROF_ID", 
				"render": function ( data, type, row, meta ) {
					
					var aux = "'"+(row.PROF_NUMERO_DOCUMENTO).toString()+"'";
					
					return '<a href="'+SERVER_URL+'updateProform/'+btoa(btoa(btoa(data)))+'" class="mod_Empresas_Publicas btn btn-default btn_datatable"><i class="fa fa-pencil"></i></a>'+
					'<a href="#" class="btn btn-default btn_datatable" onclick="imprimir_factura('+data+')"><i class="fa fa-eye"> </i></a>'+
					'<a href="#" class="btn btn-default btn_datatable del_Empresas_Publicas" onclick="eliminar('+aux+')"><i class="fa fa-trash"> </i></a>';
				}
				
			}
		],
		"language": idioma_espanol,
		dom: "<'row'<'form-inline' <'col-sm-offset-5 exp_Empresas_Publicas'B>>>"
		+"<'row' <'form-inline' <'col-sm-6 col-md-6 col-lg-6 text-left'l >"
		+" <'col-sm-6 col-md-6 col-lg-6'f>>>"
		+"<rt>"
		+"<'row'<'form-inline'"
		+"<'col-sm-12 col-md-12 col-lg-12'p>>>",//'Bfrtip',
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
	} );
	
	
}

var obtener_id_eliminar = function(tbody, table){
	$(tbody).on("click", "a.deleteOk", function(){
		var data = table.row($(this).parents("tr")).data();
		//console.log(data.MAN_ID);
		//hex_md5(row.MAN_ID)
		var id_labour = data.MAN_ID;
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
				url: SERVER_API +'Labours/deleteLabour/'+btoa(data.MAN_ID),
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					
					var data_server = $.parseJSON(data); 
					
					if(data_server.type == 'error'){
						swal(
						"Ocurrio un error",
						data_server.data.message,
						data_server.type
						);
						}else{
						swal(
						"Registro eliminado",
						data_server.data.message,
						data_server.type
						).then(function(){
							location.reload();
						});
						
					}
				},
				error: function() {
					alert('error');
					$('.RespuestaAjax').html(msjError);
				}
			});
			return false;
		});
		
		
	});
}

//******* end proforms ******/

var detail_dataTable = function(brand, detail, field_data, type_detail_proform, number_proform){
	
	var table_proforms = $('#dt_data_proforms_details').DataTable({
		"destroy" : true,
		"ajax": {
			"url": SERVER_API + 'Proforms/get_details_brans/',
			"type": "POST",
			"data": function(d) {
				d.brand 		= brand;
				d.detail 		= detail;
				d.field_brand 	= field_data[3];
			},
			"global": false,
		},
		"columns": [
			{ "data": field_data[0]}, 
			{ "data": field_data[1]},
			{ "data": field_data[0],
				"render": function(data, type, row, meta){
					var input_number = "<input type='number' class='form-control input-sm input-only-number text-center' id='cantidad_"+data+"'>";
					return input_number;
				}
			},
			{ "data": field_data[0],
				"render": function(data, type, row, meta){
					if(field_data[0] == 'REP_ID'){
						var input_number = "<input type='text' class='form-control text-center' style='text-align:center' id='precio_venta_"+row.REP_ID+"' value='"+row.REP_PRECIO+"' disabled >"+
						"<input type='hidden' value='REP_ID' id='field_data'>";
						}else if(field_data[0] == 'LUB_ID'){
						var input_number = "<input type='text' class='form-control text-center' style='text-align:center' id='precio_venta_"+row.LUB_ID+"' value='"+row.LUB_PRECIO+"' disabled >"+
						"<input type='hidden' value='LUB_ID' id='field_data'>";
						}else{
						var input_number = "<input type='text' class='form-control text-center' style='text-align:center' id='precio_venta_"+row.MAN_ID+"' value='"+row.MAN_PRECIO+"' disabled >"+
						"<input type='hidden' value='MAN_ID' id='field_data'>";
					}
					return input_number;
				}
			},			
			{ "data": field_data[0], 
				"render": function ( data, type, row, meta ) {
					var add_detail_button = "<a class='btn btn-default' href='#' onclick='agregar_detalle_tmp("+ data +")'><i class='glyphicon glyphicon-plus' style='font-size:10px; padding:5px;'></i></a>"+
					"<input type='hidden' value='"+ type_detail_proform +"' id='type_detail_proform'> <input type='hidden' value='"+ number_proform +"' id='number_proform'>";
					return add_detail_button;
				}
			}
		]	
	});
}

function agregar_detalle_tmp(id, field_data) {
    var precio_venta 		= $('#precio_venta_' + id).val();
    var cantidad 			= $('#cantidad_' + id).val();
    var field_type 			= $('#field_data').val();
    var type_detail_proform = $('#type_detail_proform').val();
    var number_proform		= $('#number_proform').val();
	const code_user 		= getCookie("id_user");
	
    //Inicia validacion
    if (isNaN(cantidad)) {
        swal("Error!", "Ingrese un valor numérico válido", "error");
		$('#cantidad_' + id).val('');
        $('#cantidad_' + id).focus();
        return false;
	}
    if (cantidad == '' || cantidad == null) {
        swal("Error!", "Ingresa la cantidad ", "error");
        $('#cantidad_'+id).focus();
        return false;
	}
    if (cantidad <= 0) {
        swal("Error!", "La cantidad debe ser mayor a 0", "error");
        $('#cantidad_' + id).val('');
        $('#cantidad_' + id).focus();
		
        return false;
	}
    if (isNaN(precio_venta)) {
        swal("Error!", "El precio debe ser un número mayor a 0", "error");
        $('#precio_venta_' + id).focus();
        return false;
	}
	if (precio_venta == '' || precio_venta == null) {
        swal("Error!", "Ingresa la cantidad ", "error");
        $('#cantidad_'+id).focus();
        return false;
	}
    if (precio_venta <= 0) {
        swal("Error!", "La cantidad debe ser mayor a 0", "error");
        $('#cantidad_' + id).val('');
        $('#cantidad_' + id).focus();
        return false;
	}
	
    $.ajax({
        type: "POST",
        url: SERVER_API + 'Proforms/add_details_tmp/',
        data: "item_id=" + id + "&price=" + precio_venta + "&quantity=" + cantidad + '&code_user=' + code_user +'&field_type='+field_type+'&type_detail_proform='+type_detail_proform+'&number_proform='+number_proform,
        beforeSend: function(objeto) {
			
			if(type_detail_proform == 'proforma_tmp'){
				$("#load_detail_proform_tmp").html("Cargando...");
				}else{
				$("#load_detail_proform").html("Cargando...");
			}
			
		},
        success: function(datos) {
			if(type_detail_proform == 'proforma_tmp'){
				$("#load_detail_proform_tmp").load("../views/modules/detail_proform_tmp.php");
				}else{
				$("#load_detail_proform").load("../views/modules/detail_proform.php");
			}
		}
	});
}

function eliminar_detalle_tmp(id, type_detail_prof) {
    swal({
        title: '¿Estas seguro?',
        text: "Desea eliminar este item ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar!'
		}).then(function() {
        $.ajax({
            type: "POST",
			url: SERVER_API + 'Proforms/delete_details_tmp/',
            data: "id_eliminar=" + id + "&type_detail_proform=" +type_detail_prof,
            beforeSend: function(objeto) {
                if(type_detail_prof == 'proforma_tmp'){
					$("#load_detail_proform_tmp").html("Cargando...");
					}else{
					$("#load_detail_proform").html("Cargando...");
				}
			},
            success: function(datos) {
                if(type_detail_prof == 'proforma_tmp'){
					$("#load_detail_proform_tmp").load("../views/modules/detail_proform_tmp.php");
					}else{
					$("#load_detail_proform").load("../views/modules/detail_proform.php");
				}
			}
		});
	});
}

var validator_form_detail_tmp = function(){
	$('#creation_date').val(new Date().toDateInputValue());
	$('#proform_data').bootstrapValidator({
		// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		live: 'enabled',
		fields: {
			brand: {
				validators: {
					notEmpty: {
						message: 'Seleccione una marca de vehículo'
					}
				}
				}, plate: {
				validators: {
					notEmpty: {
						message: 'Ingrese la placa del vehículo'
					}
				}
				}, color: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el color del vehículo'
					}
				}
				}, mileage: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el kilometraje del vehículo'
					}
				}
				}, orderATM: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el número de orden'
					}
				}
				}, disc: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el número de disco'
					}
				}
				}, creation_date: {
				validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
					}
				}
			}
		},
		submitHandler: function(validator, form, submitButton) {
			var dataString = $('#proform_data').serialize();
			open_Proform(SERVER_API + 'Proforms/save_proform/'+dataString, 'Proforma N. '+$('#number_proform').val(), '', '1024', '768', 'true');
			validator.defaultSubmit();
		}
	});
}

var update_header_proform = function(){
	$('#update_proform_data').bootstrapValidator({
		// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		live: 'enabled',
		fields: {
			brand: {
				validators: {
					notEmpty: {
						message: 'Seleccione una marca de vehículo'
					}
				}
				}, plate: {
				validators: {
					notEmpty: {
						message: 'Ingrese la placa del vehículo'
					}
				}
				}, color: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el color del vehículo'
					}
				}
				}, mileage: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el kilometraje del vehículo'
					}
				}
				}, orderATM: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el número de orden'
					}
				}
				}, disc: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el número de disco'
					}
				}
				}, creation_date: {
				validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
					}
				}
			}
		},
		submitHandler: function(validator, form, submitButton) {
			var dataString = $('#update_proform_data').serialize();
			
			var number_proform = $('#number_proform').val(); 
			
			swal({
				title: '¿Estas seguro?',
				text: "Los datos del sistema serán actualizados",
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#03A9F4',
				cancelButtonColor: '#F44336',
				confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',
				cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar!'
				}).then(function() {
				$.ajax({
					type: "POST",
					url: SERVER_API + 'Proforms/updateProform/'+number_proform,
					data: dataString,
					success: function(datos) {
						
						var data_server = $.parseJSON(datos);
						
						if(data_server.type == 'error'){
							swal(
							"Ocurrio un error",
							data_server.data.message,
							data_server.type
							);
							}else{
							swal(
							"Registro ingresado",
							data_server.data.message,
							data_server.type
							);
							
							if(tipo == 'save'){
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


function timeToInt(time) {
	var now = new Date();
	var dt = (now.getMonth() + 1) + "/" + now.getDate() + "/" + now.getFullYear() + " " + time;
	var d = new Date(dt);
	//console.log(d);
	return d;
}



function checkDates() {
	if (($('#admission_time').val() == '') || ($('#departure_time').val() == '')) return true;
	
	var start = timeToInt($('#admission_time').val());
	var end = timeToInt($('#departure_time').val());
	//console.log($('#admission_time').val());
	//console.log(start, end);
	if ((start == -1) || (end == -1)) {
		return false;
	}
	
	if (start >= end) {
		return false;
	}
	return true;
}


var update_header_act = function(){
	
	$('#update_header_act').bootstrapValidator({
		
		// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		live: 'enabled',
		fields: {
			admission_time: {
				validators: {
					/*notEmpty: {
						message: 'Selccione la hora de ingreso'
					},*/
					callback: {
						timeFormat: 'HH:ii:SS',
						message: "Selccione la hora de ingreso",
						callback: function(value, validator, $field) {
							return checkDates();
						}
					}
				}
			}, 
			date_delivery: {
				validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Selccione la fecha de entrega'
					}
				}
			}, 
			departure_time: {
				validators: {
					callback: {
						timeFormat: 'HH:ii:SS',
						message: "Seleccione la hora de salida",
						callback: function(value, validator, $field) {
							return checkDates();
						}
					}
				}
			}, 
			internal_order: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el número de órden interna de trabajo'
					}
				}
			}, 
			driver: {
				validators: {
					stringLength: {
						min: 2,
					},
					notEmpty: {
						message: 'Ingrese el nombre del conductor'
					}
				}
			}
		},
		submitHandler: function(validator, form, submitButton) {
			var dataString = $('#update_header_act').serialize();
			//console.log(dataString);
			var number_proform = $('#number_proform').val(); 
			
			swal({
				title: '¿Estas seguro?',
				text: "Los datos del sistema serán actualizados",
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#03A9F4',
				cancelButtonColor: '#F44336',
				confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',
				cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar!'
				}).then(function() {
				$.ajax({
					type: "POST",
					url: SERVER_API + 'Proforms/updateAct/',
					data: dataString,
					success: function(datos) {
						
						var data_server = $.parseJSON(datos);
						
						if(data_server.type == 'error'){
							swal(
							"Ocurrio un error",
							data_server.data.message,
							data_server.type
							);
							}else{
							swal(
							"Registro ingresado",
							data_server.data.message,
							data_server.type
							);
							
							if(tipo == 'save'){
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


// Abrir una ventana con el contenido de la proforma
function open_Proform(theURL, winName, features, myWidth, myHeight, isCenter) { //v3.0
	if (window.screen)
	if (isCenter)
	if (isCenter == "true") {
		var myLeft = (screen.width - myWidth) / 2;
		var myTop = (screen.height - myHeight) / 2;
		features += (features != '') ? ',' : '';
		features += ',left=' + myLeft + ',top=' + myTop;
	}
	window.open(theURL, winName, features + ((features != '') ? ',' : '') + 'width=' + myWidth + ',height=' + myHeight);
}

function imprimir_factura(id_factura){
	open_Proform(SERVER_API + 'Proforms/printProform/'+id_factura,'Proforma','','1024','768','true');
}	

function imprimir_acta(id_factura){
	open_Proform(SERVER_API + 'Proforms/printAct/'+id_factura,'Acta de entrega','','1024','768','true');
}	

function eliminar (number_proform){
	swal({
        title: '¿Estas seguro?',
        text: "Desea eliminar este documento ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        cancelButtonColor: '#F44336',
        confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',
        cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar!'
		}).then(function() {
        $.ajax({
            type: "POST",
			url: SERVER_API + 'Proforms/delete_proform/'+number_proform,
            beforeSend: function(objeto) {
				//$("#dt_data_proforms").html("Cargando...");
			},
            success: function(datos) {
				location.reload();
			}
		});
	});
	
}




window.onload = function () {
	var avatar = document.getElementById('avatar');
	//var image = document.getElementById('image');
	var input = document.getElementById('inputImage');
	var $progress = $('.progress');
	var $progressBar = $('.progress-bar');
	var $alert = $('.alert');
	var $modal = $('#modal');
	var cropper;
	
	var Cropper = window.Cropper;
	var URL = window.URL || window.webkitURL;
	var container = document.querySelector('.img-container');
	var image = container.getElementsByTagName('img').item(0);
	var download = document.getElementById('download');
	var actions;
	actions = document.getElementById('actions');
	
	var inputImage,
	element = document.getElementById('inputImage');
	
	
	
	
	var options = {
		aspectRatio: 16 / 9,
		preview: '.img-preview',
		ready: function (e) {
			//console.log(e.type);
		},
		cropstart: function (e) {
			//console.log(e.type, e.detail.action);
		},
		cropmove: function (e) {
			//console.log(e.type, e.detail.action);
		},
		cropend: function (e) {
			//console.log(e.type, e.detail.action);
		},
		crop: function (e) {
			var data = e.detail;
			
			//console.log(e.type);
		},
		zoom: function (e) {
			//console.log(e.type, e.detail.ratio);
		}
	};
	
	$('[data-toggle="tooltip"]').tooltip();
	
	// Import image
	
	
	//var inputImage = document.getElementById('inputImage');
	
	if (URL) {
		
		if (element != null) {
			if (inputImage ) {
				
				inputImage.onchange = function () {
					$('#content-crop-none').removeClass('d-none');
					var files = this.files;
					var file;
					
					if (cropper && files && files.length) {
						file = files[0];
						
						if (/^image\/\w+/.test(file.type)) {
							uploadedImageType = file.type;
							uploadedImageName = file.name;
							
							if (uploadedImageURL) {
								URL.revokeObjectURL(uploadedImageURL);
							}
							
							image.src = uploadedImageURL = URL.createObjectURL(file);
							cropper.destroy();
							cropper = new Cropper(image, options);
							inputImage.value = null;
							} else {
							swal(
							"Ocurrio un error",
							"Por favor, elija una imagen",	
							"error"
							);
							
							//window.alert('Please choose an image file.');
						}
					}
				};
			}
		}
	} else {
		inputImage.disabled = true;
		inputImage.parentNode.className += ' disabled';
	}
	
	
	
	
	cropper = new Cropper(image, options);
	
	var originalImageURL = image.src;
	var uploadedImageType = 'image/jpeg';
	var uploadedImageName = 'cropped.jpg';
	var uploadedImageURL;
	
	// Tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Buttons
	if (!document.createElement('canvas').getContext) {
		$('button[data-method="getCroppedCanvas"]').prop('disabled', true);
	}
	
	if (typeof document.createElement('cropper').style.transition === 'undefined') {
		$('button[data-method="rotate"]').prop('disabled', true);
		$('button[data-method="scale"]').prop('disabled', true);
	}
	
	// Download
	if (typeof download.download === 'undefined') {
		download.className += ' disabled';
		download.title = 'Your browser does not support download';
	}
	
	// Options
	if (actions != null) {
		actions.querySelector('.docs-toggles').onchange = function (event) {
			var e = event || window.event;
			var target = e.target || e.srcElement;
			var cropBoxData;
			var canvasData;
			var isCheckbox;
			var isRadio;
			
			if (!cropper) {
				return;
			}
			
			if (target.tagName.toLowerCase() === 'label') {
				target = target.querySelector('input');
			}
			
			isCheckbox = target.type === 'checkbox';
			isRadio = target.type === 'radio';
			
			if (isCheckbox || isRadio) {
				if (isCheckbox) {
					options[target.name] = target.checked;
					cropBoxData = cropper.getCropBoxData();
					canvasData = cropper.getCanvasData();
					
					options.ready = function () {
						//console.log('ready');
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					};
					} else {
					options[target.name] = target.value;
					options.ready = function () {
						//console.log('ready');
					};
				}
				
				// Restart
				cropper.destroy();
				cropper = new Cropper(image, options);
			}
		};
		
		// Methods
		actions.querySelector('.docs-buttons').onclick = function (event) {
			var e = event || window.event;
			var target = e.target || e.srcElement;
			var cropped;
			var result;
			var input;
			var data;
			
			if (!cropper) {
				return;
			}
			
			while (target !== this) {
				if (target.getAttribute('data-method')) {
					break;
				}
				
				target = target.parentNode;
			}
			
			if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
				return;
			}
			
			data = {
				method: target.getAttribute('data-method'),
				target: target.getAttribute('data-target'),
				option: target.getAttribute('data-option') || undefined,
				secondOption: target.getAttribute('data-second-option') || undefined
			};
			
			cropped = cropper.cropped;
			
			if (data.method) {
				if (typeof data.target !== 'undefined') {
					input = document.querySelector(data.target);
					
					if (!target.hasAttribute('data-option') && data.target && input) {
						try {
							data.option = JSON.parse(input.value);
							} catch (e) {
							//console.log(e.message);
						}
					}
				}
				
				switch (data.method) {
					case 'rotate':
					if (cropped && options.viewMode > 0) {
						cropper.clear();
					}
					
					break;
					
					case 'getCroppedCanvas':
					try {
						data.option = JSON.parse(data.option);
						} catch (e) {
						//console.log(e.message);
					}
					
					if (uploadedImageType === 'image/jpeg') {
						if (!data.option) {
							data.option = {};
						}
						
						data.option.fillColor = '#fff';
					}
					
					break;
				}
				
				result = cropper[data.method](data.option, data.secondOption);
				
				switch (data.method) {
					case 'rotate':
					if (cropped && options.viewMode > 0) {
						cropper.crop();
					}
					
					break;
					
					case 'scaleX':
					case 'scaleY':
					target.setAttribute('data-option', -data.option);
					break;
					
					case 'getCroppedCanvas':
					if (result) {
						// Bootstrap's Modal
						$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
						
						if (!download.disabled) {
							download.download = uploadedImageName;
							download.href = result.toDataURL(uploadedImageType);
						}
					}
					
					break;
					
					case 'destroy':
					cropper = null;
					
					if (uploadedImageURL) {
						URL.revokeObjectURL(uploadedImageURL);
						uploadedImageURL = '';
						image.src = originalImageURL;
					}
					
					break;
				}
				
				if (typeof result === 'object' && result !== cropper && input) {
					try {
						input.value = JSON.stringify(result);
						} catch (e) {
						//console.log(e.message);
					}
				}
			}
		};
		}
	document.body.onkeydown = function (event) {
		var e = event || window.event;
		
		if (e.target !== this || !cropper || this.scrollTop > 300) {
			return;
		}
		
		switch (e.keyCode) {
			
			// Left arrow
			case 37:
			e.preventDefault();
			cropper.move(-1, 0);
			break;
			
			// Up arrow
			case 38:
			e.preventDefault();
			cropper.move(0, -1);
			break;
			
			// Right arrow
			case 39:
			e.preventDefault();
			cropper.move(1, 0);
			break;
			
			// Down arrow
			case 40:
			e.preventDefault();
			cropper.move(0, 1);
			break;
		}
	};
	
	
	
	
	document.getElementById('crop').addEventListener('click', function () {
		
		var initialAvatarURL;
		var canvas;
		
		if (cropper) {
			canvas = cropper.getCroppedCanvas({
				width: 160,
				height: 160,
			});
			initialAvatarURL = avatar.src;
			avatar.src = canvas.toDataURL();
			$progress.show();
			$alert.removeClass('alert-success alert-warning');
			
			canvas.toBlob(function (blob) {
				var formData = new FormData();
				
				formData.append('avatar_image', blob, 'avatar.jpg');
				var data_url_image = [getCookie("user_name"), getCookie("PROF_NUMERO_DOCUMENTO")];
				
				//console.log(formData);
				
				var name_image_server;
				
				var ajaxObj = {
					type: "POST",
					//url: SERVER_API + 'Proforms/crop_image/'+data_url_image,
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
								$progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
							}
						};
						
						return xhr;
					},
					
					success: function (data) {
						
						var data_server = $.parseJSON(data); 
						
						name_image_server = data_server.data.name_image;
						
						if(data_server.type == 'error'){
							swal(
							"Ocurrio un error",
							data_server.data.message,
							data_server.type
							);
							}else{
							swal(
							"Registro eliminado",
							data_server.data.message,
							data_server.type
							).then(function(){
								//location.reload();
							});
						}
						
						ajaxObj.url = SERVER_URL + 'uploadImageAct/'+btoa(name_image_server)+'/';
						$.ajax(ajaxObj);
						
						
						$('#avatar').removeClass('d-none');
						$('#list-images-server').removeClass('d-none');
						$alert.show().addClass('alert-success').text('Archivo importado corectamente');
					},
					
					error: function () {
						avatar.src = initialAvatarURL;
						$alert.show().addClass('alert-warning').text('Upload error');
					},
					
					complete: function () {
						$progress.hide();
					},
				};
				
				//url1 ajax 
				ajaxObj.url = SERVER_API + 'Proforms/crop_image/'+data_url_image;
				$.ajax(ajaxObj);
				
			});
		}
		//cropper.destroy();
		//cropper = null;
	});
};


$('.clockpicker').clockpicker({
    default: 'now',
	twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
	donetext: 'OK',
	timeFormat:"HH:ii:SS",
	autoclose: true,
	vibrate: true 
});



var carrousel_act = function(){
	$(".regular").slick({
        dots: true
	});
	$(".center").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		centerMode: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	$(".variable").slick({
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		adaptiveHeight: true
	});
};

$('.delete-img-act').on('click', function(e) {
	e.preventDefault();
	var parent = $(this).parent().parent().parent().attr('id');
	var item = $(this).attr('data');
	
	var name_image = $(this).data('image');
	
	var dataString = 'item='+item; 
	
	
	var ajaxObjImg = {
		type: "POST",
		//url: SERVER_API + 'Proforms/delteImageAct/',
		data: dataString,
		success: function(response) {
			$('.alert-success').empty();
			$('.alert-success').append(response).fadeIn("slow");
			$('#'+parent).fadeOut("slow");
		}
	}
	
	
	//url1 ajax 
	ajaxObjImg.url = SERVER_API + 'Proforms/delteImageAct/';
	$.ajax(ajaxObjImg);
	
	ajaxObjImg.url = SERVER_URL + 'deleteImageAct/'+btoa(name_image)+'/';
	$.ajax(ajaxObjImg);
	
	
});     










