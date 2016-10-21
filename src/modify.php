<?php
/**
 * Color Modifier Class
 * ====================
 * Allows you to modify the various aspects of a 'color' instance
 */

namespace projectcleverweb\color;

/**
 * Color Modifier Class
 * ====================
 * Allows you to modify the various aspects of a 'color' instance
 */
class modify {
	
	public static function rgb(color $color, string $scope, float $adjustment, bool $as_percentage, bool $set_absolute) {
		$current         = array_combine(['red', 'green', 'blue'], $color->rgb);
		$scope           = strtolower($scope);
		$adjustment      = max(min($adjustment, 255), 0 - 255); // Force valid range
		$adjustment      = static::_convert_to_exact($adjustment, 255, $as_percentage);
		$current[$scope] = static::_convert_to_abs($current[$scope], $adjustment, $set_absolute, 0, 255);
		return static::regenerate_rgb($color, $current, $scope);
	}
	
	public static function hsl(color $color, string $scope, float $adjustment, bool $as_percentage, bool $set_absolute) {
		$current = array_combine(['hue', 'saturation', 'light'], $color->hsl());
		$scope   = strtolower($scope);
		$max     = 100;
		if ($scope == 'hue') {
			$max = 359;
		}
		$adjustment      = max(min($adjustment, $max), 0 - $max); // Force valid range
		$adjustment      = static::_convert_to_exact($adjustment, $max, $as_percentage);
		$current[$scope] = static::_convert_to_abs($current[$scope], $adjustment, $set_absolute, 0, $max);
		return static::regenerate_hsl($color, $current, $scope);
	}
	
	protected static function _convert_to_exact(float $adjustment, float $max, bool $as_percentage) {
		if ($as_percentage) {
			return ($adjustment / 100) * abs($max);
		}
		return $adjustment;
	}
	
	protected static function _convert_to_abs(float $current, float $adjustment, bool $set_absolute, float $min = 0, float $max = PHP_INT_MAX) {
		if ($set_absolute) {
			return abs($adjustment);
		}
		return max(min($current + $adjustment, $max), $min);
	}
	
	protected static function regenerate_rgb(color $color, array $update, string $return_offset = '') {
		$color->import_rgb([
			'r' => $update['red'],
			'g' => $update['green'],
			'b' => $update['blue']
		]);
		if (isset($update[$return_offset])) {
			return $update[$return_offset];
		}
	}
	
	protected static function regenerate_hsl(color $color, array $update, string $return_offset = '') {
		$color->import_hsl([
			'h' => $update['hue'],
			's' => $update['saturation'],
			'l' => $update['light']
		]);
		if (isset($update[$return_offset])) {
			return $update[$return_offset];
		}
	}
}
