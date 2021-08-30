<?php  
	$id_url=explode("/", $_GET['views']);
	$codigo = $id_url['1'];

	$json_user = file_get_contents(SERVER_API . 'Users/update_user/'.$codigo);
	$datos_user = json_decode($json_user );
	$get_data = $datos_user->data;
	
?>
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Módulo de registro de Usuario </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Crear Usuario </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content ">
	<div class="row">
		
        <!--All form elements  start -->
        <div class="col-lg-2 top20 bottom20 text-center">
			<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
				<input type="file" id="input-file-events" name="input-file-events" class="dropify-event" data-show-remove="false" data-default-file="<?php echo SERVER_URL.'assets/images/uploads/'.$get_data->USU_IMAGEN;?>" />
			</form>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
			</div>
			<div class="alert" role="alert"></div>
		</div>
        <div class="col-lg-10 top20 bottom20">
		
			<div class="widgets-container">
				<h5>Los campos marcados con <code>*</code> son obligatorios </h5>
				<hr>
				<form action="Users/update_user/<?php echo $codigo ?>" method="POST" data-form="update" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" value="" name="user_id" id="user_id">
					
					<div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab-1" data-toggle="tab" > Información personal</a></li>
								<li><a href="#tab-2" data-toggle="tab" >Dirección </a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-1">
									<div class="panel-body">
										<div class="form-group">
											<label class="col-lg-2 control-label">Usuario <code>*</code></label>
											<div class="col-lg-10">
												<div class="row">
													<div class="col-md-4">
														<input value="" placeholder="Nombre de usuario" class="form-control" type="text" name="user_name" id="user_name">
													</div>
													<div class="col-md-8"> 					
														<label class="mt-radio right30 left30" >
															<input type="radio" class="iCheck" value="1" name="status" id="status">
															<span class="checkmark"></span>Activo 
														</label>
														<label class="mt-radio" data-toggle="tooltip" title="El usuario no puede acceder al sistema">
															<input type="radio" class="iCheck"  value="0" name="status" id="status">
															<span class="checkmark"></span>Inactivo 
														</label>
														<label class="mt-radio" data-toggle="tooltip" title="El usuario debe configurar su contraseña cuando vuelva a iniciar sesión">
															<input type="radio" class="iCheck" value="2" name="status" id="status">
															<span class="checkmark"></span>Validar <i class="icon fa fa-question-circle" aria-hidden="true"></i>
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nombres <code>*</code></label>
											<div class="col-sm-10">
												<div class="row">
													<div class="col-md-4">
														<input value="" class="form-control only_letters" placeholder="Nombres" type="text" name="name" id="name" required >
													</div>
													<label class="col-sm-3 control-label">Apellidos <code>*</code></label>
													<div class="col-md-5">
														<input value="" class="form-control only_letters" placeholder="Apellidos" type="text" name="last_name" id="last_name" required>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Correo Electrónico <code>*</code></label>
											<div class="col-sm-10">
												<div class="row">
													<div class="col-md-4">
														<input value="" class="form-control alpha_numeric" placeholder="Correo Electrónico" type="email" name="email" id="email"required>
													</div>
													<label class="col-sm-3 control-label">Cédula <code>*</code></label>
													<div class="col-md-5">
														<input value="" class="form-control only-number" type="text" name="dni" id="dni" placeholder="Cédula" required>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Teléfono <small>(convencional)</small> <code>*</code></label>
											<div class="col-sm-10">
												<div class="row">
													<div class="col-md-4">
														<input value="" class="form-control only-number" placeholder="Convencional" type="number" name="phone_one" id="phone_one" >
													</div>
													<label class="col-sm-3 control-label">Teléfono <small>(celular)</small> <code>*</code></label>
													<div class="col-md-5">
														<input value="" class="form-control only-number" type="number" name="phone_two" id="phone_two" value='' placeholder="Celular" >
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Perfil <code>*</code></label>
											<div class="col-sm-10">
												<select class="form-control bottom15 select2" name="profile" id="profile" required  >
													<option value="">SELECCIONE</option>
													<option value="<?php echo $get_data->PRF_ID ?>" selected readonly=""><?php echo $get_data->PRF_DESCRIPCION; ?></option>
													 
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="tab-2">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-4 control-label">Calle Principal</label>
													<div class="col-sm-8">
														<input value="" class="form-control" type="text" name="street_one" id="street_one" placeholder="Calle principal">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-4 control-label">Número de domicilio</label>
													<div class="col-sm-8">
														<input value="" class="form-control" type="text" name="number_home" id="number_home" placeholder="Número de domicilio">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-4 control-label">Calle Secundaria</label>
													<div class="col-sm-8">
														<input value="" class="form-control" type="text" name="street_two" id="street_two" placeholder="Calle secundaria">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-4 control-label">Código Postal</label>
													<div class="col-sm-8">
													<input value="" class="form-control" type="text" name="postal_code" id="postal_code" placeholder="Código postal">
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="col-sm-2 control-label">Referencia</label>
													<div class="col-sm-10">
														<textarea class="form-control" name="reference" id="reference"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn green" type="submit" id="enviar" >Guardar</button>
						</div>
					</div>
					<div class="RespuestaAjax"></div>
				</form>
			</div>
		</div>
		<!--All form elements  End -->
	</div>
</div>		
