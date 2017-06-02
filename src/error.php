<?php
/**
 * Error Handler Class
 */

namespace projectcleverweb\color;

/**
 * Error Handler Class
 */
class error {
	
	/**
	 * Error Type Constants
	 * ====================
	 * These constants map to descriptive exception classes
	 */
	
	const GENERAL_ERROR    = 0;
	const INVALID_CONFIG   = 1;
	const INVALID_VALUE    = 2;
	const INVALID_ARGUMENT = 4;
	const INVALID_COLOR    = 8;
	const OUT_OF_RANGE     = 16;
	
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
	 * Maps each constant to a readable type string
	 * 
	 * @var array
	 */
	protected static $type_map = array(
		self::GENERAL_ERROR    => 'GENERAL',
		self::INVALID_CONFIG   => 'INVALID_CONFIG',
		self::INVALID_VALUE    => 'INVALID_VALUE',
		self::INVALID_ARGUMENT => 'INVALID_ARGUMENT',
		self::INVALID_COLOR    => 'INVALID_COLOR',
		self::OUT_OF_RANGE     => 'OUT_OF_RANGE',
	);
	
	/**
	 * Maps each constant to a descriptive exception class
	 * 
	 * @var array
	 */
	protected static $exception_map = array(
		self::GENERAL_ERROR    => __NAMESPACE__.'\\exceptions\\general_error',
		self::INVALID_CONFIG   => __NAMESPACE__.'\\exceptions\\invalid_config',
		self::INVALID_VALUE    => __NAMESPACE__.'\\exceptions\\invalid_value',
		self::INVALID_ARGUMENT => __NAMESPACE__.'\\exceptions\\invalid_argument',
		self::INVALID_COLOR    => __NAMESPACE__.'\\exceptions\\invalid_color',
		self::OUT_OF_RANGE     => __NAMESPACE__.'\\exceptions\\out_of_range',
	);
	
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
	 * @param  int    $code    The error code constant that was passed
	 * @param  string $message The message describing the error
	 * @return void
	 */
	public static function trigger(int $code, string $message) {
		if (!static::$active) {
			return;
		} elseif(static::$use_exceptions) {
			static::exception($message, $code);
		}
		static::standard($message, $code);
	}
	
	/**
	 * Throws an exception with $message
	 * 
	 * @param  string $message The message describing the error
	 * @return void
	 */
	protected static function exception(string $message, int $code = 0) {
		if (!isset(static::$exception_map[$code])) {
			throw new exceptions\general_error('Unknown error type for error: '.$message, $code);
			$code = 0;
		}
		throw new static::$exception_map[$code]($message, $code);
	}
	
	/**
	 * Triggers a E_USER_WARNING error with $message
	 * 
	 * @param  string $message The message describing the error
	 * @return void
	 */
	protected static function standard(string $message, int $code = 0) {
		if (!isset(static::$type_map[$code])) {
			trigger_error('Unknown error type for error: '.$message);
			$code = 0;
		}
		return trigger_error(sprintf('[%s] %s', static::$type_map[$code], $message), E_USER_WARNING);
	}
}
