<?php
	
    /* Modo debug */ 
	error_reporting(E_ALL);

    /* Controlamos los errores */
	ini_set('display_errors','On'); 
	
	/* Cargamos librerias */
	require_once( dirname( __FILE__ ) . '/autoload.php' );
	require_once( dirname( __FILE__ ) . '/configGeneral.php' );
	require_once( dirname( __FILE__ ) . '/settings.php');
	require_once( dirname( __FILE__ ) . '/functions.php' );