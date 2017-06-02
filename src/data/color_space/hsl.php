<?php
/**
 * HSL Color Space Data Model
 * ==========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */

namespace projectcleverweb\color\data\color_space;
use projectcleverweb\color\data\color_space;

/**
 * HSL Color Space Data Model
 * ==========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */
class hsl extends color_space {
	
	/**
	 * The name of the current color space
	 * @var string
	 */
	protected static $name = 'hsl';
	
	/**
	 * The specification for each key of the color space
	 * @var array
	 */
	protected static $specs = array(
		'h' => array(
			'name'            => 'Hue',
			'min'             => 0,
			'max'             => 359,
			'allow_negative'  => TRUE,
			'allow_float'     => FALSE,
			'overflow_method' => 'loop'
		),
		's' => array(
			'name'            => 'Saturation',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'l' => array(
			'name'            => 'Light',
			'min'             => 0,
			'max'             => 100,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
	);
}
