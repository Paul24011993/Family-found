<?php
	
	class viewsControllers extends viewsModels{
	
		public function get_template_controller(){
			return require_once( dirname(__DIR__) . '/views/template.php' );
		}
		
		public function get_views_controllers(){
			if(isset($_GET['views'])){
				$route = explode('/', $_GET['views']);
				$reply = self::get_views_models($route[0]);
			}else{
				$reply = 'login';
			}
			return $reply;
		}
	
	}