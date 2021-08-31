<?php
	
	/*
        define('DB_HOST', 'localhost');
        define('DB_USUARIO', 'nacion');
        define('DB_PASSWORD', '1e4SGacv14Gj2SqAjStG72018A556');
        define('DB_NOMBRE', 'dbtaller-desarrollo');
	*/

    if ( ! defined( 'ABSPATH' ) ) {
    	define( 'ABSPATH', dirname(dirname( __FILE__ )) . '/' );
    }

	// Ruta del servidor (Rest API)
    define('SERVER_API', 'http://desarrollo.nacion-digital.com/panel/serverFamilyFoud/');
	
    
	
    // Esto construirá nuestra "URL base" ... También cuenta para HTTPS
    $base = ($_SERVER['REQUEST_SCHEME'] == 'https') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = $base.$host.$ruta."/";
     
    /* Definimos la ruta de todos los archivos*/
    define('SERVER_URL', $url );

    /* Definimos la ruta alterna para todos los archivos*/
    define('DIR_MODULES', ABSPATH . 'views/modules' );

    /* Definimos la ruta alterna para todos los archivos*/
    define('DIR_CONTENTS', ABSPATH . 'views/contents/' );

    // Nombre del proyecto
	define('NOMBRE_PROYECTO', 'FONDO FORTALEZA J&A 18 DE AGOSTO');
	
	// Establecer la zona horaria
    date_default_timezone_set('America/Guayaquil');
	
    // Constantes para el sistema
    define( 'YEAR',  date("Y") );
    define( 'MONTH', date("m") );
    define( 'DAY',   date("d") );
    
    define( 'MINUTE_IN_SECONDS', 60 );
   	define( 'HOUR_IN_SECONDS',   60 * MINUTE_IN_SECONDS );
   	define( 'DAY_IN_SECONDS',    24 * HOUR_IN_SECONDS   );
   	define( 'WEEK_IN_SECONDS',    7 * DAY_IN_SECONDS    );
   	define( 'MONTH_IN_SECONDS',  30 * DAY_IN_SECONDS    );
   	define( 'YEAR_IN_SECONDS',  365 * DAY_IN_SECONDS    );
   	
   	define( 'KB_IN_BYTES', 1024 );
   	define( 'MB_IN_BYTES', 1024 * KB_IN_BYTES );
   	define( 'GB_IN_BYTES', 1024 * MB_IN_BYTES );
   	define( 'TB_IN_BYTES', 1024 * GB_IN_BYTES );

    /* Datos para encriptacion */
    define( 'METHOD', 'AES-256-CBC' );
    
    //SECRET_KEY = $NOMBRE-EMPRESA@2021
    define( 'SECRET_KEY', '$AS@' . YEAR );//Llave secreta
    
    //SECRET_IV = solo numero
    define( 'SECRET_IV', '24011993C' );//Numero único