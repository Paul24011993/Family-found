<?php
    function get_header( $header = null ) {
        require_once( DIR_MODULES . '/header' . ( $header == '' ? '' : '-' . $header ) . '.php' );
    }

    function get_footer( $footer = null ) {
        require_once( DIR_MODULES . '/footer' . ( $footer == '' ? '' : '-' . $footer ) . '.php' );
    }

    function get_bottom_bar( $bottom_bar = null ) {
        require_once( DIR_MODULES . '/bottom_bar' . ( $bottom_bar == '' ? '' : '-' . $bottom_bar ) . '.php' );
    }

    function language_attributes(){
        $idioma = substr( $_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2 );
        echo  'lang="' . $idioma . '"';
    }

    function body_class( $class = '' ) {
        // Separa los nombres de las clases con un solo espacio, clasifica los nombres de las clases para el elemento del cuerpo
        echo 'class="' . implode( ' ', get_body_class( $class ) ) . '"';
    }

    function get_body_class( $class = '' ) {
        
        $classes = array();
        $page_list = array("login", "forgotPassword", "changePassword", "resetPassword", "404");

        if(in_array($class, $page_list)){
            if ( $class == 'login' ) {
                $classes[] = 'login-layout-full login';
            }else if ( $class == 'forgotPassword' || $class == 'changePassword' || $class == 'resetPassword' ) {
                $classes[] = 'login-layout-full';
            }else if ( $class == '404' ) {
                $classes[] = 'gray-bg';
            }else if ( $class == 'home' ) {
                $classes[] = 'page-header-fixed pace-done';
            }else{
                $classes[] = 'page-header-fixed';
            }

            $file_name = basename( $class, '.php' );
            $classes[] = "{$file_name}-template";
        }
        return array_unique( $classes );
    }

    function validate_login_user(){
        if( !isset( $_COOKIE['Token_user']) ){
            echo "<script>window.location='".SERVER_URL."';</script>"; 
        }else{
            return true;
        }
    }

    function is_user_logged_in() {
        if( isset( $_COOKIE['Token_user']) ){
            return true;
        }else{
            return false;
        }
     
    }

    function json_send_success($data) {
        die(json_encode(  array('type' => 'success',  'data' => $data ) ) );
    }

    function json_send_fail($data) {
        die(json_encode(  array('type' => 'error',  'data' => $data ) ) );
    }

    function enqueue_style($handle = '', $src = '', $ver = false, $media = 'all'){
        if($handle !== ''){
            $handle = 'id="'.$handle.'"';
        }
        $type_attr = 'type="text/css"';
        printf(
            '<link %s rel="stylesheet" href="%s" %s media="%s" />',
            $handle, $src, $type_attr, $media,
        );
    }

    function enqueue_script($handle = '', $src = '', $ver = false){
        if($handle !== ''){
            $handle = 'id="'.$handle.'"';
        }
        $type_attr = 'type="text/javascript"';
        printf(
            '<script %s src="%s" %s /></script>',
            $type_attr, $src, $handle,
        );
    }

    function is_page($page, $page_whitouth_register = false){
        global $viewsControllers;
        $func_page = $viewsControllers->get_views_controllers();
        var_export($page);
        if($func_page = $page ){
            
            return true;
        }


        /*

        
        $page = array($page);
        
        if($page_whitouth_register){
            $func_page = $viewsControllers->get_views_controllers();
        }else{
            $route = explode('/', $viewsControllers->get_views_controllers());
            $func_page = substr(end($route), 0, -4);
        }
        
        if(in_array($func_page, $page)){
            var_export($func_page);
            return $func_page;
            //var_export($viewsControllers->get_views_controllers());
            //'changePassword''changePassword'
        
        }
/*
        if($func_page = $page || $page_whitouth_register){
            
            return true;
        }*/
    }

    function encryption($string){
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV),0 ,16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    
    function decryption($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    function generar_codigo_aleatorio($letra, $longitud, $num){
        for($i=1; $i<=$longitud; $i++){
            $numero = rand(0,9);
            $letra.= $numero;
        }
        return $letra.$num;
    }

    function sweet_alert($datos){
        if($datos['Alerta'] == "simple"){
            $alerta="
            <script>
            swal(
            '".$datos['Titulo']."',
            '".$datos['Texto']."',
            '".$datos['Tipo']."'
            );
            </script>
            ";
            } else if($datos['Alerta'] == "recargar"){
            $alerta="
            <script>
            swal({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
            }).then(function(){
            location.reload();
            });
            </script>
            ";
            } else if($datos['Alerta']=="limpiar"){
            $alerta="
            <script>
            swal({
            title: '".$datos['Titulo']."',
            text: '".$datos['Texto']."',
            type: '".$datos['Tipo']."',
            confirmButtonText: 'Aceptar'
            }).then(function(){
            $('.FormularioAjax')[0].reset();
            });
            </script>
            ";
        }
        return $alerta;
    }

    function fechaCastellano($fecha){
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }

    function is_ajax() {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            return true;
        }
        return false;
        
    }

    function sanitize_text_field( $str, $keep_newlines = false ) {
        if ( is_object( $str ) || is_array( $str ) ) {
            return '';
        }
     
        $str = (string) $str;
     
        $filtered = check_invalid_utf8( $str );
     
        if ( strpos( $filtered, '<' ) !== false ) {
            // This will strip extra whitespace for us.
            $filtered = wp_strip_all_tags( $filtered, false );
     
            // Use HTML entities in a special case to make sure no later
            // newline stripping stage could lead to a functional tag.
            $filtered = str_replace( "<\n", "&lt;\n", $filtered );
        }
     
        if ( ! $keep_newlines ) {
            $filtered = preg_replace( '/[\r\n\t ]+/', ' ', $filtered );
        }
        $filtered = trim( $filtered );
     
        $found = false;
        while ( preg_match( '/%[a-f0-9]{2}/i', $filtered, $match ) ) {
            $filtered = str_replace( $match[0], '', $filtered );
            $found    = true;
        }
     
        if ( $found ) {
            // Strip out the whitespace that may now exist after removing the octets.
            $filtered = trim( preg_replace( '/ +/', ' ', $filtered ) );
        }
     
        return $filtered;
    }

    function check_invalid_utf8( $string, $strip = false ) {
        $string = (string) $string;
     
        if ( 0 === strlen( $string ) ) {
            return '';
        }
     
        // Store the site charset as a static to avoid multiple calls to get_option().
        static $is_utf8 = true;
       
        if ( ! $is_utf8 ) {
            return $string;
        }
     
        // Check for support for utf8 in the installed PCRE library once and store the result in a static.
        static $utf8_pcre = null;
        if ( ! isset( $utf8_pcre ) ) {
            // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
            $utf8_pcre = @preg_match( '/^./u', 'a' );
        }
        // We can't demand utf8 in the PCRE installation, so just return the string in those cases.
        if ( ! $utf8_pcre ) {
            return $string;
        }
     
        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- preg_match fails when it encounters invalid UTF8 in $string.
        if ( 1 === @preg_match( '/^./us', $string ) ) {
            return $string;
        }
     
        // Attempt to strip the bad chars if requested (not recommended).
        if ( $strip && function_exists( 'iconv' ) ) {
            return iconv( 'utf-8', 'utf-8', $string );
        }
     
        return '';
    }

    function wp_strip_all_tags( $string, $remove_breaks = false ) {
        $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
        $string = strip_tags( $string );
     
        if ( $remove_breaks ) {
            $string = preg_replace( '/[\r\n\t ]+/', ' ', $string );
        }
     
        return trim( $string );
    }

    function esc_attr( $text ) {
        $safe_text = check_invalid_utf8( $text );
        $safe_text = _wp_specialchars( $safe_text, ENT_QUOTES );
        /**
         * Filters a string cleaned and escaped for output in an HTML attribute.
         *
         * Text passed to esc_attr() is stripped of invalid or special characters
         * before output.
         *
         * @since 2.0.6
         *
         * @param string $safe_text The text after it has been escaped.
         * @param string $text      The text prior to being escaped.
         */
        return apply_filters( 'attribute_escape', $safe_text, $text );
    }
    
    function _wp_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = 'utf-8', $double_encode = false ) {
        $string = (string) $string;
     
        if ( 0 === strlen( $string ) ) {
            return '';
        }
     
        // Don't bother if there are no specialchars - saves some processing.
        if ( ! preg_match( '/[&<>"\']/', $string ) ) {
            return $string;
        }
     
        // Account for the previous behaviour of the function when the $quote_style is not an accepted value.
        if ( empty( $quote_style ) ) {
            $quote_style = ENT_NOQUOTES;
        } elseif ( ENT_XML1 === $quote_style ) {
            $quote_style = ENT_QUOTES | ENT_XML1;
        } elseif ( ! in_array( $quote_style, array( ENT_NOQUOTES, ENT_COMPAT, ENT_QUOTES, 'single', 'double' ), true ) ) {
            $quote_style = ENT_QUOTES;
        }
     
        
     
        if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ), true ) ) {
            $charset = 'UTF-8';
        }
     
        $_quote_style = $quote_style;
     
        if ( 'double' === $quote_style ) {
            $quote_style  = ENT_COMPAT;
            $_quote_style = ENT_COMPAT;
        } elseif ( 'single' === $quote_style ) {
            $quote_style = ENT_NOQUOTES;
        }
     
     
        $string = htmlspecialchars( $string, $quote_style, $charset, $double_encode );
     
        // Back-compat.
        if ( 'single' === $_quote_style ) {
            $string = str_replace( "'", '&#039;', $string );
        }
     
        return $string;
    }
    
    function absint( $maybeint ) {
        return abs( intval( $maybeint ) );
    }
    
    function curl_request($url, $headers = array()) {
        
        $handle = curl_init();
        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($handle);
        curl_close($handle);
        return $output;
    }
    

?>