<?php


namespace projectcleverweb\color;

class modify {
	
	public static function red($data, $adjustment, $as_percentage, $set_absolute) {
		return static::rgb_mod($data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public static function green($data, $adjustment, $as_percentage, $set_absolute) {
		
	}
	
	public static function blue($data, $adjustment, $as_percentage, $set_absolute) {
		
	}
	
	public static function hue($data, $adjustment, $as_percentage, $set_absolute) {
		
	}
	
	public static function saturation($data, $adjustment, $as_percentage, $set_absolute) {
		
	}
	
	public static function light($data, $adjustment, $as_percentage, $set_absolute) {
		
	}
	
	public static function rgb(data $data, string $scope, float $adjustment, bool $as_percentage, bool $set_absolute) {
		$current         = array_combine(['red', 'green', 'blue'], $data->rgb);
		$scope           = strtolower($scope); // [todo] Validate scope
		$adjustment      = max(min($adjustment, 255), 0 - 255); // Force valid range
		$adjustment      = static::_convert_to_exact($adjustment, 255, $as_percentage);
		$current[$scope] = static::_convert_to_abs($current[$scope], $adjustment, $set_absolute, 0, 255);
		return static::regenerate_rgb($data, $current);
	}
	
	public static function hsl(data $data, string $scope, float $adjustment, bool $as_percentage, bool $set_absolute) {
		$current = array_combine(['hue', 'saturation', 'light'], $data->hsl->hsl);
		$scope   = strtolower($scope); // [todo] Validate scope
		$max     = 100;
		if ($scope == 'hue') {
			$max = 359;
		}
		$adjustment = max(min($adjustment, $max), 0 - $max); // Force valid range
		$adjustment = static::_convert_to_exact($adjustment, $max, $as_percentage);
		$current[$scope] = static::_convert_to_abs($current[$scope], $adjustment, $set_absolute, 0, $max);
		return static::regenerate_hsl($data, $current);
	}
	
	private static function _convert_to_exact(float $adjustment, float $max, bool $as_percentage) {
		if ($as_percentage) {
			return ($adjustment / 100) * abs($max);
		}
		return $adjustment;
	}
	
	private static function _convert_to_abs(float $current, float $adjustment, bool $set_absolute, float $min = 0, float $max = PHP_INT_MAX) {
		if ($set_absolute) {
			return abs($adjustment);
		}
		return max(min($current + $adjustment, $max), $min);
	}
	
	
}
