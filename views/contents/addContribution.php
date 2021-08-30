<?php 
	$json = file_get_contents(SERVER_API . 'Contributions/partner_excluyent/1');
	$data_profile = json_decode($json );
	$datos = $data_profile->data;
	//var_dump($data_profile);
?>
<div class="row wrapper border-bottom page-heading" id="container_contributions">
    <div class="col-lg-12">
        <h2> Módulo de registro de Aporte de Socios </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Aporte de Socios </strong> </li>
		</ol>
	</div>
	
    <div class="wrapper-content ">
		<div class="row">
			<!--All form elements  start -->
			<div class="col-lg-12 top20 bottom20">
				<div class="widgets-container">
					<div class="note note-success">
						<h4 class="block">Estimado Socio</h4>
						<p> El aporte mensual de $10.00 para el fondo incluido $1.00 para Thomasito serán acreditados automaticamente a todos los socios después de completar y enviar el siguiente formulario</p>
					</div>
					<hr>
					<form action="Contributions/generateContributions/" method="POST" data-form="save" id="" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
						<div class="panel panel-primary">
							<div class="panel-heading"> Aporte extra para Thomasito </div>
							<div class="panel-body">
								<div class="form-group">
									<label for="contribution_thomas">Socios</label>
									<select class="form-control select2" name="contribution_thomas" id="contribution_thomas" >
										<option value="0">SELECCIONE</option>
										<?php foreach ($datos as $dato) { ?>
											<option value="<?php echo $dato->SOC_ID ?>"><?php echo $dato->SOC_NOMBRES . ' ' . $dato->SOC_APELLIDOS ?></option>
										<?php } ?>
									</select>
									<input type="hidden" value="" name="id_hide" id="id_hide">
									<table class="table table-bordered table-hover table_contribution_thomas mt-2" style="display:none;">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nombres y Apellidos</th>
												<th class="text-center">Valor</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<tr style="display:none;">
											<th for="id"><input type="hidden" name="id_apport_thomas[]" value="1"></th>
											<th ></th>
											<th class="text-center">
												<div class="input-group"><span class="input-group-addon">$</span>
													<input class="form-control" type="number" value="0.00" required name="apport_thomas[]" id="apport_thomas" min="0" step="1.00">
													<span class="input-group-addon">.00</span>
												</div>
											</th>
											<th class="text-center"><button class="btn btn-danger btn-circle btn_remove_row" type="button"><i class="fa fa-times"></i> </button></th>
										</tr>
										</tbody>
									</table >
								</div>
							</div>
						</div>
						<hr>
						<div class="panel panel-primary">
							<div class="panel-heading"> Aportes con Novedades </div>
							<div class="panel-body">
								<div class="form-group">
									<label for="without_contribution">Socios</label>
									<select class="form-control select2" name="without_contribution" id="without_contribution">
										<option value="0">SELECCIONE</option>
										<?php foreach ($datos as $dato) { ?>
											<option value="<?php echo $dato->SOC_ID ?>"><?php echo $dato->SOC_NOMBRES . ' ' . $dato->SOC_APELLIDOS ?></option>
										<?php } ?>
									</select>
										<div class="form-group table_without_contribution mt-2" style="display:none;">
											<div class="col-md-10">
												<div class="radio">
												<label><input type="radio" class="iCheck" name="aportesNovedades" value="1">No registra Aporte</label>
												</div>
												<div class="radio">
												<label><input type="radio" class="iCheck" name="aportesNovedades" value="2">Depósito fuera del horario permitido</label>
												</div>
												<div class="radio">
												<label><input type="radio" class="iCheck" name="aportesNovedades" value="3">Cuota incompleta</label>
												</div>
												<div class="radio">
												<label><input type="radio" class="iCheck" name="aportesNovedades" value="4" id="data4">Otros</label>
												</div>
												<br>
												<textarea class="form-control" id="observation_contribution" name="observation_contribution">
										</textarea>

											</div>
											<hr>
										</div>
										<div id="notice_multa" ></div>
									<div class="note note-warning mt-4 note-warning-multa" style="display:none;">
										<p> De acuerdo a lo estblecido al reglamento del <?php echo NOMBRE_PROYECTO ?> se aplicará una multa por el valor de $<?php echo '10.00' ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 ">
								<button class="btn green" type="submit" id="enviar" >Generar Aportes</button>
							</div>
						</div>
						<div class="RespuestaAjax"></div>
					</form>
				</div>
			</div>
			<!--All form elements  End -->
		</div>
	</div>	