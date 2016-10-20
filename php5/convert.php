<?php
/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */

namespace projectcleverweb\color;

/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */
class convert {
	
	/**
	 * Convert a hex string (no #) to a RGB array
	 * 
	 * @param  string $hex The hex string to convert (no #)
	 * @return array       The RGB array
	 */
	public static function hex_to_rgb($hex = '000000') {
		regulate::hex($hex);
		return array(
			'r' => hexdec(substr($hex, 0, 2)),
			'g' => hexdec(substr($hex, 2, 2)),
			'b' => hexdec(substr($hex, 4, 2))
		);
	}
	
	/**
	 * Convert a RBA array to a hex string
	 * 
	 * @param  int    $r The red value (0 - 255)
	 * @param  int    $g The green value (0 - 255)
	 * @param  int    $b The blue value (0 - 255)
	 * @return string    The resulting hex string
	 */
	public static function rgb_to_hex($r = 0, $g = 0, $b = 0) {
		return strtoupper(
			str_pad(dechex($r), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($g), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($b), 2, '0', STR_PAD_LEFT)
		);
	}
	
	/**
	 * Convert a RBA array to a CMYK array
	 * 
	 * @param  float $r The red value (0 - 255)
	 * @param  float $g The green value (0 - 255)
	 * @param  float $b The blue value (0 - 255)
	 * @return array    The resulting CMYK array
	 */
	public static function rgb_to_cmyk($r = 0.0, $g = 0.0, $b = 0.0) {
		$c  = (255 - $r) / 255 * 100;
		$m  = (255 - $g) / 255 * 100;
		$y  = (255 - $b) / 255 * 100;
		$k  = min(array($c,$m,$y));
		$c -= $k;
		$m -= $k;
		$y -= $k;
		return array(
			'c' => round($c),
			'm' => round($m),
			'y' => round($y),
			'k' => round($k)
		);
	}
	
	/**
	 * Convert a CMYK array to a RGB array
	 * 
	 * @param  float $c The cyan value (0 - 100)
	 * @param  float $m The magenta value (0 - 100)
	 * @param  float $y The yellow value (0 - 100)
	 * @param  float $k The key (black) value (0 - 100)
	 * @return array    The resulting RGB array
	 */
	public static function cmyk_to_rgb($c = 0.0, $m = 0.0, $y = 0.0, $k = 0.0) {
		$c /= 100;
		$m /= 100;
		$y /= 100;
		$k /= 100;
		$r  = 1 - min(1, $c * (1 - $k) + $k);
		$g  = 1 - min(1, $m * (1 - $k) + $k);
		$b  = 1 - min(1, $y * (1 - $k) + $k);
		return array(
			'r' => round($r * 255),
			'g' => round($g * 255),
			'b' => round($b * 255)
		);
	}
	
	/**
	 * Convert a RGB array to a HSL array
	 * 
	 * @param  float $r The red value (0 - 255)
	 * @param  float $g The green value (0 - 255)
	 * @param  float $b The blue value (0 - 255)
	 * @return array    The resulting HSL array
	 */
	public static function rgb_to_hsl($r = 0, $g = 0, $b = 0, $accuracy = 2) {
		$r    /= 255;
		$g    /= 255;
		$b    /= 255;
		$min   = min($r, $g, $b);
		$max   = max($r, $g, $b);
		$delta = $max - $min;
		$h     = 0;
		$s     = 0;
		$l     = ($max + $min) / 2;
		
		if ($max != $min) {
			$s = $delta / ($max + $min);
			if ($l >= 0.5) {
				$s = $delta / (2 - $max - $min);
			}
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $delta);
		}
		
