<?php

namespace projectcleverweb\color\data\color;

class type {
	
	/**
	 * Determine the type of color being used.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function get($color) :string {
		if (is_array($color)) {
			return static::_array($color);
		} elseif (is_string($color)) {
			return static::_string($color);
		} elseif (is_int($color)) {
			return 'int';
		}
		return 'error';
	}
	
	public static function _string(string $color) {
		$color = strtolower(str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', $color));
		if (regulate::_validate_hex_str($color, TRUE)) {
			return 'hex';
		} elseif (css::get($color)) {
			return 'css';
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
}
