<?php
/**
 * The 'generate' class
 */

namespace projectcleverweb\color;

/**
 * The 'generate' class
 */
class generate {
	
	/**
	 * Generate the most contrasting color for any RGB color
	 * 
	 * @param  int   $r The red value
	 * @param  int   $g The green value
	 * @param  int   $b The blue value
	 * @return array    The most contrasting color as an RGB array
	 */
	public static function rgb_contrast(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => ($r < 128) ? 255 : 0,
			'g' => ($g < 128) ? 255 : 0,
			'b' => ($b < 128) ? 255 : 0
		];
	}
	
	/**
	 * Generate the mathematical opposite color for any RGB color
	 * 
	 * @param  int   $r The red value
	 * @param  int   $g The green value
	 * @param  int   $b The blue value
	 * @return array    The mathematical opposite color as an RGB array
	 */
	public static function rgb_invert(int $r = 0, int $g = 0, int $b = 0) :array {
		return [
			'r' => 255 - $r,
			'g' => 255 - $g,
			'b' => 255 - $b
		];
	}
	
	/**
	 * Generate the YIQ score for an RGB color
	 * 
	 * @param  int   $r The red value
	 * @param  int   $g The green value
	 * @param  int   $b The blue value
	 * @return float    The YIQ score
	 */
	public static function yiq_score(int $r = 0, int $g = 0, int $b = 0) :float {
		return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	}
	
	/**
	 * Generate a random RGB color
	 * 
	 * @param  int $min_r The min red to allow
	 * @param  int $max_r The max red to allow
	 * @param  int $min_g The min green to allow
	 * @param  int $max_g The max green to allow
	 * @param  int $min_b The min blue to allow
	 * @param  int $max_b The max blue to allow
	 * @return array      The resulting color as a RGB array
	 */
	public static function rgb_rand(int $min_r = 0, int $max_r = 255, int $min_g = 0, int $max_g = 255, int $min_b = 0, int $max_b = 255) :array {
		return [
			'r' => rand(abs((int) $min_r) % 256, abs((int) $max_r) % 256),
			'g' => rand(abs((int) $min_g) % 256, abs((int) $max_g) % 256),
			'b' => rand(abs((int) $min_b) % 256, abs((int) $max_b) % 256)
		];
	}
	
	/**
	 * Generate a random HSL color
	 * 
	 * @param  int $min_r The min hue to allow
	 * @param  int $max_r The max hue to allow
	 * @param  int $min_g The min saturation to allow
	 * @param  int $max_g The max saturation to allow
	 * @param  int $min_b The min light to allow
	 * @param  int $max_b The max light to allow
	 * @return array      The resulting color as a HSL array
	 */
	public static function hsl_rand(int $min_h = 0, int $max_h = 359, int $min_s = 0, int $max_s = 100, int $min_l = 0, int $max_l = 100) :array {
		return [
			'h' => rand(abs((int) $min_h) % 360, abs((int) $max_h) % 360),
			's' => rand(abs((int) $min_s) % 101, abs((int) $max_s) % 101),
			'l' => rand(abs((int) $min_l) % 101, abs((int) $max_l) % 101)
		];
	}
	
	/**
	 * Blend 2 RGB colors
	 * 
	 * @param  float $r1     The red value from color 1
	 * @param  float $g1     The green value from color 1
	 * @param  float $b1     The blue value from color 1
	 * @param  float $a1     The alpha value from color 1
	 * @param  float $r2     The red value from color 2
	 * @param  float $g2     The green value from color 2
	 * @param  float $b2     The blue value from color 2
	 * @param  float $a2     The alpha value from color 2
	 * @param  float $amount The percentage of color 2 to mix in (defaults to 50 for even blending)
	 * @return array         The resulting color as a RGB array
	 */
	public static function blend(float $r1, float $g1, float $b1, float $a1, float $r2, float $g2, float $b2, float $a2, float $amount = 50.0) :array {
		$x1 = regulate::div(100 - $amount, 100);
		$x2 = regulate::div($amount, 100);
		return [
			'r' => round(($r1 * $x1) + ($r2 * $x2), 0),
			'g' => round(($g1 * $x1) + ($g2 * $x2), 0),
			'b' => round(($b1 * $x1) + ($b2 * $x2), 0),
			'a' => ($a1 * $x1) + ($a2 * $x2)
		];
	}
	
	/**
	 * Generate a gradient range between 2 RGB colors
	 * 
	 * @param  int $r1    The red value from color 1
	 * @param  int $g1    The green value from color 1
	 * @param  int $b1    The blue value from color 1
	 * @param  int $r2    The red value from color 2
	 * @param  int $g2    The green value from color 2
	 * @param  int $b2    The blue value from color 2
	 * @param  int $steps The size of array to produce, 0 will dynamically 
	 * @return array       [TODO]
	 */
	public static function gradient_range(int $r1 = 0, int $g1 = 0, int $b1 = 0, int $r2 = 0, int $g2 = 0, int $b2 = 0, int $steps = 0) :array {
		$diff = [
			'r' => $r1 - $r2,
			'g' => $g1 - $g2,
			'b' => $b1 - $b2
		];
		$div = max(abs($r1 - $r2), abs($g1 - $g2), abs($b1 - $b2));
		if ($steps != 0) {
			$div = abs($steps) - 1;
		}
		$result = [];
		foreach (range(0 , $div) as $i) {
			$result[] = [
				'r' => $r1 + round(regulate::div(-$diff['r'], $div) * $i),
				'g' => $g1 + round(regulate::div(-$diff['g'], $div) * $i),
				'b' => $b1 + round(regulate::div(-$diff['b'], $div) * $i)
			];
		}
		return $result;
	}
	
	/**
	 * Round a RGB input to a 'websafe' color hex
	 * 
	 * @param  int    $r The red value
	 * @param  int    $g The green value
	 * @param  int    $b The blue value
	 * @return string    The resulting color as a hex string
	 */
	public static function web_safe(int $r = 0, int $g = 0, int $b = 0) :string {
		return convert\rgb::to_hex(
			round($r / 0x33) * 0x33,
			round($g / 0x33) * 0x33,
			round($b / 0x33) * 0x33
		);
	}
	
	/**
	 * Converts a hue to the "Y" spectrum
	 * 
	 * @param  float  $hue The hue to convert
	 * @return float       The resulting Y
	 */
	public static function hue_to_yiq(float $hue) :float {
		if ($hue < 60) {
			return $hue * 2.5254237288136;
		} elseif ($hue < 180) {
			return 150 + ($hue - 60) * 4.9243697478992;
		} elseif ($hue < 300) {
			return 737 + ($hue - 180) * 0.94957983193277;
		}
		return 851 + ($hue - 300) * 2.5254237288136;
	}
	
	/**
	 * Converts a "Y" to the hue spectrum
	 * 
	 * @param  float  $yiq The "Y" to convert
	 * @return float       The resulting hue
	 */
	public static function yiq_to_hue(float $yiq) :float {
		if ($yiq < 150) {
			return $yiq * 0.39597315436242;
		} elseif ($yiq < 737) {
			return 60 + ($yiq - 150) * 0.20307167235495;
		} elseif ($yiq < 851) {
			return 180 + ($yiq - 737) * 1.0530973451327;
		}
		return 300 + ($yiq - 851) * 0.39597315436242;
	}
}
