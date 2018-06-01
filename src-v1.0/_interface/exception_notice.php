<?php

namespace projectcleverweb\color\_interface;
use \projectcleverweb\color\_interface\exception;

/**
 * Exception Notice Interface
 */
interface exception_notice extends object, exception {
	/*
	 * Severity code for this instance
	 */
	const SEVERITY = self::E_NOTICE;
}
