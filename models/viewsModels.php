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
				} else if($views == "forgotPassword"){
					$content = "forgotPassword";
				} else if($views == "changePassword"){
					$content = "changePassword";
				} else if($views == "resetPassword"){
					$content = "resetPassword";
				} else{
					$content = "404";
			}
			return $content;
		}

		public function get_page_template($page){
			$page_template = "";
			$page_list = array("login", "404", "forgotPassword", "changePassword", "resetPassword");

			if(in_array($page, $page_list)){
				$page_template = self::get_content_page($page, $page_list);
			}
			return $page_template;
		}
		
		public function get_content_page($page, $page_list){
			if(in_array($page, $page_list)){
				$route = $page;
				}else{
				$route = $page;
			}
			return require_once DIR_CONTENTS . $route . '.php';
		}
		
	}	