<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Módulo para creación de perfiles </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Crear perfil </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content ">
	<div class="row">
		
        <!--All form elements  start -->
        <div class="col-lg-12 bottom20">
			<div class="widgets-container">
				<h5>Los campos marcados con <code>*</code> son obligatorios </h5>
				<hr>
				<form action="Profiles/addProfile/" method="POST" data-form="save" class="FormularioAjax form-horizontal" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
					<input type="hidden" name="ingresar_manoObra" value="true"/>
					<div class="form-group">
						<label class="col-lg-4 control-label">Descripción <code>*</code></label>
						<div class="col-lg-4">
							<input placeholder="" class="form-control" type="text" name="description" required>
						</div>
					</div>
					<table class="table table-striped table-bordered table-advance table-hover" style="border-collapse:collapse;">
						<thead>
							<tr>
								<th>Lista de menus del sistema</th>
								<th class="text-center"><input name="Todos" type="checkbox" value="1" id="all_add" class="check_add"> Crear</th>
								<th class="text-center"><input name="Todos" type="checkbox" value="1" id="all_mod" class="check_mod"> Editar</th>
								<th class="text-center"><input name="Todos" type="checkbox" value="1" id="all_del" class="check_del"> Eliminar</th>
								<th class="text-center"><input name="Todos" type="checkbox" value="1" id="all_ver" class="check_ver"> Ver</th>
								<th class="text-center"><input name="Todos" type="checkbox" value="1" id="all_exp" class="check_exp"> Exportar</th>
							</tr>
						</thead>
						<tbody id="menu_profiles">
						</tbody>
					</table>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn green" type="submit" id="enviar" >Guardar</button>
							<a href="<?php echo SERVER_URL ?>profiles/" class="btn blue">Lista de perfiles</a>
						</div>
					</div>
				</form>
					<div class="RespuestaAjax"></div>
			</div>
		</div>
        <!--All form elements  End -->
	</div>
</div>