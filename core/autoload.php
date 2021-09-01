<?php
	/* Autoload de todas las clases */
	spl_autoload_register( 'autoload' );
	
	function autoload( $class, $dir = null ) {
		if ( is_null( $dir ) )
		$dir = dirname(dirname(__FILE__)).'/';
		
		foreach ( scandir( $dir ) as $file ) {
			
			// directory?
			if ( is_dir( $dir.$file ) && substr( $file, 0, 1 ) !== '.' )
			autoload( $class, $dir.$file.'/' );
			
			// php file?
			if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {
				
				// filename matches class?
				if ( str_replace( '.php', '', $file ) == $class || str_replace( '.class.php', '', $file ) == $class ) {
					
					/* 
						Cargamos las siguientes rutas...
						C:\xampp\htdocs\crm-familyFound/models/viewsModels.php"
						C:\xampp\htdocs\crm-familyFound/controllers/viewsControllers.php 
					*/
				
					include $dir . $file;
					//echo $dir . $file;
				}
			}
		}
	}
    
	$GLOBALS["viewsControllers"] 	= new viewsControllers();
	$GLOBALS["viewsModels"] 		= new viewsModels();
	 
?>