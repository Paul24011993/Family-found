<?php 
	//Guardar el id del socio en una variable
	$id_url=explode("/", $_GET['views']);
	$codigo = $id_url['1'];
	
	//cargar datos del socio
	$json_user = file_get_contents(SERVER_API . 'Partners/updatePartner/'.$codigo);
	$datos_user = json_decode($json_user );
	$get_data = $datos_user->data;

	//cargar el patrocinador
	$json_profile = file_get_contents(SERVER_API . 'Partners/get_partners_sponsor/'.$get_data->SOC_PATROCINADOR);
	$datos_profile = json_decode($json_profile );
	$datos = $datos_profile->data;
/*
	//obtener los socios exepto el socioque se esta editando actualmente.
	$json_profile1 = file_get_contents(SERVER_API . 'Partners/index_excluyent/' . $get_data->SOC_ID);
	$datos_profile1 = json_decode($json_profile1 );
	$datos1 = $datos_profile1->data;*/
	
	//var_dump($get_data);
?>
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Actualizar daots de socios </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Lista de Socios </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content ">
	<div class="row">
		
        <!--All form elements  start -->
        <div class="col-lg-2 top20 bottom20 text-center">
			<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" value="" name="partner_id_select" id="partner_id_select">
				<input type="hidden" value="" name="partner_id" id="partner_id">
				<input type="file" id="input-file-partners" name="input-file-partners" class="dropify-event" data-show-remove="false" data-default-file="<?php echo SERVER_URL.'assets/images/uploads/'.$get_data->SOC_IMAGEN;?>" />
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
				<form action="Partners/updatePartner/<?php echo $codigo ?>" method="POST" data-form="update" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" value="" name="partner_id" id="partner_id">
					
					<div class="col-lg-12">
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
							<label class="col-sm-2 control-label">Correo Electrónico </label>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-md-4">
										<input value="" class="form-control alpha_numeric" placeholder="Correo Electrónico" type="email" name="email" id="email">
									</div>
									<label class="col-sm-3 control-label">Cédula <code>*</code></label>
									<div class="col-md-5">
										<input value="" class="form-control only-number" type="text" name="dni" id="dni" placeholder="Cédula" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Teléfono </label>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-md-4">
										<input value="" class="form-control only-number" placeholder="Convencional" type="number" name="phone_one" id="phone_one" >
									</div>
									<label class="col-sm-3 control-label">Estado <code>*</code></label>
									<div class="col-md-5">
										<label class="mt-radio right30 left30" >
											<input type="radio" class="iCheck" value="1" name="status">
											<span class="checkmark"></span>Activo 
										</label>
										<label class="mt-radio" data-toggle="tooltip" title="El usuario no puede acceder al sistema">
											<input type="radio" class="iCheck" value="0" name="status">
											<span class="checkmark"></span>Inactivo 
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Patrocinador <code>*</code></label>
							<div class="col-sm-10">
								<select class="form-control bottom15 select2" name="sponser" id="sponser" required  >
									<option value="">SELECCIONE</option>
									<option value="<?php echo $datos[0]->SOC_ID ?>" selected readonly=""><?php echo $datos[0]->SOC_NOMBRES . ' ' . $datos[0]->SOC_APELLIDOS; ?></option>
									<?php /*foreach($datos1 as $perfil){?>
										<option value="<?php echo $perfil->SOC_ID ?>"><?php echo $perfil->SOC_NOMBRES . ' ' . $perfil->SOC_APELLIDOS; ?></option>
									<?php } */?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn green" type="submit" id="enviar" >Actualizar</button>
						</div>
					</div>
					<div class="RespuestaAjax"></div>
				</form>
			</div>
		</div>
		<!--All form elements  End -->
	</div>
</div>		
