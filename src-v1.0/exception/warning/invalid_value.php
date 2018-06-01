<?php

namespace projectcleverweb\color\exception\warning;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\exception\warning\general;

class invalid_value extends general implements object {
	/*
	 * Default error code and for this instance
	 */
	const CODE = self::E_INVALID_VALUE;
}
