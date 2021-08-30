<?php
	//obtener los socios.
	$json_profile1 = file_get_contents(SERVER_API . 'Partners/index_excluyent/1');
	$datos_profile1 = json_decode($json_profile1 );
	$datos1 = $datos_profile1->data;
	
	/* //CARGAR TIPO DE ENTIDADES BANCARIAS
		$json_type_bank = file_get_contents(SERVER_API . 'BankAccounts/get_accounts_banks_partner/');
		$data_type_bank = json_decode($json_type_bank );
		$type_bank = $data_type_bank->data;
		
		//CARGAR TIPO DE CUENTAS BANCARIAS
		$json_type_accounts = file_get_contents(SERVER_API . 'BankAccounts/get_type_accounts/');
		$data_type_accounts = json_decode($json_type_accounts );
		$type_accounts = $data_type_accounts->data;
		
	*/
	
?>

<div class="row wrapper border-bottom page-heading">
    <div class="col-lg-12">
        <h2> Solicitud de Crédito </h2>
        <ol class="breadcrumb">
			<li> <a href="<?php echo SERVER_URL; ?>home/">Home</a> </li>
			<li class="active"> <strong> Solicitud de Crédito </strong> </li>
		</ol>
	</div>
</div>
<div class="wrapper-content ">
	<div class="row">
		<div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Seleccione a un Socio en la siguiente lista desplegable:</h5>
				</div>
				<!-- / ibox-title -->
				<div id="demo1" class="ibox-content collapse in">
					<div class="widgets-container">
						<div class="row">
							<div class="col-xs-12">
								<select class="form-control bottom15 select2" name="sponserCredit" id="sponserCredit" required  >
									<option value="0">SELECCIONE</option>
									<?php foreach($datos1 as $perfil){?>
										<option value="<?php echo $perfil->SOC_ID ?>" ><?php echo $perfil->SOC_NOMBRES . ' ' . $perfil->SOC_APELLIDOS; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="container_partner_credit" style="display:none;">
		<div class="col-lg-12">
            <div class="ibox">
				<div class="widgets-container">
					<div class="row">
						<div class="col-lg-12">
							<form action="BankAccounts/addAccount/" method="POST" data-form="save" id="regiration_form" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
								<fieldset>
									<h2> Actualización de Datos</h2>
									<div class="panel panel-primary">
										<div class="panel-heading"> Datos Personales </div>
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="widgets-container">
													<div class="form-group">
														<label for="dni_credit">Cédula de Ciudadanía</label>
														<input class="form-control" id="dni_credit" name="dni_credit" placeholder="Cédula de Ciudadanía" type="text">
													</div>
													<div class="form-group">
														<label for="names_credit">Nombres y Apellidos</label>
														<input class="form-control" id="names_credit" name="names_credit" placeholder="Nombres y Apellidos" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-primary">
										<div class="panel-heading"> Institución Financiera </div>
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="widgets-container">
													<div class="form-group">
														<label for="dni_credit">Institución Financiera</label>
														<select class="form-control " name="name_bank" id="name_bank" required  >
															<option value="0">SELECCIONE</option>
														</select>
														<table class="table table-bordered table-hover load_table_test mt-2" style="display:none;">
															<thead>
																<tr>
																	<th>Banco</th>
																	<th>Tipo de Cuenta</th>
																	<th>Número de Cuenta</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table >
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-primary">
										<div class="panel-heading"> Referencias Personales ( Garantes ) </div>
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="widgets-container">
													<div class="form-group">
														<label for="dni_credit">Referencias Personales</label>
														<select class="form-control " name="guarantors" id="guarantors" required  >
															<option value="0">SELECCIONE</option>
														</select>
														<table class="table table-bordered table-hover load_table_guarantors mt-2" style="display:none;">
															<thead>
																<tr>
																	<th>Cedula</th>
																	<th>Nombes y Apellidos</th>
																	<th>telefono</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table >
													</div>
												</div>
											</div>
										</div>
									</div>
									<input type="button" name="password" class="next btn btn-info" value="Continuar" />
								</fieldset>
								<fieldset>
									<h2> Resultados y novedades de precalificación al crédito</h2>
									<div class="panel panel-primary">
										<div class="panel-heading"> Garantías </div>
										<div class="panel-body">
											<table class="table table-striped table-bordered table-advance table-hover">
												<thead>
													<tr>
														<td> <i class="fa fa-briefcase"></i> Aportes: </td>
														<td> 2560.60$ </td>
													</tr>
													<tr>
														<td> <i class="fa fa-briefcase"></i> Fondo recaudado: </td>
														<td> 2560.60$ </td>
													</tr>
													<tr>
														<td> <i class="fa fa-briefcase"></i> Total Garantías Disponibles: </td>
														<td> 560.60$ </td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="panel panel-primary">
										<div class="panel-heading"> Resultado Precalificación de Requisitos </div>
										<div class="panel-body">
											<table class="table table-bordered table-striped table-hover mb-4">
												<thead>
													<tr>
														<th> Requisito </th>
														<th> Aprueba </th>
														<th> Observación </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td> Poseer garantias </td>
														<td> <i class="fa fa-check"></i> </td>
														<td> Si tiene Garantias </td>
													</tr>
													<tr>
														<td> Poseer garantias </td>
														<td> <i class="fa fa-check"></i> </td>
														<td> Si tiene Garantias </td>
													</tr>
													<tr>
														<td> Poseer garantias </td>
														<td> <i class="fa fa-check"></i> </td>
														<td> Si tiene Garantias </td>
													</tr>
												</tbody>
											</table>
											<div class="panel panel-success">
												<div class="panel-heading"> Resultado Final del Análisis </div>
												<div class="panel-body">
													<p>Precalificación Aceptada</p>
												</div>
											</div>
										</div>
									</div>
									<input type="button" name="previous" class="previous btn btn-default" value="Atrás" />
									<input type="button" name="next" class="next btn btn-info" value="Aceptar y Continuar" />
								</fieldset>
								<fieldset>
									<h2>Tabla de Referencia de Crédito</h2>
									<div class="panel panel-primary">
										<div class="panel-heading"> Datos Generales </div>
										<div class="panel-body">
											<div class="ibox float-e-margins">
												<div class="widgets-container">
													<table class="table small m-b-xs top5 bottom0">
														<tbody>
															<tr>
																<td class="pb-2"><strong>Cédula de Ciudadanía: </strong> pichinca </td>
																<td class="pb-2"><strong>Nombres y Apellidos: </strong> 12313123123 </td>
																<td class="pb-2"><strong>Garante del Crédito: </strong> 12313123 </td>
															</tr>
															<tr>
																<td class="pb-2"><strong>Institución Financiera: </strong> pichinca </td>
																<td class="pb-2"><strong>Tipo De Cuenta: </strong> 12313123123 </td>
																<td class="pb-2"><strong>Número De Cuenta: </strong> 12313123 </td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-primary">
										<div class="panel-heading"> Parámetros para el Cálculo de Crédito </div>
										<div class="panel-body">
											<div class="col-lg-6">
												<div class="panel panel-default mt-3">
													<div class="panel-heading-bank"> Condiciones para el Cálculo</div>
													<div class="panel-body">
														<table class="">
															<tbody>
																<tr>
																	<td class="pb-2">Tiempo de Aportaciones: </td>
																	<td class="pb-2">7 meses</td>
																</tr>
																<tr>
																	<td colspan="2"><hr></td>
																</tr>
																<tr>
																	<td class="pb-2">Plazo Máximo del Crédito: </td>
																	<td class="pb-2">12 meses</td>
																</tr>
																<tr>
																	<td colspan="2"><hr></td>
																</tr>
																<tr>
																	<td class="pb-2">Taza de Interés: </td>
																	<td class="pb-2">La taza se tomará en función del plazo </td>
																</tr>
																<tr>
																	<td colspan="2"><hr></td>
																</tr>
																<tr>
																	<td class="pb-2"><strong>Capacidad de endeudamiento: </strong></td>
																	<td class="pb-2"><strong>$150.00 </strong></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="panel panel-default mt-3">
													<div class="panel-heading-bank"> Garantías </div>
													<div class="panel-body">
														<table class="">
															<tbody>
																<tr>
																	<td colspan="2" class="pb-2"><strong>APORTES </strong></td>
																</tr>
																<tr>
																	<td class="pb-2">Total</td>
																	<td class="pb-2">$2000.00</td>
																</tr>
																<tr>
																	<td class="pb-2">Comprometidas:</td>
																	<td class="pb-2">$500.00 </td>
																</tr>
																<tr>
																	<td class="pb-2">Disponible:</td>
																	<td class="pb-2">$1500.00</td>
																</tr>
																<tr>
																	<td colspan="2"><br><hr><br></td>
																</tr>	
																
																<tr>
																	<td colspan="2" class="pb-2"><strong>FONDOS </strong></td>
																</tr>
																<tr>
																	<td class="pb-2">Total</td>
																	<td class="pb-2">$2000.00</td>
																</tr>
																<tr>
																	<td class="pb-2">Comprometidas:</td>
																	<td class="pb-2">$500.00 </td>
																</tr>
																<tr>
																	<td class="pb-2">Disponible:</td>
																	<td class="pb-2">$1500.00</td>
																</tr>
																<tr>
																	<td colspan="2"><br><hr><br></td>
																</tr>
																<tr>
																	<td class="pb-2"><strong>Total Garantías Disponible: </strong></td>
																	<td class="pb-2"><strong>$1500.00 </strong></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-primary">
										<div class="panel-heading"> Personalice su Crédito </div>
										<div class="panel-body">
											<div class="col-lg-12">
												<div class="widgets-container">
													<h5>Usted puede realizar el cálculo de la cuota mensual que desea pagar, en base al monto y plazo que defina</h5>
													<hr>
													<div class="form-group">
														<label for="credit_term" class="col-sm-2 control-label">Plazo</label>
														<div class="col-sm-10">
															<input class="form-control" id="credit_term" name="credit_term" type="number">
															<p class="help-block">(Meses) Plazo máximo 12 meses</p>
														</div>
													</div>
													<div class="form-group">
														<label for="amount_credit" class="col-sm-2 control-label">Monto $</label>
														<div class="col-sm-10">
															<input class="form-control" id="amount_credit" name="amount_credit" type="text">
															<p class="help-block">Monto máximo $1500</p>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															<button type="submit" class="btn yellow m-t-xxs">Calcular</button>
															<button class="btn default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
																Ver Tabla de Amortización
															</button>
														</div>
													</div>
													
													<div class="collapse" id="collapseExample">
														<div class="card card-body">
															<div class="col-sm-offset-2 col-sm-10">
																<div class="panel panel-default mt-3">
																	<div class="panel-heading-bank"> Condiciones para el Cálculo</div>
																	<div class="panel-body">
																		<table class="">
																			<tbody>
																				<tr>
																					<td class="pb-2">Tiempo de Aportaciones: </td>
																					<td class="pb-2">7 meses</td>
																				</tr>
																				<tr>
																					<td colspan="2"><hr></td>
																				</tr>
																				<tr>
																					<td class="pb-2">Plazo Máximo del Crédito: </td>
																					<td class="pb-2">12 meses</td>
																				</tr>
																				<tr>
																					<td colspan="2"><hr></td>
																				</tr>
																				<tr>
																					<td class="pb-2">Taza de Interés: </td>
																					<td class="pb-2">La taza se tomará en función del plazo </td>
																				</tr>
																				<tr>
																					<td colspan="2"><hr></td>
																				</tr>
																				<tr>
																					<td class="pb-2"><strong>Capacidad de endeudamiento: </strong></td>
																					<td class="pb-2"><strong>$150.00 </strong></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
															<div class="col-sm-12">
																<table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
																	<thead>
																		<tr>
																			<th>No. Dividendo</th>
																			<th>Capital Amortizado</th>
																			<th>Interés</th>
																			<th>Couta</th>
																			<th>Saldo</th>
																			<th>Fecha de Pago (dd/mm/yyyy))</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>Jordan Belfort</td>
																			<td>System Architect</td>
																			<td>London</td>
																			<td>61</td>
																			<td>2011/04/25</td>
																			<td>$320,800</td>
																		</tr>
																		<tr>
																			<td>Naomi Lapaglia</td>
																			<td>Accountant</td>
																			<td>London</td>
																			<td>63</td>
																			<td>2011/07/25</td>
																			<td>$170,750</td>
																		</tr>
																		<tr>
																			<td>Auckland Straight Line Host</td>
																			<td>Junior Technical Author</td>
																			<td>London</td>
																			<td>66</td>
																			<td>2009/01/12</td>
																			<td>$86,000</td>
																		</tr>
																		<tr>
																			<td>Donnie Azoff</td>
																			<td>Senior Javascript Developer</td>
																			<td>London</td>
																			<td>22</td>
																			<td>2012/03/29</td>
																			<td>$433,060</td>
																		</tr>
																	</tbody>
																</table>																
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<input type="button" name="previous" class="previous btn btn-default" value="Atrás" />
									<input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>