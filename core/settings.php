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
        $page_list = array("login", "recuperarClave", "ingresarRandom", "cambiarClave", "activarUsuario");

        if(in_array($class, $page_list)){
            $classes[] = 'login-layout-full login';
            }else if ( $class == '404' ) {
            $classes[] = 'gray-bg';
            }else if ( $class == 'home' ) {
            $classes[] = 'page-header-fixed pace-done';
            }else{
            $classes[] = 'page-header-fixed';
        }

        $file_name = basename( $class, '.php' );
        $classes[] = "{$file_name}-template";
        
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

    function is_page($page){
        global $viewsControllers;
        $route = explode('/', $viewsControllers->get_views_controllers());
        $func_page = substr(end($route), 0, -4);
        if($page == $func_page){
            return true;
        }
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


?>