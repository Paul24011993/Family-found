<?php

	global $viewsControllers;
	global $mainModel;

	get_header(); 
	
	//Guardar en una variable la instancia de la clase viewsControllers.
	$viewsLoad = $viewsControllers->get_views_controllers();
	//die($viewsLoad);
?>
<body <?php body_class($viewsLoad); ?>>		
	<?php
		$aux =$mainModel->get_page_template($viewsLoad);
		if(!$aux):
		validate_login_user($cookie = 'Token_user');
		include 'views/modules/top_bar.php'; 
	?>
		<div class="clearfix"> </div>
		<div class="page-container">
			<?php include 'views/modules/side_bar.php';
				// mostrar banner solo en la pagina de business.php
				$route = explode('/', $_GET['views']);
				if($route[0] == 'business'){
					include 'views/modules/banner_business.php';
				}
			?>
			<div class="page-content-wrapper animated fadeInRight">
				<div class="page-content">
					<?php require_once $viewsLoad; ?>
					<?php get_bottom_bar(); ?>
				</div>
			</div>
		</div>
		<!-- start theme config -->
		<?php include 'views/modules/theme_config.php'; ?>
		<!-- end theme config -->
		<!-- Include de modal  -->
		<?php include 'views/modal/load_details.php';?>

		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" id="general_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Actualizaciòn de cuentas bancarias</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			</div>
		</div>
		</div>
		<?php endif; ?>
	<?php get_footer(); ?>
</body>
</html>			