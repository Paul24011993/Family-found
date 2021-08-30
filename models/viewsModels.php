<?php

	class viewsModels{
		protected function get_views_models($views){
			$menuList = array(
				"home",
				"users",
				"addUsers",
				"updateUser",
				"uploadImageUser",
				"profiles",
				"addProfile",
				"updateProfile",
				"groupsPartners",
				"listPartners",
				"addPartners",
				"updatePartner",
				"bankAccount",
				"applyCredit",
				"partnerContribution",
				"addContribution",
				"business",
			);
			
			if(in_array($views, $menuList)){
			    // Si el archivo existe
				if(is_file("views/contents/".$views.".php")){
				//die(var_export($menuList));
					$content = "views/contents/".$views.".php";
					}else{
				    // Si no exixte la pagina nos envia al login
					$content = "login";
				}
				} else if($views == "login"){
					$content = "login";
				} else if($views == "index"){
					$content = "login";
				} else{
					$content = "404";
			}
			return $content;
		}
		
	}	