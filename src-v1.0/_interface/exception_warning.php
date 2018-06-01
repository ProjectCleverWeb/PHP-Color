<?php

namespace projectcleverweb\color\_interface;
use \projectcleverweb\color\_interface\exception;

/**
 * Exception Warning Interface
 */
interface exception_warning extends object, exception {
	/*
	 * Severity code for this instance
	 */
	const SEVERITY = self::E_WARNING;
}
