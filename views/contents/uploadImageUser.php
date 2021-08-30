<?php
	
	$id_url=explode("/", $_GET['views']);
	$image_encode = $id_url['1'];
	$image_decode = base64_decode($image_encode);
	 //die($image_decode);
	$valid_file_formats = array("jpg", "png", "gif", "bmp","jpeg");
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$name       = $_FILES['file']['name'];
		$size       = $_FILES['file']['size'];
		$fileError  = $_FILES['file']['error'];
		
		if($fileError == UPLOAD_ERR_OK){
			//Processes your file here
			}else{
			switch($fileError){
				case UPLOAD_ERR_INI_SIZE:   
				$message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
				break;
				case UPLOAD_ERR_FORM_SIZE:  
				$message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
				break;
				case UPLOAD_ERR_PARTIAL:    
				$message = 'Error: no terminó la acción de subir el archivo.';
				break;
				case UPLOAD_ERR_NO_FILE:    
				$message = 'Error: ningún archivo fue subido.';
				break;
				case UPLOAD_ERR_NO_TMP_DIR: 
				$message = 'Error: servidor no configurado para carga de archivos.';
				break;
				case UPLOAD_ERR_CANT_WRITE: 
				$message= 'Error: posible falla al grabar el archivo.';
				break;
				case  UPLOAD_ERR_EXTENSION: 
				$message = 'Error: carga de archivo no completada.';
				break;
				default: $message = 'Error: carga de archivo no completada.';
				break;
			}
			json_send_fail( array('message' => $message));
		}
		
		//strlen — Obtiene la longitud de un string
		if(strlen($name)) {
			//list — Asignar variables como si fueran un array
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_file_formats)) {
				
				if($size < (MB_IN_BYTES)) {
					
					$image_name = time().'_'.$_COOKIE['user_name'].".".$ext;
					
					$tmp = $_FILES['file']['tmp_name'];
					
					//The folder path for our file should be YYYY/MM/DD
					$directory = dirname(dirname(dirname(__FILE__))).'/assets/images/uploads/'.YEAR.'/'.MONTH.'/'.DAY.'/';
					
					//If the directory doesn't already exists.
					if(!is_dir($directory)){
						// directorio principal de imagenes.
						$folder_uploads = dirname(dirname(dirname(__FILE__))).'/assets/images/uploads/';
						
						//obtener los permisos de la carpeta uploads
						$check_permission_folder_uploads   = substr(decoct(fileperms($folder_uploads)), -3); // 777
						
						// directorio de la carpeta year
						$folder_year = dirname(dirname(dirname(__FILE__))).'/assets/images/uploads/'.YEAR.'/';
						
						// directorio de la carpeta month
						$folder_month = dirname(dirname(dirname(__FILE__))).'/assets/images/uploads/'.YEAR.'/'.MONTH.'/';
						
						// directorio de la carpeta month
						$folder_day = dirname(dirname(dirname(__FILE__))).'/assets/images/uploads/'.YEAR.'/'.MONTH.'/'.DAY.'/';
						
						// Validamos si la carpeta principar tiene permisos 777
						if($check_permission_folder_uploads == 777){
							
							// validamos si existe la carpeta hija(year)
							if(!is_dir($folder_year)){
								
								//creamos la carpeta year
								mkdir($folder_year, 0777, true);
								
							}
							
							// obtenemos los permisos de la carpeta year
							$check_permission_folder_year   = substr(decoct(fileperms($folder_year)), -3); // 777
							
							// Validamos si la carpeta year tiene permisos 777
							if($check_permission_folder_year != 777){
								chmod($folder_year, 0777);
							}
							
							// validamos si existe la carpeta month
							if(!is_dir($folder_month)){
								
								//creamos la carpeta year
								mkdir($folder_month, 0777, true);
							}
							
							// obtenemos los permisos de la carpeta year
							$check_permission_folder_month   = substr(decoct(fileperms($folder_month)), -3); // 777
							
							// Validamos si la carpeta year tiene permisos 777
							if($check_permission_folder_month != 777){
								chmod($folder_month, 0777);
							}
							
							if(!is_dir($folder_day)){
								//creamos la carpeta year
								mkdir($folder_day, 0777, true);
								chmod($folder_day, 0777);
							}
							
							
						}
					}
					//die('si'.$tmp. $directory.$image_decode);
					if(move_uploaded_file($tmp, $directory.substr($image_decode, 11))){
						
						setcookie('user_image', $image_decode, time() + (86400 * 30), "/"); // 86400 = 1 day
						$mainModel->json_send_success( array('message' => 'Archivo local subido correctamente' ) );
						
					}
					else
					$mainModel->json_send_fail( array('message' => 'Error al subir la importar el archivo'));
				}
				else
				$mainModel->json_send_fail( array('message' => 'El tamaño máximo de la imágen debe ser 1MB'));
			}
			else
			$mainModel->json_send_fail( array('message' => 'Formato no válido'));
		}
		else
		$mainModel->json_send_fail( array('message' => 'Seleccione una imágen'));
		exit;
	}
?>