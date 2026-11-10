<?php

class Session
{
	
	public static function initialize() {
		@session_start();
	}
	
	public static function set(string $key, string $value) {
		$_SESSION[$key] = $value;
	}
	
	public static function get(string $key) {
		if (isset($_SESSION[$key]))
		return $_SESSION[$key];
	}
	
	/**
	 * replaces current session value with a new one
	 */
	public static function reset(string $key, string $value) {
		// unset first
		unset($_SESSION[$key]);
		// then set
		$_SESSION[$key] = $value;
	}
	
	/**
	 * destroys all sessions available
	 */
	public static function destroy() {
		unset($_SESSION);
		session_destroy();
	}
	
	
}