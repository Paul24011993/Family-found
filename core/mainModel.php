<?php
	
    class mainModel{
		
		public function get_page_template($page){
			$page_template="";
			if($page == "login" || $page == "404" || $page == "recuperarClave" || $page == "solicitarCuenta" || $page == "ingresarRandom"  || $page == "cambiarClave" || $page == "activarUsuario"){
				$page_template = self::get_content_page($page);
			}
			return $page_template;
		}
		
		public function get_content_page($page){
			//$peticionAjax = true;
			if($page == "login"){
				$route = 'views/contents/login.php';
				}else if($page == "recuperarClave"){
				$route = 'views/contents/recuperarClave.php';
				}else if($page == "solicitarCuenta"){
				$route = 'views/contents/solicitarCuenta.php';
				}else if($page == "ingresarRandom"){
				$route = 'views/contents/ingresarRandom.php';
				}else if($page == "cambiarClave"){
				$route = 'views/contents/cambiarClave.php';
				}else if($page == "activarUsuario"){
				$route = 'views/contents/activarUsuario.php';
				}else if($page == "lockscreen"){
				$route = 'views/contents/lockscreen.php';
				}else{
				$route = 'views/contents/404.php';
			}
			return require_once $route;
		}
		
		//encriptar contrasenia
		public function encryption($string){
            $output = FALSE;
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV),0 ,16);
            $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;
		}
		
		//desencriptar contrasenia
		public function decryption($string){
		    $key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}
		//numeros aleatorios
		protected function generar_codigo_aleatorio($letra, $longitud, $num){
			for($i=1; $i<=$longitud; $i++){
				$numero = rand(0,9);
				$letra.= $numero;
			}
			return $letra.$num;
		}
		
		protected function limpiar_cadena($cadena){
            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);
            $cadena = str_ireplace("<script>", "", $cadena);
            $cadena = str_ireplace("</script src>", "", $cadena);
            $cadena = str_ireplace("</script type=>", "", $cadena);
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("DELETE FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("--", "", $cadena);
            $cadena = str_ireplace("^", "", $cadena);
            $cadena = str_ireplace("[", "", $cadena);
            $cadena = str_ireplace("]", "", $cadena);
            $cadena = str_ireplace("==", "", $cadena);
            $cadena = str_ireplace(";", "", $cadena);
            return $cadena;
		}
		
		protected function sweet_alert($datos){
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
	
		public function fechaCastellano($fecha){
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
		
		
		/*
			public function conectar(){
            try {
			$enlace = new PDO(DB_SGDB, DB_USER, DB_PASSWORD);
			//encode utf8 to characters specials
			$enlace->exec("SET NAMES utf8");
			return $enlace;  
			} catch (PDOException $e) {
			echo ('Falló la conexión: ' . $e->getMessage());
			}
			}
			
			public function ejecutar_consulta_simple($consulta){
			$respuesta = self::conectar()->prepare($consulta);
			$respuesta->execute();
			return $respuesta;
			}
			
			
			
			public function validar_redundacia_correo($datosVI){
		    
		    $sql_correo = self::conectar()->prepare("SELECT * FROM tbl_usuarios WHERE USU_EMAIL=:Correo ");
            $sql_correo->bindParam(":Correo", $datosVI['valorcorreo']);
            $sql_correo->execute();
            
            if($sql_correo->rowCount()>=1) {
			$sql = [
			'codigo' => 1,
			'tipo' => 'has-error',
			'mensaje' => 'Este registro ya se encuentra en la base de datos'
			];
			}else{
			
			$sql = [
			'codigo' => 0,
			'tipo' => 'has-success',
			'mensaje' => 'Disponible'
			];
			}
			return json_encode($sql);
			}
			
			public function validar_redundacia_cedula($datosVI){
			
			$sql_cedula = self::conectar()->prepare("SELECT * FROM tbl_usuarios WHERE USU_DNI=:Cedula ");
			$sql_cedula->bindParam(":Cedula", $datosVI['valorcedula']);
			$sql_cedula->execute();
			
			if($sql_cedula->rowCount()>=1) {
			$sql = [
			'codigo' => 1,
			'tipo' => 'has-error',
			'mensaje' => 'Este registro ya se encuentra en la base de datos'
			];
			}else{
			$sql = [
			'codigo' => 0,
			'tipo' => 'has-success',
			'mensaje' => 'Disponible'
			];
			}
			return json_encode($sql);
			}
			
			public function agregar_direccion($campo,$id){
			$sql = self::conectar()->prepare("INSERT INTO tbl_direccion ($campo) VALUES(:USU_ID)");
			$sql->bindParam(":USU_ID", $id);
			$sql->execute();
			return $sql;   
			}
			
			
			public function enviarEmail($correo, $nombre, $asunto, $cuerpo, $template, $location){
			if($location == 1){
			require  '../ta-views/includes/PHPMailer/PHPMailerAutoload.php';
			//die('last id 2 '.$correo. $nombre. $asunto. $cuerpo. $template. $location);
			}else if($location == 2){
			//die($correo. $nombre. $asunto. $cuerpo. $template. $location);
			require  './ta-views/includes/PHPMailer/PHPMailerAutoload.php';
			}
			
			$mail = new PHPMailer;
			
			$mail->isSMTP();                                			//Establecer el correo electrónico para utilizar SMTP
			$mail->Host = 'ssl://smtp.gmail.com';           			//Especificar el servidor de correo a utilizar
			$mail->SMTPAuth = true;                         			//Habilitar la autenticacion con SMTP
			$mail->Username = 'paulsandoval44@gmail.com';   			//Correo electronico saliente ejemplo: tucorreo@gmail.com
			$mail->Password = 'polo1234567';                			//Tu contraseña de gmail
			$mail->SMTPSecure = 'ssl';                  				//Habilitar encriptacion, `ssl` es aceptada
			$mail->Port = 465;                              			//Puerto TCP  para conectarse
			
			$mail->setFrom('paulsandoval44@gmail.com', COMPANY);
			$mail->addAddress($correo, $nombre);     
			
			$message = file_get_contents($template);
			$message = str_replace('{{first_name}}', $nombre, $message);
			$message = str_replace('{{message}}', $cuerpo, $message);
			$message = str_replace('{{customer_email}}', $correo, $message);
			$mail->isHTML(true);										// Establecer el formato de correo electrónico en HTML
			
			$mail->Subject = $asunto;
			$mail->msgHTML($message);
			
			$mail->CharSet = 'UTF-8';									//Activo condificacción utf-8
			
			if(!$mail->send()) {
			return false;
			} else {
			return true;
			}	
			}
			
			protected function guardar_bitacora($datos){
			
			$sql = self::conectar()->prepare("INSERT INTO tbl_bitacora (BIT_CODIGO,BIT_FECHA,BIT_FECHA_FINAL,BIT_HORA_INICIO,BIT_HORA_FINAL,BIT_TIPO,BIT_ANIO,BIT_USUARIO) 
			VALUES (:Codigo, :Fecha, :Fecha_final, :HoraInicio, :HoraFinal, :Tipo, :Year, :Cuenta) ");
			
			$sql->bindParam(":Codigo", $datos['Codigo']);
			$sql->bindParam(":Fecha", $datos['Fecha']);
			$sql->bindParam(":Fecha_final", $datos['Fecha_final']);
			$sql->bindParam(":HoraInicio", $datos['HoraInicio']);
			$sql->bindParam(":HoraFinal", $datos['HoraFinal']);
			$sql->bindParam(":Tipo", $datos['Tipo']);
			$sql->bindParam(":Year", $datos['Year']);
			$sql->bindParam(":Cuenta", $datos['Cuenta']);
			$sql->execute();
			return $sql;   
			}
			
			protected function actualizar_bitacora($codigo,$hora){
			$sql = self::conectar()->prepare("UPDATE tbl_bitacora SET BIT_HORA_FINAL=:Hora WHERE BIT_CODIGO=:Codigo");
			$sql->bindParam(":Hora", $hora);
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;   
			}
			
			protected function eliminar_bitacora($codigo){
			$sql = self::conectar()->prepare("DELETE FROM tbl_bitacora WHERE BIT_CODIGO=:Codigo");
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;   
			}
			
			function getTokenByUsername($username,$expired) {
			$sql = self::conectar()->prepare("SELECT * FROM tbl_bitacora BITA LEFT JOIN tbl_usuarios USU ON BITA.BIT_USUARIO = USU.USU_USUARIO WHERE BITA.BIT_USUARIO = :Usuario AND BITA.BIT_FECHA_FINAL = :Fecha_final");
			$sql->bindParam(":Usuario", $username);
			$sql->bindParam(":Fecha_final", $expired);
			$sql->execute();
			return $sql;
			}
			
			
			function markAsExpired($tokenId) {
			$expired = 1;
			$sql = self::conectar()->prepare("UPDATE tbl_bitacora SET BIT_FECHA_FINAL=:Fecha_final WHERE BIT_ID=:Codigo");
			$sql->bindParam(":Fecha_final", $expired);
			$sql->bindParam(":Codigo", $tokenId);
			$sql->execute();
			return $sql;
			}
			
			public function getToken($length){
			$token = "";
			$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
			$codeAlphabet .= "0123456789";
			$max = strlen($codeAlphabet) - 1;
			for ($i = 0; $i < $length; $i ++) {
			$token .= $codeAlphabet[self::cryptoRandSecure(0, $max)];
			}
			return $token;
			}
			
			public function cryptoRandSecure($min, $max){
			$range = $max - $min;
			if ($range < 1) {
			return $min; // not so random...
			}
			$log = ceil(log($range, 2));
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
			} while ($rnd >= $range);
			return $min + $rnd;
			}
			
			
			public function clearAuthCookie() {
			if (isset($_COOKIE["login_usuario"])) {
			setcookie("login_usuario", "");
			}
			if (isset($_COOKIE["random_password"])) {
			setcookie("random_password", "");
			}
			if (isset($_COOKIE["random_selector"])) {
			setcookie("random_selector", "");
			}
			}
			
			/*	public function valor_estadistica($condicion1){
			$query=self::conectar()->prepare("SELECT COUNT(*) as total FROM $condicion1");
			$query->execute();
			
			if ($query->rowCount() >= 1){
			$valor = $query->fetch();
			}
			return $valor['total'];
		}*/
		
		/*public function conectar_email(){
			$imap = imap_open (imapPath,username,password) or die("No Se Pudo Conectar Al Servidor:" . imap_last_error());
			return $imap;  
			
			}
			
			
			
			
			
			protected function eliminar_administrador($codigo){
			$sql = self::conectar()->prepare("DELETE FROM tbl_usuarios WHERE USU_ID= :Codigo");
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;   
			}
			
			//Function definition
			
			public function timeAgo($time_ago){
			
			$time_ago = strtotime($time_ago);
			$cur_time   = time();
			$time_elapsed   = $cur_time - $time_ago;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
			return "justo ahora";
			}
			//Minutes
			else if($minutes <=60){
			if($minutes==1){
			return "hace un minuto";
			}
			else{
			return "hace $minutes minutos";
			}
			}
			//Hours
			else if($hours <=24){
			if($hours==1){
			return "hace una hora";
			}else{
			return "hace $hours horas";
			}
			}
			//Days
			else if($days <= 7){
			if($days==1){
			return "ayer";
			}else{
			return "hace $days dias";
			}
			}
			//Weeks
			else if($weeks <= 4.3){
			if($weeks==1){
			return "hace una semana";
			}else{
			return "hace $weeks semanas";
			}
			}
			//Months
			else if($months <=12){
			if($months==1){
			return "hace un mes";
			}else{
			return "hace $months meses";
			}
			}
			//Years
			else{
			if($years==1){
			return "hace un año";
			}else{
			return "hace $years años";
			}
			}
			}	
			
			
			protected function eliminar_direccion_administrador($codigo){
			$sql = self::conectar()->prepare("DELETE FROM tbl_direccion WHERE USU_ID= :Codigo");
			$sql->bindParam(":Codigo", $codigo);
			$sql->execute();
			return $sql;   
			}
			
			
			public function validaIdToken($datosRuta){
			$stmt = self::conectar()->prepare("SELECT USU_ACTIVO FROM tbl_usuarios WHERE USU_ID = :idUsuario AND USU_TOKEN = :token LIMIT 1");
			$stmt->bindParam(":idUsuario",$datosRuta['idUsuario']);
			$stmt->bindParam(":token", $datosRuta['token']);
			$stmt->execute();
			
			if($stmt->rowCount() >= 1) {
			$last_id = $stmt->fetch();
			
			
			if($last_id['USU_ACTIVO'] == 1){
			$datosMSG = [					
			'mensaje'=>'La cuenta ya se activo anteriormente.',
			'contexto'=>'',
			'icono'=>'<i class="icon fa fa-exclamation-circle" aria-hidden="true"></i>'
			];
			} else if($last_id['USU_ACTIVO'] == 2){
			$datosMSG = [					
			'mensaje'=>'La cuenta ya se activo anteriormente por favor inicie sesion y actualice su contraseña .',
			'contexto'=>'',
			'icono'=>'<i class="icon fa fa-exclamation-circle" aria-hidden="true"></i>'
			];
			}else if($last_id['USU_ACTIVO'] == 3){
			
			if(self::activarUsuario($datosRuta['idUsuario'])){
			
			$datosMSG = [
			'mensaje'=>'Cuenta activada.',
			'contexto'=>'Hemos finalizado el proceso de registro y activación de su cuenta, en este momento puede iniciar sesion y empezar a trabajar con nosotros.',
			'icono'=>'<i class="icon fa fa-handshake-o" aria-hidden="true"></i>'
			];
			} else {
			$datosMSG = [
			'mensaje'=>'Error al Activar Cuenta.',
			'contexto'=>'',
			'icono'=>'<i class="icon fa fa-close" aria-hidden="true"></i>'
			];
			}
			} else {
			$datosMSG = [
			'mensaje'=>'No existe el registro para activar.',
			'contexto'=>'Lo sentimos, pero el usuario que intenta activar no existe por favor, comuníquese con el administrador',
			'icono'=>'<i class="icon fa fa-ban" aria-hidden="true"></i>'
			];
			}
			}
			return $datosMSG;
			}
			
			public function activarUsuario($id){
			
			
			$stmt = self::conectar()->prepare("UPDATE tbl_usuarios SET USU_ACTIVO = 2 WHERE USU_ID = :idUsuario");
			$stmt->bindParam(':idUsuario', $id);
			$stmt->execute();
			//$stmt->close();
			return $stmt;
			}
			
			public function actualizar_random($random,$idUsuario){
			
			$stmt = self::conectar()->prepare("UPDATE tbl_usuarios SET USU_RANDOM = :Random WHERE USU_ID = :idUsuario");
			$stmt->bindParam(':Random', $random);
			$stmt->bindParam(':idUsuario', $idUsuario);
			$stmt->execute();
			
			return $stmt;
			}	
			
			public function isNullLogin($usuario, $clave){
			if(strlen(trim($usuario)) < 1 || strlen(trim($clave)) < 1){
			$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrio un error inesperado",
			"Texto"=>"Debe llenar todos los campos",
			"Tipo"=>"error"
			];
			}	
			return self::sweet_alert($alerta);
			}	
			
			public function isEmail($email){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
			}
			}
			
			public function emailExiste($email){
			
			$sql = self::conectar()->prepare("SELECT USU_ID FROM tbl_usuarios WHERE USU_EMAIL = :Correo LIMIT 1");
			$sql->bindParam(":Correo", $email);
			$sql->execute();
			
			return $sql;
			}
			/*
			public function generateToken(){
			die('test3');
			$gen = md5(uniqid(mt_rand(), true));	
			return $gen;
		}*/
		
		/*public function generaTokenPass($user_id){
			$token = md5(uniqid(mt_rand(), false));
			//die('test2'.$token);
			$stmt = self::conectar()->prepare("UPDATE tbl_usuarios SET USU_TOKEN_CLAVE= :Token, USU_SOLICITUD_CLAVE=1 WHERE USU_ID = :idUsuario");
			$stmt->bindParam(':Token', $token);
			$stmt->bindParam(':idUsuario', $user_id);
			$stmt->execute();
			//$stmt->close();
			
			return $token;
			}
			
			public function verificaTokenPass($codigo, $token){
			$stmt = self::conectar()->prepare("SELECT USU_ACTIVO FROM tbl_usuarios WHERE USU_ID = :idUsuario AND USU_TOKEN_CLAVE = :Token AND USU_SOLICITUD_CLAVE = 1 LIMIT 1");
			$stmt->bindParam(':idUsuario', $codigo);
			$stmt->bindParam(':Token', $token);
			$stmt->execute();
			
			if ($stmt->rowCount() >= 1){
			$estado = $stmt->fetch();
			if($estado['USU_ACTIVO'] == 1 || $estado['USU_ACTIVO'] == 3){
			return true;
			} else {
			return false;
			}
			} else {
			return false;	
			}
			}
			
			public function descripcion_empresa(){
			$query=self::conectar()->prepare("SELECT EMP_DESCRIPCION FROM tbl_perfil_empresa");
			$query->execute();
			
			if ($query->rowCount() >= 1){
			$estado22 = $query->fetch();
			}
			return $estado22['EMP_DESCRIPCION'];
			}
			
			public function valor_estadistica($condicion1){
			$query=self::conectar()->prepare("SELECT COUNT(*) as total FROM $condicion1");
			$query->execute();
			
			if ($query->rowCount() >= 1){
			$estado22 = $query->fetch();
			}
			return $estado22['total'];
			}
			
			//OBTENER DATOS PARA EL INIDICADOR
			public function get_row_indicadores($condicion1, $condicion2){
			$query=self::conectar()->prepare("SELECT COUNT(*) as total FROM tbl_proformas WHERE PROF_FECHA_EMISION >= :Condicion1 AND PROF_FECHA_EMISION < :Condicion2");
			$query->bindParam(':Condicion1', $condicion1);
			$query->bindParam(':Condicion2', $condicion2);
			$query->execute();
			
			if ($query->rowCount() >= 1){
			$estado22 = $query->fetch();
			}
			return $estado22['total'];
			}
			
			public function cargar_drilldown_indicadores($FechaInicio, $FechaFin){
			$query=self::conectar()->prepare("SELECT count(*)as total, PROF_FECHA_EMISION FROM tbl_proformas WHERE PROF_FECHA_EMISION >= :FechaInicio AND PROF_FECHA_EMISION < :FechaFin GROUP by PROF_FECHA_EMISION");
			
			$query->bindParam(':FechaInicio', $FechaInicio);
			$query->bindParam(':FechaFin', $FechaFin);
			$query->execute();
			
			$datos=$query->fetchAll();
			
			if ($query->rowCount() >= 1){
			foreach($datos as $rows){
			echo "['".$rows['PROF_FECHA_EMISION']."',".$rows['total']."],";
			}
			}
			}
			
			
			public function listar_proformas_dashboard(){
			$tabla="";
			
			$consulta1="SELECT * FROM tbl_proformas PROF LEFT JOIN tbl_marcas MAR ON PROF.MAR_ID = MAR.MAR_ID ORDER BY PROF_ID DESC LIMIT 5";
			
			$conexion = mainModel::conectar();
			
			$datos=$conexion->query($consulta1);
			$datos=$datos->fetchAll();
			
			foreach($datos as $rows){
			
			$tabla.='
			<div class="feed-element margin-transition">
			<div class="media-body "> 
			<small class="pull-right text-navy">'.mainModel::timeAgo($rows['PROF_FECHA_EMISION']).'</small> 
			<strong>'.$rows['MAR_DESCRIPCION'].'</strong> | <b class="text-danger">'.$rows['PROF_NUMERO_DOCUMENTO'].'</b> <br>
			<small class="text-muted">'.$rows['PROF_PLACA'].' - '.$rows['PROF_VALOR_TOTAL'].'</small>
			</div>
			<div class="actions"> 
			<a class="btn btn-xs btn-white">
			<i class="fa fa-pencil"></i> Editar 
			</a> 
			<a class="btn btn-xs btn-white">
			<i class="fa fa-print"></i> Imprimir
			</a> 
			</div>
			</div>
			';
			}
			
			return $tabla;   
			}
			
			
			public function listar_tareas_calendario(){
			$consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM tbl_eventos WHERE EVE_ESTADO = '1'");
			
			$datos=$consulta1->fetchAll();
			
			foreach($datos as $rows){
			$eventos.='<div class="fc-event">'.$rows['EVE_TITULO'].'</div>';
			}
			
			return $eventos;   
			}
			
			
			
			
			public function hashPassword($password){
			$hash = password_hash($password, PASSWORD_DEFAULT);
			return $hash;
			}
			
			public function generateToken(){
			$gen = md5(uniqid(mt_rand(), false));	
			return $gen;
			}
			
			function rNumero($l = 6){ 
			$c = "123456789"; 
			for(;$l > 0;$l--) $s .= $c{rand(0,strlen($c))}; 
			return str_shuffle($s); 
			} 	
			
			public function lista_eventos_controlador(){ 
			$query=self::conectar()->prepare("SELECT EVE_DESCRIPCION,EVE_PRIORIDAD,EVE_FIN,EVE_FECHA_CREACION,(SELECT COUNT(*) FROM tbl_eventos WHERE EVE_ESTADO = '1')as total FROM tbl_eventos WHERE EVE_ESTADO = '1'");
			$query->execute();
			return $query;
			}
			
			public function lista_eventos_total_controlador(){ 
			$query=self::conectar()->prepare("SELECT COUNT(*)as total FROM tbl_eventos WHERE EVE_ESTADO = '1'");
			$query->execute();
			return $query;
			}		
			
			public function actualizar_fecha_eventos_finalizados(){ 
			$query=self::conectar()->prepare("UPDATE tbl_eventos SET EVE_ESTADO = '0' WHERE EVE_FIN < NOW()");
			$query->execute();
			return $query;
			}	
			
			public function mostrar_eventos_de_hoy(){ 
			$query=self::conectar()->prepare("SELECT COUNT(*) AS EVENTOS_HOY FROM tbl_eventos WHERE DATE(EVE_FIN)=CURDATE()");
			$query->execute();
			return $query;
			}
			
			public function fechaCastellano($fecha){
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
		*/
	}					