		return array(
			'h' => round($h * 360, $accuracy),
			's' => round($s * 100, $accuracy),
			'l' => round($l * 100, $accuracy)
		);
	}
	
	/**
	 * Color delta algorithm
	 * 
	 * @param  float $rgb   The R, G, or B value
	 * @param  float $max   The max RGB value
	 * @param  float $delta The delta value ($max - $min)
	 * @return float        The color delta
	 */
	protected static function _rgbhsl_delta_rgb($rgb, $max, $delta) {
		return ((($max - $rgb) / 6) + ($delta / 2)) / $delta;
	}
	
	/**
	 * Calculate the hue as a percentage from RGB
	 * 
	 * @param  float &$h    The variable to modify as hue
	 * @param  float $r     The red value as a percentage
	 * @param  float $g     The green value as a percentage
	 * @param  float $b     The blue value as a percentage
	 * @param  float $max   The max RGB value
	 * @param  float $delta The delta value ($max - $min)
	 * @return void
	 */
	protected static function _rgbhsl_hue(&$h, $r, $g, $b, $max, $delta) {
		$delta_r = static::_rgbhsl_delta_rgb($r, $max, $delta);
		$delta_g = static::_rgbhsl_delta_rgb($g, $max, $delta);
		$delta_b = static::_rgbhsl_delta_rgb($b, $max, $delta);
		
		$h = (2 / 3) + $delta_g - $delta_r;
		if ($r == $max) {
			$h = $delta_b - $delta_g;
		} elseif ($g == $max) {
			$h = (1 / 3) + $delta_r - $delta_b;
		}
		if ($h < 0) {
			$h++;
		}
	}
	
	/**
	 * Convert a HSL array to a RGB array
	 * 
	 * @param  float  $h The hue value (0 - 360)
	 * @param  float  $s The saturation value (0 - 100)
	 * @param  float  $l The light value (0 - 100)
	 * @return array     The resulting RGB array
	 */
	public static function hsl_to_rgb($h = 0.0, $s = 0.0, $l = 0.0) {
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
		
		return array(
			'r' => (int) round(($r + $m) * 255),
			'g' => (int) round(($g + $m) * 255),
			'b' => (int) round(($b + $m) * 255)
		);
	}
	
	/**
	 * Handle low hue values
	 * 
	 * @param  float  &$r The red value to modify
	 * @param  float  &$g The green value to modify
	 * @param  float  &$b The blue value to modify
	 * @param  float  $c  Potential R, G, or B value
	 * @param  float  $x  Potential R, G, or B value
	 * @param  float  $h  The hue
	 * @return void
	 */
	private static function _hslrgb_low(&$r, &$g, &$b, $c, $x, $h) {
		if ($h < 60) {
			$r = $c;
			$g = $x;
			$b = 0;
		} elseif ($h < 120) {
			$r = $x;
			$g = $c;
			$b = 0;
		} else {
			$r = 0;
			$g = $c;
			$b = $x;
		}
	}
	
	/**
	 * Handle high hue values
	 * 
	 * @param  float  &$r The red value to modify
	 * @param  float  &$g The green value to modify
	 * @param  float  &$b The blue value to modify
	 * @param  float  $c  Potential R, G, or B value
	 * @param  float  $x  Potential R, G, or B value
	 * @param  float  $h  The hue
	 * @return void
	 */
	private static function _hslrgb_high(&$r, &$g, &$b, $c, $x, $h) {
		if ($h < 240) {
			$r = 0;
			$g = $x;
			$b = $c;
		} else {
			$r = $x;
			$g = 0;
			$b = $c;
		}
	}
	
	/**
	 * Convert a RGB array to a HSB array
	 * 
	 * @param  float $r The red value (0 - 255)
	 * @param  float $g The green value (0 - 255)
	 * @param  float $b The blue value (0 - 255)
	 * @return array    The resulting HSB array
	 */
	public static function rgb_to_hsb($r = 0.0, $g = 0.0, $b = 0.0, $accuracy = 3) {
		$r /= 255;
		$g /= 255;
		$b /= 255;
		
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		$v   = $max;
		$d   = $max - $min;
		$s   = regulate::div($d, $max);
		$h   = 0; // achromatic
		if ($max != $min) {
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $d);
		}
		
		$h = round($h * 360, $accuracy);
		$s = round($s * 100, $accuracy);
		$v = round($v * 100, $accuracy);
		
		return array('h' => $h, 's' => $s, 'b' => $v);
	}
	
	/**
	 * Convert a HSB array to a RGB array
	 * 
	 * @param  float  $h The hue value (0 - 360)
	 * @param  float  $s The saturation value (0 - 100)
	 * @param  float  $b The brightness value (0 - 100)
	 * @return array     The resulting RGB array
	 */
	public static function hsb_to_rgb($h = 0.0, $s = 0.0, $v = 0.0, $accuracy = 3) {
		if ($v == 0) {
			return array('r' => 0, 'g' => 0, 'b' => 0);
		}
		$s   /= 100;
		$v   /= 100;
		$h   /= 60;
		$i    = floor($h);
		$f    = $h - $i;
		$p    = $v * (1 - $s);
		$q    = $v * (1 - ($s * $f));
		$t    = $v * (1 - ($s * (1 - $f)));
		$calc = array(array($v, $t, $p), array($q, $v, $p), array($p, $v, $t), array($p, $q, $v), array($t, $p, $v), array($v, $p, $q));
		return array('r' => round($calc[$i][0] * 255, $accuracy), 'g' => round($calc[$i][1] * 255, $accuracy), 'b' => round($calc[$i][2] * 255, $accuracy));
	}
}
