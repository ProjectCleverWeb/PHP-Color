<?php
/**
 * CMYK Color Space Data Model
 * ===========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */

namespace projectcleverweb\color\data\color_space;
use projectcleverweb\color\data\color_space;

/**
 * CMYK Color Space Data Model
 * ===========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */
class cmyk extends color_space {
	
	/**
	 * The name of the current color space
	 * @var string
	 */
	protected static $name = 'cmyk';
	
	/**
	 * The specification for each key of the color space
	 * @var array
	 */
	protected static $specs = array(
		'c' => array(
			'name'            => 'Cyan',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'm' => array(
			'name'            => 'Magenta',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'y' => array(
			'name'            => 'Yellow',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'k' => array(
			'name'            => 'Black',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		)
	);
}
