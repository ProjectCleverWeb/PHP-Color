<?php


namespace projectcleverweb\color;

class error {
	
	/**
	 * Controls whether or not error reporting is active.
	 * @var boolean
	 */
	protected static $active = TRUE;
	
	/**
	 * Controls whether or not to use trigger_error() or to throw exceptions.
	 * @var boolean
	 */
	protected static $use_exceptions = TRUE;
	
	/**
	 * Allows the modifying of configuration vars for this class.
	 * 
	 * @param string $var   The variable to modify
	 * @param bool   $value The value to set the variable to
	 */
	public static function set(string $var, bool $value) {
		if (isset(self::$$var)) {
			static::$$var = $value;
		}
	}
	
	/**
	 * This function chooses the method to report the error if static::$active is
	 * equal to TRUE.
	 * 
	 * @param  string $message The message describing the error
	 * @return void
	 */
	public static function call(string $message) {
		if (static::$use_exceptions && static::$active) {
			static::exception($message);
		} elseif(static::$active) {
			static::trigger($message);
		}
	}
	
	/**
	 * Simply throws an exception with $message
	 * 
	 * @param  string $message The message describing the error
	 * @return void
	 */
	protected static function exception(string $message) {
		throw new \Exception($message);
	}
	
	/**
	 * Simply triggers a E_USER_WARNING error with $message
	 * 
	 * @param  string $message The message describing the error
	 * @return void
	 */
	protected static function trigger(string $message) {
		return trigger_error($message, E_USER_WARNING);
	}
	
}

