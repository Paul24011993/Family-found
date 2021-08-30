$(document).ready(function(){
	//$('#price, #tax').on('keyup change paste', function() {
	$('.FormularioAjax').submit(function(e){
	 
        e.preventDefault();
		
        var form = $(this);
		
        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');
		
        var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
		
		
        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
			}else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
			}else if(tipo==="update"){
        	textoAlerta="Los datos del sistema serán actualizados";
			}else if(tipo==="create"){
        	textoAlerta="Continuar con la creación del documento";
			}else{
            textoAlerta="Quieres realizar la operación solicitada";
		}
		
        swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
			}).then(function () {
            $.ajax({
                type: metodo,
                url: SERVER_API + accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							percentComplete = parseInt(percentComplete * 100);
							if(percentComplete<100){
								respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
								}else{
								respuesta.html('<p class="text-center"></p>');
							}
						}
					}, false);
					return xhr;
				},
				success: function (data) {
					//console.log(data);
					var data_server = $.parseJSON(data);
					respuesta.html(data_server); 
					
					//console.log(data_server);
					if(data_server.type == 'error'){
						swal(
							"Ocurrio un error",
							data_server.data.message,
							data_server.type
						);
					}else{
						if(tipo == 'save'){
							swal(
								"Registro ingresado",
								data_server.data.message,
								data_server.type
							);
						
							//para acutalizar los aportese xtras de socios
							if ($('#container_contributions').length) {
								location.reload();
							}
							
							if ($('.ver_Cuentas_bancarias').length) {
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
							}
								//return false;
							$('.FormularioAjax')[0].reset();

						/*	$(".FormularioAjax select").each(function() { this.selectedIndex = 0 });
							$(".FormularioAjax input[type=text] , form textarea").each(function() { this.value = '' });*/
						}
						if (tipo == 'update') {
							swal(
								"Registro actualizado",
								data_server.data.message,
								data_server.type
							);
						}
						
					}
					
					$('.respuesta-validacion-correo').removeClass('has-success');
					$('.respuesta-validacion-cedula').removeClass('has-success');
					$(".respuesta-val-input-cedula").html("");
					$(".respuesta-val-input-correo").html("");
				},
				error: function() {
					$('.RespuestaAjax').html(msjError);
				}
			});
			return false;
		});
	});
	
	
	
});

 








