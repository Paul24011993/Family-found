<?php
	define('SERVER_API', 'http://desarrollo.nacion-digital.com/panel/AMT-DESARROLLO/');
	$sumador_total = 0;
	
?>
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div id="demo5" class="ibox-content collapse in">
					<div class="borderedTable">
						<div class="table-scrollable">
							<table class="table table-bordered table-hover table table-bordered">
								<thead>
									<tr>
										<th class='text-center'>ITEM</th>
										<th>DETALLE</th>			
										<th class='text-center'>CANTIDAD</th>
										<th class='text-center'>VALOR UNITARIO</th>
										<th class='text-center'>VALOR TOTAL</th>
										<th></th>
									</tr>
								</thead>
								<tr>
									<td colspan='6' class='color_theme text-center'>REPUESTOS	</td>
								</tr>
								<tbody>
								<?php
									$json_brands = file_get_contents(SERVER_API . 'Proforms/load_detail_parts/'.$_COOKIE['PROF_NUMERO_DOCUMENTO']);
									$datos_brands = json_decode($json_brands);
									$brands = $datos_brands->data;
									$contador = 1;
									foreach($brands as $rows):
										$total_rep = number_format($rows->DETA_CANTIDAD * $rows->REP_PRECIO, 2,'.', '');
										$sumador_total+=$total_rep;//Sumador
								?>
									<tr>
										<td class='text-center'><?php echo $contador;?></td> 
										<td class='text-left'><?php echo $rows->REP_DESCRIPCION;?></td> 
										<td class='text-center'><?php echo $rows->DETA_CANTIDAD;?></td>
										<td class='text-right'><?php echo $rows->REP_PRECIO;?></td>
										<td class='text-right'><?php echo $total_rep;?></td>
										<td class='text-center'><a href="#" class="btn-delete-detail" onclick="eliminar_detalle_tmp('<?php echo $rows->DETA_ID ?>', 'proforma')"><i class="glyphicon glyphicon-trash"></i></a></td>
									</tr>	
								<?php $contador++; endforeach; ?>
								</tbody>
								<tr>
									<td colspan='6' class='color_theme text-center'>LUBRICANTES</td> 
								</tr>
								<tbody>
									<?php
										$json_brands = file_get_contents(SERVER_API . 'Proforms/load_detail_lubricants/'.$_COOKIE['PROF_NUMERO_DOCUMENTO']);
										$datos_brands = json_decode($json_brands);
										$brands = $datos_brands->data;
										$contador = 1;
										foreach($brands as $rows):
										$total_lub = number_format($rows->DETA_CANTIDAD * $rows->LUB_PRECIO, 2,'.', '');
										$sumador_total+=$total_lub;//Sumador
									?>
                            			<tr>
                            				<td class='text-center'><?php echo $contador; ?></td> 
                            				<td class='text-left'><?php echo $rows->LUB_DESCRIPCION;?></td> 
                            				<td class='text-center'><?php echo $rows->DETA_CANTIDAD;?></td>
                            				<td class='text-right'><?php echo $rows->LUB_PRECIO;?></td>
                            				<td class='text-right'><?php echo $total_lub;?></td>
                            				<td class='text-center'><a href="#" class="btn-delete-detail" onclick="eliminar_detalle_tmp('<?php echo $rows->DETA_ID ?>', 'proforma')"><i class="glyphicon glyphicon-trash"></i></a></td>
										</tr>	
									<?php $contador++; endforeach; ?>
								</tbody>
								<tr>
									<td colspan='6' class="color_theme text-center">MANO DE OBRA</td>
								</tr>
								<tbody>
									<?php
										$json_brands = file_get_contents(SERVER_API . 'Proforms/load_detail_labuor/'.$_COOKIE['PROF_NUMERO_DOCUMENTO']);
										$datos_brands = json_decode($json_brands);
										$brands = $datos_brands->data;
										$contador = 1;
										foreach($brands as $rows):
										$total_man = number_format($rows->DETA_CANTIDAD * $rows->MAN_PRECIO, 2,'.', '');
										$sumador_total+=$total_man;//Sumador
									?>
                            			<tr>
                            				<td class='text-center'><?php echo $contador;?></td> 
                            				<td class='text-left'><?php echo $rows->MAN_DESCRIPCION;?></td> 
                            				<td class='text-center'><?php echo $rows->DETA_CANTIDAD;?></td>
                            				<td class='text-right'><?php echo $rows->MAN_PRECIO;?></td>
                            				<td class='text-right'><?php echo $total_man;?></td>
                            				<td class='text-center'><a href="#" class="btn-delete-detail" onclick="eliminar_detalle_tmp('<?php echo $rows->DETA_ID ?>', 'proforma')"><i class="glyphicon glyphicon-trash"></i></a></td>
										</tr>	
									<?php $contador++; endforeach;
                            			$total_iva=($sumador_total * 12 )/100; 
                            			$total_proform = $sumador_total+$total_iva;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 pull-right"> 
			<div id="demo5" class="ibox-content collapse in">
				<div class="borderedTable">
					<div class="table-scrollable">
						<table class="table table-bordered table-hover table table-bordered">
							<tbody>
								<tr>
									<td class='text-right color_theme' colspan=4>SUBTOTAL </td>
									<td class='text-center'><?php echo number_format($sumador_total, 2);?></td> 
								</tr>
								<tr>
									<td class='text-right color_theme' colspan=4>IVA (12)% $</td>
									<td class='text-center'><?php echo number_format($total_iva, 2);?></td> 
								</tr>
								<tr>
									<td class='text-right color_theme' colspan=4>TOTAL $</td>
									<td class='text-center'><?php echo number_format($total_proform, 2);?></td> 
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		