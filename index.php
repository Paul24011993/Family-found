<?php
	//Activa el almacenamiento en búfer de la salida
	ob_start();

	// Cargar librerias 
	require_once 'core/load.php'; 
	
	// Cargamos el template principal
	$viewsControllers->get_template_controller();

	ob_end_flush();