<?php

namespace projectcleverweb\color\data;

class type {
	
	/**
	 * Determine the type of color being used.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function get($color) :string {
		if (is_object($color)) {
			return static::_object($color);
		} elseif (is_array($color)) {
			return static::_array($color);
		}
		return static::_string($color);
	}
	
	public static function _string(string $color) {
		$color = strtolower(str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', $color));
		if (validate::hex($color)) {
			return 'hex';
		} elseif (css::get($color)) {
			return 'css';
		} elseif (is_int($color)) {
			return 'int';
		}
		return 'error';
	}
	
	/**
	 * Determine the type of color being used if it is an array.
	 * 
	 * @param  array  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function _array(array $color) :string {
		$color = array_change_key_case($color);
		unset($color['a']); // ignore alpha channel
		ksort($color);
		$type  = implode('', array_keys($color));
		$types = [
			'bgr'  => 'rgb',
			'hls'  => 'hsl',
			'bhs'  => 'hsb',
			'ckmy' => 'cmyk'
		];
		if (isset($types[$type])) {
			return $types[$type];
		}
		return 'error';
	}
	
	public static function _object($color) :string {
		if (is_object($color) && is_a($color, __NAMESPACE__.'\\store')) {
			return 'object';
		}
		return 'error';
	}
}
