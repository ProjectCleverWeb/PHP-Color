<?php

namespace projectcleverweb\color\exception\warning;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\exception\warning\general;

class deprecated extends general implements object {
	/*
	 * Default error code for this instance
	 */
	const CODE = self::E_DEPRECATED;
}
