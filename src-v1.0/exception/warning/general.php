<?php

namespace projectcleverweb\color\exception\warning;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\_interface\exception_warning;
use \projectcleverweb\color\_abstract\color_exception;

class general extends color_exception implements object, exception_warning {
	/*
	 * Default error code for this instance
	 */
	const CODE = self::E_WARNING;
}
