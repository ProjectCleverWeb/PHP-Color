<?php


namespace projectcleverweb\color;


class hsl {
	
	private $hsl;
	protected $accuracy;
	
	public function __construct(array $rgb_array, int $accuracy = 2) {
		$this->accuracy = $accuracy;
		$this->hsl = static::rgb_to_hsl($rgb_array['r'], $rgb_array['g'], $rgb_array['b'], $this->accuracy);
	}
	
	public static function rgb_to_hsl(int $r = 0, int $g = 0, int $b = 0, $accuracy = 2) :array {
		$r         /= 255;
		$g         /= 255;
		$b         /= 255;
		$min        = min($r, $g, $b);
		$max        = max($r, $g, $b);
		$delta_max  = $max - $min;
		$h          = 0;
		$s          = 0;
		$l          = ($max + $min) / 2;
		
		if ($delta_max != 0) {
			$s = $delta_max / ($max + $min);
			if ($l >= 0.5) {
				$s = $delta_max / (2 - $max - $min);
			}
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $delta_max);
		}
		
		return [
			'h' => round($h * 360, $accuracy),
			's' => round($s * 100, $accuracy),
			'l' => round($l * 100, $accuracy)
		];
	}
	
	private static function _rgbhsl_delta_rgb(float $rgb, float $max, float $delta_max) {
		return ((($max - $rgb) / 6) + ($delta_max / 2)) / $delta_max;
	}
	
	private static function _rgbhsl_hue(float &$h, float $r, float $g, float $b, float $max, float $delta_max) {
		$delta_r = static::_rgbhsl_delta_rgb($r, $max, $delta_max);
		$delta_g = static::_rgbhsl_delta_rgb($g, $max, $delta_max);
		$delta_b = static::_rgbhsl_delta_rgb($b, $max, $delta_max);
		
		$h = (2 / 3) + $delta_g - $delta_r;
		if ($r == $max) {
			$h = $delta_b - $delta_g;
		} elseif ($g == $max) {
			$h = (1 / 3) + $delta_r - $delta_b;
		}
		if ($h < 0) {
			$h++;
		} elseif ($h > 1) {
			$h--;
		}
	}
	
	function hsl_to_rgb(float $h = 0, float $s = 0, float $l = 0) :array {
		$s /= 100;
		$l /= 100;
		$c  = (1 - abs((2 * $l) - 1)) * $s;
		$x  = $c * (1 - abs(fmod(($h / 60), 2) - 1));
		$m  = $l - ($c / 2);
		$r  = $c;
		$g  = 0;
		$b  = $x;
		
		if ($h < 180) {
			self::_hslrgb_low($r, $g, $b, $c, $x, $h);
		} elseif ($h < 300) {
			self::_hslrgb_high($r, $g, $b, $c, $x, $h);
		}
		
		return [
			'r' => round(($r + $m) * 255),
			'g' => round(($g + $m) * 255),
			'b' => round(($b + $m) * 255)
		];
	}
	
	private static function _hslrgb_low(float &$r, float &$g, float &$b, float $c, float $x, float $h) {
		if ($h < 60) {
			$r = $c;
			$g = $x;
			$b = 0;
		} elseif ($h < 120) {
			$r = $x;
			$g = $c;
			$b = 0;
		} elseif ($h < 180) {
			$r = 0;
			$g = $c;
			$b = $x;
		}
	}
	
	private static function _hslrgb_high(float &$r, float &$g, float &$b, float $c, float $x, float $h) {
		if ($h < 240) {
			$r = 0;
			$g = $x;
			$b = $c;
		} elseif ($h < 300) {
			$r = $x;
			$g = 0;
			$b = $c;
		}
	}
}


