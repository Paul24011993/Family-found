
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <h2> Lista de Socios Registrados </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Lista de socios </strong> </li>
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
					<div class="row add_Lista_de_Socios">
						<div class="col-md-12">
							<div class="btn-group">
								<a href="<?php echo SERVER_URL ?>addPartners/" class="btn sbold green add_Lista_de_Socios" id="addRow"> Nuevo Socio <i class="fa fa-plus"></i> </a>
							</div>
						</div>
					</div>
					<div class="ver_Lista_de_Socios">
							<table id="dt_data_partners" class="table-data-buttons table  responsive nowrap table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Nombres</th>
										<th>DNI</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Ingreso</th>
										<th>Estado</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Nombres</th>
										<th>DNI</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Ingreso</th>
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