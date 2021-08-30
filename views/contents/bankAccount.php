<div class="row wrapper border-bottom page-heading">
    <div class="col-lg-12">
        <h2> Registro de cuentas bancarias </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Cuentas Bancarias </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content ">
	<div class="message_permissions"></div>
	<div class="ver_Cuentas_bancarias">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Seleccione a un Socio en la siguiente lista desplegable:</h5>
					</div>
					<div class="ibox-content collapse in">
						<div class="widgets-container">
							<div class="row">
								<form action="BankAccounts/addAccount/" method="POST" data-form="save" class="FormularioAjax form-horizontal" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data" id="load_data_account">
									<div class="col-xs-12">
										<select class="form-control" name="sponserBankAccount" id="sponserBankAccount" required ></select>
									</div>
									
									<!-- Cargar tabla con resultados -->
									<div class="col-lg-12 mt-3" id="container_partner"></div>
									
									<div class="col-lg-12 top20 bottom20" id="content_form_account">
										<div class="widgets-container">
											<h3>Registre los datos de la cuenta bancaria </h3>
											<hr>
											<div class="form-group">
												<label class="col-sm-2 control-label">Institución Financiera</label>
												<div class="col-sm-10">
													<select class="form-control bottom15" name="bank" id="bank" required></select>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<label class="col-sm-2 control-label">Tipo de Cuenta</label>
												<div class="col-sm-10">
													<select class="form-control bottom15" name="typeAccount" id="typeAccount" required></select>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<label class="col-sm-2 control-label">Número de Cuenta</label>
												<div class="col-sm-10">
													<input class="form-control only-number" type="text" name="numberAccount" id="numberAccount" required>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<div class="col-sm-4 col-sm-offset-2">
													<button class="btn aqua" type="submit" id="btn_save_account">Guardar</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="RespuestaAjax"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
		
		<!-- Modal-->
		<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel"></h4>
					</div>
					<form action="BankAccounts/updateAccount/" method="POST" data-form="update" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data" id="form_modal_account">
						<div class="modal-body p-0">
							<input type="hidden" id="CUE_ID" value="" name="CUE_ID">
							<div class="widgets-container">
								<div class="form-group">
									<label class="col-sm-3 control-label">Institución Financiera</label>
									<div class="col-sm-9">
										<select class="form-control bank_modal" name="bank" id="bank" required></select>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-3 control-label">Tipo de Cuenta</label>
									<div class="col-sm-9">
										<select class="form-control type_account_modal" name="typeAccount" id="typeAccount" required></select>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-3 control-label">Número de Cuenta</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="numberAccount" id="numberAccount" value="" required>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-3 control-label">Estado</label>
									<div class="col-sm-9">
										<select class="form-control StatusAccount_modal" name="StatusAccount" id="StatusAccount" required></select>
									</div>
								</div>
							</div>						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn aqua">Actualizar datos</button>
						</div>
					</form>
					<div class="RespuestaAjax"></div>
				</div>
			</div>
		</div>
		
		
		
		<form id="eliminarDatos">
			<div class="modal fade" id="dataDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<input type="hidden" id="id_cuenta" name="id_cuenta">
						<h2 class="text-center text-muted">Estas seguro?</h2>
						<p class="lead text-muted text-center" style="display: block;margin:10px">Esta acción eliminará de forma permanente el registro. Deseas continuar?</p>
						<div class="modal-footer">
							<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-lg btn-primary">Aceptar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>