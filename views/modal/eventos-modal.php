<!---modal Agregar eventos-->
<div class="modal fade modal-m" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
	        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
			</div>
	        <form class="form-horizontal" method="POST" action="<?php echo SERVER_URL; ?>ajax/calendarioAjax.php">
	        	<input type="hidden" name="insert" />
				<div class="modal-body"> 
	        		<div class="form-group">
		                <label class="col-sm-2 control-label">Título</label>
		                <div class="col-sm-10">
							<input class="form-control" type="text" name="title" id="title" placeholder="Nombre del evento" required>
						</div>
					</div>
	        		<div class="form-group">
		                <label class="col-sm-2 control-label">Prioridad</label>
		                <div class="col-sm-10">
							<select class="form-control bottom15" name="prioridad" id="prioridad" required>
								<option value="">Seleccionar</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Urgente</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Urgencia menor</option> 
								<option style="color:#008000;" value="#008000">&#9724; Normal</option>						  
								
							</select>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-2 control-label">Periodo</label>
						<div class="col-sm-10" >
							<input class="form-control" type="text" name="fecha_rango" id="fecha_rango" value="" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn green">Guardar</button>
				</div>
				<div class="RespuestaAjax"></div>
			</form>
		</div>
	</div>
</div>	
<!---fin modal Agregar eventos-->

<!-- Modal -->
<div class="modal fade modal-m" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
			</div>
			<form class="form-horizontal" method="POST" action="<?php echo SERVER_URL; ?>ajax/calendarioAjax.php" >
				<input type="hidden" name="update" />
				<input type="hidden" name="id" class="form-control" id="id">
				
				<div class="modal-body">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Titulo</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
						</div>
					</div>
					<div class="form-group">
						<label for="color" class="col-sm-2 control-label">Color</label>
						<div class="col-sm-10">
							<select name="prioridad" class="form-control" id="prioridad">
								<option value="">Seleccionar</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Urgente</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Urgencia menor</option> 
								<option style="color:#008000;" value="#008000">&#9724; Normal</option>
								
							</select>
						</div>
					</div>
				    <div class="form-group"> 
						<div class=" col-sm-2"></div>
						<div class=" col-sm-5">
							<div class="form-check">
								<label class="form-check-label text-success">
									<input type="checkbox" name="finalizar" class="form-check-input iCheck" value="0"> Finalizar recordatorio
								</label>
							</div>
						</div>
						<div class=" col-sm-5">
							<div class="form-check">
								<label class="form-check-label text-danger">
									<input type="checkbox" name="delete" class="form-check-input iCheck"> Eliminar Evento
								</label>
							</div>
						</div>
					</div>
					
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


