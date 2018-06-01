<?php

// Configure File
namespace projectcleverweb\color;
use \projectcleverweb\color\_interface\object;
use \projectcleverweb\color\_trait\configuration_support;

/**
 * Blend
 * =====
 * This class is for generating a color from 2 or more colors
 */
class blend implements object {
	use configuration_support;
	
	/**
	 * The default configuration array for this class
	 */
	const CONFIGURATION_DEFAULT = array(
		'precision' => 14, // Default for most PHP installations; Don't go higher 14 unless you know what you're doing
	);
	
	/**
	 * The default configuration array for this class
	 */
	const CONFIGURATION_SPEC = array(
		'precision' => 'range:0,32',
	);
	
	public static function from() {
		
	}
}
