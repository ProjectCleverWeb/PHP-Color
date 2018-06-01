<?php

namespace projectcleverweb\color\exception\error;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\exception\error\general;

class unknown_property extends general implements object {
	/*
	 * Default error code and for this instance
	 */
	const CODE = self::E_UNKNOWN_PROPERTY;
}
