  <div class="row wrapper border-bottom page-heading" id="container_partners">
      <div class="col-lg-12">
        <h2> Módulo de registro de Socios </h2>
        <ol class="breadcrumb">
          <li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Crear Socio </strong> </li>
        </ol>
      </div>
    </div>
    <div class="wrapper-content ">
      <div class="row">
		
        <!--All form elements  start -->
        <div class="col-lg-12 top20 bottom20">
			<div class="widgets-container">
				<h5>Los campos marcados con <code>*</code> son obligatorios </h5>
				<hr>
				<form action="Partners/savePartner/" method="POST" data-form="save" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nombres <code>*</code></label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-5">
									<input class="form-control only_letters" placeholder="Nombres" type="text" name="name" id="name" required >
								</div>
								<label class="col-sm-2 control-label">Apellidos <code>*</code></label>
								<div class="col-md-5">
									<input class="form-control only_letters" placeholder="Apellidos" type="text" name="last_name" required>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Correo Electrónico </label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-5 respuesta-validacion-correo">
									<input class="form-control input-verificador alpha_numeric" data-row="SOC_EMAIL" placeholder="Correo Electrónico" type="email" name="email" id="email-soc" value=''>
									<span class="response_redundancy control-label"></span> 
								</div>
								<label class="col-sm-2 control-label">Cédula <code>*</code></label>
								<div class="col-md-5 respuesta-validacion-correo">
									<input class="form-control input-verificador only-number" data-row="SOC_DNI" type="text" name="dni" id="dni-soc" value='' placeholder="Cédula" required>
									<span class="response_redundancy control-label"></span>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">Teléfono </label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-5">
									<input class="form-control only-number" placeholder="Teléfono" type="tel" name="phone" id="phone" >
								</div>
								<label class="col-sm-2 control-label">Patrocinador <code>*</code></label>
								<div class="col-md-5">
									<select class="form-control bottom15 select2" name="sponsor" id="sponsor" required  ></select>
								</div>
							</div>
						</div>
					</div>
					<hr>
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