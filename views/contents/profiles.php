<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Lista de perfiles de usuarios </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Lista de perfiles de usuarios </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content collapse in">
					<div class="widgets-container">
						<div class="row add_Perfiles">
							<div class="col-md-12">
								<div class="btn-group">
									<a href="<?php echo SERVER_URL ?>addProfile/" class="btn sbold aqua " id="addRow"> Nuevo perfil <i class="fa fa-plus"></i> </a>
								</div>
							</div>
						</div>
						<div class="ver_Perfiles">
							<table id="dt_data_profile" class="table-data-buttons table  responsive nowrap table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre Perfil</th>
										<th>Creado</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Creado</th>
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