<?php

namespace projectcleverweb\color\_abstract;
use \projectcleverweb\color\_interface\object;
use \ErrorException;
use \projectcleverweb\color\_interface\exception;

/**
 * Exception Base Class
 */
abstract class color_exception extends ErrorException implements object, exception {
	
	/*
	 * Default error code for this instance
	 */
	const CODE     = self::E_ERROR;
	
	final public function __construct(string $message = '', string $file = __FILE__, int $line = __LINE__, exception $previous = NULL) {
		$code     = static::mapCode(static::CODE);
		if (!defined('static::SEVERITY')) {
			$severity = static::mapSeverity(static::E_ERROR);
		} else {
			$severity = static::mapSeverity(static::SEVERITY);
		}
		if (empty($message)) {
			$message = $code['description'];
		}
		parent::__construct(
			sprintf('[%s %s] %s', $code['name'], $severity['name'], $message),
			$code['id'],
			$severity['id'],
			$file,
			$line,
			$previous
		);
	}
	
	final public static function mapCode(int $code = \E_ERROR) {
		if (isset(static::CODE_MAP[$code])) {
			return static::CODE_MAP[$code];
		}
		return FALSE;
	}
	
	final public static function mapSeverity(int $code = \E_ERROR) {
		if (isset(static::SEVERITY_MAP[$code])) {
			return static::SEVERITY_MAP[$code];
		}
		return FALSE;
	}
	
	final public function getDetails() :array {
		return array(
			'message'  => $this->getMessage(),
			'file'     => $this->getFile(),
			'line'     => $this->getLine(),
			'trace'    => $this->getTrace(),
			'code'     => static::mapCode(static::CODE),
			'severity' => static::mapSeverity(static::SEVERITY),
		);
	}
}
