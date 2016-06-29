<?php

namespace projectcleverweb\hexrgb;


class main {
	
	private $data;
	
	public function __construct($hex) {
		if ($hex instanceof data) {
			$this->data = $hex;
		} else {
			$this->data = new data($hex);
		}
	}
	
	public function is_dark(int $check_score = 128) :bool {
		$rgb = $this->data->rgb;
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
	}
	
	public function mod_r(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::red($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_g(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::green($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_b(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::blue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_h(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_s(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::saturation($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_l(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::light($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	
	
	
	
	
	
}

class modify {
	
	public static function red($data, $adjustment, $set_absolute) {
		
	}
	
	public static function green($data, $adjustment, $set_absolute) {
		
	}
	
	public static function blue($data, $adjustment, $set_absolute) {
		
	}
	
	public static function hue($data, $adjustment, $set_absolute) {
		
	}
	
	public static function saturation($data, $adjustment, $set_absolute) {
		
	}
	
	public static function light($data, $adjustment, $set_absolute) {
		
	}
	
}


class data extends stdClass {
	
	private $string;
	private $rgb;
	private $hsl;
	
	public function __construct($hex) {
		if (is_int($hex)) {
			// Convert from PHP hex integer (forcing valid color)
			$hex %= 16777216;
			$hex = base_convert(abs($hex), 10, 16);
		}
		static::_validate_hex_str($hex);
		static::_strip_hash($hex);
		static::_expand_shorthand($hex);
		$this->string = strtoupper($hex);
		$this->rgb = generate::hex_to_rgb($this->string);
		$this->hsl = new hsl($this->rgb);
	}
	
	protected static function _strip_hash(&$hex) {
		if (is_string($hex) && substr($hex, 0 ,1) == '#') {
			$hex = substr($hex, 1);
		}
	}
	
	protected static function _expand_shorthand(string &$hex_str) {
		$hex_str = generate::expand_shorthand($hex_str);
	}
	
	protected static function _validate_hex_str(&$hex_str) {
		if (is_string($hex_str) && preg_match('/\A#?(?:[0-9a-f]{3}|[0-9a-f]{6})\Z/i', $hex_str)) {
			return;
		}
		// Error - Force color and trigger notice
		$hex_str = '000000';
		// [todo] Trigger Error
	}
}



class hsl {
	
	private $hsl;
	protected $accuracy;
	
	public function __construct(array $rgb_array, int $accuracy = 1) {
		$this->accuracy = $accuracy;
		$this->hsl = static::rgb_to_hsl($rgb_array['r'], $rgb_array['g'], $rgb_array['b'], $this->accuracy);
		echo json_encode(array_values($rgb_array)).' => ';
		echo json_encode(array_values($this->hsl)).' => ';
		echo json_encode(array_values(static::hsl_to_rgb($this->hsl['h'], $this->hsl['s'], $this->hsl['l']))).PHP_EOL;
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

class generate {
	
	public static function expand_shorthand(string $hex) :string {
		if (strlen($hex) === 3) {
			$r = $hex[0];
			$g = $hex[1];
			$b = $hex[2];
			return $r.$r.$g.$g.$b.$b;
		}
		return $hex;
	}
	
	public static function hex_to_rgb(string $hex) :array {
		return [
			'r' => hexdec(substr($hex, 0, 2)),
			'g' => hexdec(substr($hex, 2, 2)),
			'b' => hexdec(substr($hex, 4, 2))
		];
	}
	
	public static function yiq_score(int $r = 0, int $g = 0, int $b = 0) {
		return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	}
	
	public static function rand($min_r = 0, $max_r = 255, $min_g = 0, $max_g = 255, $min_b = 0, $max_b = 255) :string {
		$hex_arr = [
			rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
			rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
			rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
		];
		$result = '';
		foreach ($hex_arr as $int) {
			$result .= str_pad(base_convert($int, 10, 16), 2, '0');
		}
		return $result;
	}
	
}

class check {
	
	
	public static function is_dark(int $r = 0, int $g = 0, int $b = 0, int $check_score = 128) :bool {
		if (generate::yiq_score($r, $g, $b) >= $check_score) {
			return FALSE;
		}
		return TRUE;
	}
	
	public static function rgb_contrast($rgb1, $rgb2) {
		$r = (max($rgb1['r'], $rgb2['r']) - min($rgb1['r'], $rgb2['r'])) * 299;
		$g = (max($rgb1['g'], $rgb2['g']) - min($rgb1['g'], $rgb2['g'])) * 587;
		$b = (max($rgb1['b'], $rgb2['b']) - min($rgb1['b'], $rgb2['b'])) * 114;
		// Sum => Average => Convert to percentage
		return ($r + $g + $b) / 1000 / 2.55;
	}
	
	
}

class error {
	
	
	
	
}



function hexrgb_rand($min_r = 0, $max_r = 255, $min_g = 0, $max_g = 255, $min_b = 0, $max_b = 255) {
	$hex_arr = array(
		rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
		rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
		rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
	);
	$result = '';
	foreach ($hex_arr as $int) {
		$result .= str_pad(base_convert($int, 10, 16), 2, '0', STR_PAD_LEFT);
	}
	return strtoupper($result);
}

function hexrgb_invert($hex) {
	$arr = str_split($hex, 2);
	foreach ($arr as &$value) {
		$c = base_convert($value, 16, 10);
		$value = str_pad(base_convert(255 - $c, 10, 16), 2, '0', STR_PAD_LEFT);
	}
	list($r, $g, $b) = $arr;
	return implode('', $arr);
}

function hexrgb_is_dark($hex) {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? FALSE : TRUE;
}

// $fmt = '<div style="background: #%1$s; color: #%3$s;">%1$s / <span style="color: #%2$s;">%2$s</span> / %3$s</div>';
// foreach (range(1,50) as $i) {
// 	$c1 = hexrgb_rand();
// 	$c2 = hexrgb_invert($c1);
// 	$c3 = hexrgb_is_dark($c1) ? 'ffffff' : '000000';
// 	printf($fmt, $c1, $c2, $c3);
// }


foreach (range(1, 50) as $i) {
	$a = hexrgb_rand();
	printf('#%s - ', $a);
	new main($a);
}
