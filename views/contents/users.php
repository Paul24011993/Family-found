<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Lista de Usuarios Registrados </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Lista de usuarios </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content collapse in">
					<div class="widgets-container">
						<div class="row add_Usuarios">
							<div class="col-md-12">
								<div class="btn-group">
									<a href="<?php echo SERVER_URL ?>addUsers/" class="btn sbold green " id="addRow"> Nuevo usuario <i class="fa fa-plus"></i> </a>
								</div>
							</div>
						</div>
						<div class="ver_Usuarios">
							<table id="dt_data_users" class="table-data-buttons table  responsive nowrap table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Perfil</th>
										<th>Nombres</th>
										<th>DNI</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Estado</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Usuario</th>
										<th>Perfil</th>
										<th>Nombres</th>
										<th>DNI</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Estado</th>
										<th></th>
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
