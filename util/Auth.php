<?php

class Auth {
	public static function handleAdminLogin($dest = null){
		Session::initialize();
		
		if ((Session::get('userid') == null) || (Session::get('role') !== 'Admin' ) ) {
			Session::destroy();
			Session::initialize(); 
			CustomFunctions::locate('/');
			exit;
		}
 
	}

	 
	public static function handleLogin() {
		Session::initialize();
		 
		if (Session::get('userid') == null) {
			Session::destroy();
			Session::initialize();
			Session::set('await_login', $_SERVER["REQUEST_URI"]);
			CustomFunctions::locate('/');
			exit;
		}

			 
	}



	

}