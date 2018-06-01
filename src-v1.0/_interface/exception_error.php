<?php

namespace projectcleverweb\color\_interface;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\_interface\exception;

/**
 * Exception Error Interface
 */
interface exception_error extends object, exception {
	/*
	 * Severity code for this instance
	 */
	const SEVERITY = self::E_ERROR;
}
