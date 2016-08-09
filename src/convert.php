<?php


namespace projectcleverweb\color;


class convert {
	
	/**
	 * Convert a hex string (no #) to a RGB array
	 * 
	 * @param  string $hex The hex string to convert (no #)
	 * @return array       The RGB array
	 */
	public static function hex_to_rgb(string $hex) :array {
		return [
			'r' => hexdec(substr($hex, 0, 2)),
			'g' => hexdec(substr($hex, 2, 2)),
			'b' => hexdec(substr($hex, 4, 2))
		];
	}
	
	public static function rgb_to_hex(int $r, int $g, int $b) :string {
		return strtoupper(
			str_pad(dechex($r), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($g), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($b), 2, '0', STR_PAD_LEFT)
		);
	}
	
	public static function rgb_to_cmyk(float $r, float $g, float $b) :array {
		$c  = (255 - $r) / 255 * 100;
		$m  = (255 - $g) / 255 * 100;
		$y  = (255 - $b) / 255 * 100;
		$k  = min(array($c,$m,$y));
		$c -= $k;
		$m -= $k;
		$y -= $k;
		return [
			'c' => round($c),
			'm' => round($m),
			'y' => round($y),
			'k' => round($k)
		];
	}
	
	public static function cmyk_to_rgb(float $c, float $m, float $y, float $k) :array {
		$c /= 100;
		$m /= 100;
		$y /= 100;
		$k /= 100;
		$r  = 1 - min(1, $c * (1 - $k) + $k);
		$g  = 1 - min(1, $m * (1 - $k) + $k);
		$b  = 1 - min(1, $y * (1 - $k) + $k);
		return [
			'r' => round($r * 255),
			'g' => round($g * 255),
			'b' => round($b * 255)
		];
	}
	
	public static function rgb_to_hsl(int $r = 0, int $g = 0, int $b = 0, $accuracy = 2) :array {
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
		
		return [
			'h' => round($h * 360, $accuracy),
			's' => round($s * 100, $accuracy),
			'l' => round($l * 100, $accuracy)
		];
	}
	
	protected static function _rgbhsl_delta_rgb(float $rgb, float $max, float $delta) {
		return ((($max - $rgb) / 6) + ($delta / 2)) / $delta;
	}
	
	protected static function _rgbhsl_hue(float &$h, float $r, float $g, float $b, float $max, float $delta) {
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
	
	public static function hsl_to_rgb(float $h = 0, float $s = 0, float $l = 0) :array {
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
			'r' => (int) round(($r + $m) * 255),
			'g' => (int) round(($g + $m) * 255),
			'b' => (int) round(($b + $m) * 255)
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
	
	public static function rgb_to_hsb(float $r, float $g, float $b, int $accuracy = 3) :array {
		$r /= 255;
		$g /= 255;
		$b /= 255;
		
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		$v   = $max;
		$d   = $max - $min;
		$s   = static::_div($d, $max);
		$h   = 0; // achromatic
		if ($max != $min) {
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $d);
		}
		
		$h = round($h * 360, $accuracy);
		$s = round($s * 100, $accuracy);
		$v = round($v * 100, $accuracy);
		
		return ['h' => $h, 's' => $s, 'b' => $v];
	}
	
	public static function hsb_to_rgb(float $h, float $s, float $v, int $accuracy = 3) :array {
		if ($v == 0) {
			return ['r' => 0, 'g' => 0, 'b' => 0];
		}
		
		$s   /= 100;
		$v   /= 100;
		$h   /= 60;
		$i    = floor($h);
		$f    = $h - $i;
		$p    = $v * (1 - $s);
		$q    = $v * (1 - ($s * $f));
		$t    = $v * (1 - ($s * (1 - $f)));
		$calc = [
			[$v, $t, $p],
			[$q, $v, $p],
			[$p, $v, $t],
			[$p, $q, $v],
			[$t, $p, $v],
			[$v, $p, $q]
		];
		
		$r = round($calc[$i][0] * 255, $accuracy);
		$g = round($calc[$i][1] * 255, $accuracy);
		$b = round($calc[$i][2] * 255, $accuracy);
		
		return ['r' => $r, 'g' => $g, 'b' => $b];
	}
	
	public static function _div(float $number, float $divisor) {
		if ($divisor == 0) {
			return 0;
		}
		return $number / $divisor;
	}
}
