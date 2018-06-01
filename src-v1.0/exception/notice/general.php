<?php

namespace projectcleverweb\color\exception\notice;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\_interface\exception_notice;
use \projectcleverweb\color\_abstract\color_exception;

class general extends color_exception implements object, exception_notice {
	/*
	 * Default error code for this instance
	 */
	const CODE = self::E_NOTICE;
}
