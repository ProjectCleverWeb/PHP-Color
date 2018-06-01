<?php

namespace projectcleverweb\color\_interface;
use \projectcleverweb\color\_interface\object;

/**
 * Exception Base Interface
 */
interface exception extends object {
	
	/*
	 * Possible Error Codes
	 */
	const E_ERROR                 = \E_ERROR; // = 1
	const E_WARNING               = \E_WARNING; // = 2
	const E_PARSE                 = \E_PARSE; // = 4
	const E_NOTICE                = \E_NOTICE; // = 8
	const E_DEPRECATED            = 16;
	const E_UNKNOWN_CLASS         = 32;
	const E_UNKNOWN_METHOD        = 64;
	const E_UNKNOWN_FUNCTION      = 128;
	const E_UNKNOWN_PROPERTY      = 256;
	const E_INVALID_CONFIGURATION = 512;
	const E_INVALID_VALUE         = 1024;
	
	/*
	 * Mapping for error codes
	 */
	const CODE_MAP = array(
		self::E_ERROR => array(
			'id'          => self::E_ERROR,
			'name'        => 'GENERAL',
			'description' => 'A general error occurred',
		),
		self::E_WARNING => array(
			'id'          => self::E_WARNING,
			'name'        => 'GENERAL',
			'description' => 'A general warning occurred',
		),
		self::E_NOTICE => array(
			'id'          => self::E_NOTICE,
			'name'        => 'GENERAL',
			'description' => 'A general notice occurred',
		),
		self::E_PARSE => array(
			'id'          => self::E_PARSE,
			'name'        => 'PARSE',
			'description' => 'An input was unable to be parsed',
		),
		self::E_DEPRECATED => array(
			'id'          => self::E_DEPRECATED,
			'name'        => 'DEPRECATED',
			'description' => 'The function, method, or class called is deprecated',
		),
		self::E_UNKNOWN_CLASS => array(
			'id'          => self::E_UNKNOWN_CLASS,
			'name'        => 'UNKNOWN CLASS',
			'description' => 'The class called is not defined',
		),
		self::E_UNKNOWN_METHOD => array(
			'id'          => self::E_UNKNOWN_METHOD,
			'name'        => 'UNKNOWN METHOD',
			'description' => 'The method called is not defined',
		),
		self::E_UNKNOWN_FUNCTION => array(
			'id'          => self::E_UNKNOWN_FUNCTION,
			'name'        => 'UNKNOWN FUNCTION',
			'description' => 'The function called is not defined',
		),
		self::E_UNKNOWN_PROPERTY => array(
			'id'          => self::E_UNKNOWN_PROPERTY,
			'name'        => 'UNKNOWN PROPERTY',
			'description' => 'The property called is not defined',
		),
		self::E_INVALID_CONFIGURATION => array(
			'id'          => self::E_INVALID_CONFIGURATION,
			'name'        => 'INVALID CONFIGURATION',
			'description' => 'A function, method, or class was not configured correctly',
		),
		self::E_INVALID_VALUE => array(
			'id'          => self::E_INVALID_VALUE,
			'name'        => 'INVALID VALUE',
			'description' => 'The value supplied is invalid',
		),
	);
	
	/*
	 * Mapping for severity codes
	 */
	const SEVERITY_MAP = array(
		self::E_ERROR => array(
			'id'          => self::E_ERROR,
			'name'        => 'ERROR',
			'description' => 'An error that cannot be recovered from has occurred. Continuing script execution could have unexpected results.',
			'notes'       => 'This should only be triggered when script execution should be stopped or when it\'s possible that continuing execution will cause damage or have unexpected results.',
		),
		self::E_WARNING => array(
			'id'          => self::E_WARNING,
			'name'        => 'WARNING',
			'description' => 'An error that can be recovered from has occurred. Continuing script execution is ok but may not be advised.',
			'notes'       => 'This should be triggered when script execution is generally ok, but may have side-effects, is deprecated, and/or some input was invalid but was handled.',
		),
		self::E_NOTICE => array(
			'id'          => self::E_NOTICE,
			'name'        => 'NOTICE',
			'description' => 'An error that can be recovered from has occurred. The script should always continue execution.',
			'notes'       => 'This should only be triggered when script execution is ok. These are typically reserved specifically for when debugging or when notifying the user that something is not efficient',
		),
	);
	
	public function __construct(string $message = '', string $file = __FILE__, int $line = __LINE__, exception $previous = NULL);
	
	public static function mapCode(int $code = \E_ERROR);
	
	public static function mapSeverity(int $code = \E_ERROR);
	
	public function getDetails() :array;
}
