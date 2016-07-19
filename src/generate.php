<?php


namespace projectcleverweb\color;


class generate {
	
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
	
	public static function rgb_contrast(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => ($r < 128) ? 255 : 0,
			'g' => ($g < 128) ? 255 : 0,
			'b' => ($b < 128) ? 255 : 0
		];
	}
	
	public static function rgb_invert(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => 255 - $r,
			'g' => 255 - $g,
			'b' => 255 - $b
		];
	}
	
	public static function yiq_score(int $r = 0, int $g = 0, int $b = 0) :float {
		return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	}
	
	public static function rand(int $min_r = 0, int $max_r = 255, int $min_g = 0, int $max_g = 255, int $min_b = 0, int $max_b = 255) :array {
		return [
			'r' => rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
			'g' => rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
			'b' => rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
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
		
		if ($delta != 0) {
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
	
}
