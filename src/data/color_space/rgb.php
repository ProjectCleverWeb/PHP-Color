<?php
/**
 * RGB Color Space Data Model
 * ==========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */

namespace projectcleverweb\color\data\color_space;
use projectcleverweb\color\data\color_space;
use projectcleverweb\color\convert\rgb as convert;

/**
 * RGB Color Space Data Model
 * ==========================
 * This class acts a momentary data model cache. This is so once a conversion is
 * done once for a color it won't need to be done again. (as long as the color
 * doesn't change)
 */
class rgb extends color_space {
	
	/**
	 * The name of the current color space
	 * @var string
	 */
	protected static $name = 'rgb';
	
	/**
	 * The specification for each key of the color space
	 * @var array
	 */
	protected static $specs = array(
		'r' => array(
			'name'            => 'Red',
			'min'             => 0,
			'max'             => 255,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'g' => array(
			'name'            => 'Green',
			'min'             => 0,
			'max'             => 255,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
		'b' => array(
			'name'            => 'Blue',
			'min'             => 0,
			'max'             => 255,
			'allow_negative'  => FALSE,
			'allow_float'     => FALSE,
			'overflow_method' => 'limit'
		),
	);
}
