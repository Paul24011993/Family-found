<?php

	$id_profile = $_COOKIE['id_profile'];
	//echo base64_decode(base64_decode(base64_decode($codigo)));
	$json_user = file_get_contents(SERVER_API . 'Users/get_permissions_view/'.$id_profile);
	$datos_user = json_decode($json_user );
	$get_data = $datos_user->permissions;
	//var_dump($get_data->PER_DESCRIPCION);
	$posicion_coincidencia = strpos($get_data->PER_DESCRIPCION, 'ver_Usuarios');
	//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
	if ($posicion_coincidencia === false) {
		?>
		<div class="middle-box text-center">
			<h1 class="head">403</h1>
			<h3 class="font-bold">Acceso denegado</h3>
			<div class="error-desc">
				No tiene permisos para visualizar esta informacion si necesita accesos, por favor comuniquese con el administrador.
			</div>
		</div>
		<?php
		}else{
			
	
?>
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Lista de Aporte de Socios </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Lista de Aporte de Socios </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content collapse in">
					<div class="widgets-container">
					<div class="message_permissions"></div>
						<div class="ver_Usuarios">
							<div class="row">
								<div class="col-md-12">
									<div class="btn-group">
										<a href="<?php echo SERVER_URL ?>addContribution/" class="btn sbold green add_Usuarios" id="addRow"> Registrar Aporte <i class="fa fa-plus"></i> </a>
									</div>
								</div>
							</div>
							<table id="dt_data_contributions" class="table-data-buttons table  responsive nowrap table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Socio</th>
										<th>Aporte Mensual</th>
										<th>Aporte Thomasito</th>
										<th>Aporte Extra a Thomasito</th>
										<th>Multa</th>
										<th>Detalle de Multa</th>
										<th>Fecha de Aportes</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Socio</th>
										<th>Aporte Mensual</th>
										<th>Aporte Thomasito</th>
										<th>Aporte Extra a Thomasito</th>
										<th>Multa</th>
										<th>Detalle de Multa</th>
										<th>Fecha de Aportes</th>
									</tr>
								</tfoot>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>