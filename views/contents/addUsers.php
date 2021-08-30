 
  <div class="row wrapper border-bottom page-heading" id="container_users">
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
        <div class="col-lg-12 top20 bottom20">
			<div class="widgets-container">
				<h5>Los campos marcados con <code>*</code> son obligatorios </h5>
				<hr>
				<form action="Users/signup/" method="POST" data-form="save" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-lg-2 control-label">Usuario <code>*</code></label>
						<div class="col-lg-8">
							<input readonly="" placeholder="" class="form-control" type="text" name="user_name" id="user_name">
							<span class="help-block bottom15-none">Este campo se autocompletará al ingrresar su numero de cédula en el siguiente cuadro de texto.</span> 
						</div>
					</div>
					<hr>
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
						<label class="col-sm-2 control-label">Correo Electrónico <code>*</code></label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-5 respuesta-validacion-correo">
									<input class="form-control input-verificador alpha_numeric" data-row="USU_EMAIL" placeholder="Correo Electrónico" type="email" name="email" id="email" value='' required>
									<span class="response_redundancy control-label"></span> 
								</div>
								<label class="col-sm-2 control-label">Cédula <code>*</code></label>
								<div class="col-md-5 respuesta-validacion-correo">
									<input class="form-control input-verificador only-number" data-row="USU_DNI" type="text" name="dni" id="dni" value='' placeholder="Cédula" required>
									<span class="response_redundancy control-label"></span>
								</div>
							</div>
						</div>
					</div>
					<hr>
						<div class="form-group">
						<label class="col-sm-2 control-label">Perfil <code>*</code></label>
						<div class="col-sm-8">
							<select class="form-control" name="profile" id="profile" required  ></select>
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